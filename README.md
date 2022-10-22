# A quick info

This is a basic project, created with the Slim framework.
We use it as an API, which allows to

- create a user and login
- create post
- edit post
- delete post
- see post

For the authentication, we use JWT.

# Environments

We need to add some config values. Just copy the `.env-example` file and add
the values.

The `TEST_*` DB values are used for PHPUnit tests.

# Running the server

First, we need to install the composer packages.

Before we run the app, we need to run some migrations.

Go to the root of the project and run

1. `php vendor/bin/phoenix migrate` - that creates the DB tables ( the ones that we will use for the App )
2. `php vendor/bin/phoenix migrate -e test` - that creates the DB tables used for PHPUnit

Then we can start the app with `php -S localhost:8000 -t public`

# Running the tests

We can run the tests with `phpunit --bootstrap vendor/autoload.php`
