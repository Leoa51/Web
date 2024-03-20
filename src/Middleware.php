<?php

use Slim\App;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

return function (App $app) {

    $app->add(TwigMiddleware::createFromContainer($app, Twig::class));
};
