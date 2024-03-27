<?php

global $entityManager;

use DI\Container;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

require __DIR__ . '\..\vendor\autoload.php';

// Create Container
$container = new Container();
AppFactory::setContainer($container);

// Set view in Container
$container->set('view', function () {
    return Twig::create('..\src\pages', ['cache' => false]);
});
$container->set(Twig::class, $container->get('view'));

require_once __DIR__ . "/../doctrine/bootstrap.php";

$container->set(\Doctrine\ORM\EntityManager::class, $entityManager);

// Create App
$app = AppFactory::create();

// Add Twig-View Middleware
$app->add(TwigMiddleware::createFromContainer($app));


require_once __DIR__ . '/../src/route.php';


// Run app
$app->run();