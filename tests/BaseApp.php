<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Container;

class BaseApp extends TestCase
{
    protected ContainerInterface $container;

    protected function setUp(): void
    {
        parent::setUp();
        $app = $this->createApp();
        $this->container = $app->getContainer();
    }

    /**
     * @return App
     */
    protected function createApp(): App
    {
        $settings = require __DIR__ . '/../phpunit-settings.php';

        // Instantiate the application
        $app = new App($settings);

        require __DIR__ . '/../dependencies.php';

        return $app;
    }
}