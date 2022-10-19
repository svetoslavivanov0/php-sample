<?php
// DIC configuration

use App\Domain\Post\Actions\CreatePostAction;
use App\Domain\Post\Actions\DeletePostAction;
use App\Domain\Post\Actions\UpdatePostAction;

$container = $app->getContainer();

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG));
    return $logger;
};

$container['db'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};

$container->get('db');

$container['createPostAction'] = function ($container) {
    return new CreatePostAction();
};

$container['updatePostAction'] = function ($container) {
    return new UpdatePostAction();
};

$container['deletePostAction'] = function ($container) {
    return new DeletePostAction();
};