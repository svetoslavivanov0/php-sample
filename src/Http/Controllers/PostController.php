<?php

namespace App\Http\Controllers;

use App\Domain\Post\Models\Post;
use App\Domain\Post\Resources\PostsResource;
use App\Domain\User\Models\User;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class PostController
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Show postsphp
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return Response
     */
    public function index(Request $request, Response $response, $args): Response
    {
        $user = $this->getUserFromRequest($request);

        if (!$user) {
            return $response
                ->withStatus(404)
                ->withJson([
                    'message' => 'Not a user!'
                ]);
        }

        $data = new PostsResource($user->posts()->orderBy('created_at', 'desc')->get());

        return $response
            ->withJson(['posts' => $data->toArray()])
            ->withStatus(200);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function store(Request $request, Response $response, $args): Response
    {
        $user = $this->getUserFromRequest($request);

        try {
            $post = $this->container->createPostAction->handle($user, $request);

            return $response
                ->withStatus(200)
                ->withJson([
                    'post_id' => $post->id
                ]);
        } catch (\Exception $e) {
            return $response
                ->withStatus(422)
                ->withJson([
                    'message' => $e->getMessage()
                ]);
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return Response
     */
    public function update(Request $request, Response $response, $args): Response
    {
        $user = $this->getUserFromRequest($request);

        try {
            $this->container->updatePostAction->handle($user, $request, $args['id']);
            return $response
                ->withStatus(200)
                ->withJson([
                    'message' => 'Post updated successfully!'
                ]);
        } catch (\Exception $e) {
            return $response
                ->withStatus(422)
                ->withJson([
                    'message' => $e->getMessage()
                ]);
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return Response
     */
    public function show(Request $request, Response $response, $args): Response
    {
        $user = $this->getUserFromRequest($request);
        $postId = $args['id'];

        $post = Post::find($postId);

        if (!$post) {
            return $response
                ->withStatus(404);
        }

        return $response
            ->withStatus(200)
            ->withJson([
                'post' => [
                    'id' => $post->id,
                    'title' => $post->title,
                    'content' => $post->content,
                    'created_at' => date_format($post->created_at, 'm/d'),
                    'author' => $user->username
                ]
            ]);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return Response
     */
    public function destroy(Request $request, Response $response, $args): Response
    {
        $user = $this->getUserFromRequest($request);
        $postId = $args['id'];

        try {
            $this->container->deletePostAction->handle($user, $postId);

            return $response
                ->withStatus(200)
                ->withJson([
                    'message' => 'Deleted!'
                ]);
        } catch (\Exception $e) {
            return $response
                ->withStatus(422)
                ->withJson([
                    'message' => $e->getMessage()
                ]);
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function all(Request $request, Response $response): Response
    {
        $maxPosts = 15;

        $posts = Post::orderBy('created_at', 'desc')->take($maxPosts)->get();
        $data = new PostsResource($posts);

        return $response
            ->withJson(['posts' => $data->toArray()])
            ->withStatus(200);
    }

    /**
     * @return User|null
     */
    protected function getUserFromRequest(Request $request)
    {
        $payload = $request->getAttribute('jwt');
        $email = $payload['email'];

        return $email ? User::whereEmail($email)->with('posts')->first() : null;
    }
}