<?php

// Define routes
$app->get('/', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'Accueil.html', [
    ]);
})->setName('home');

$app->get('/test', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'test.twig', [
        'x' => 10
    ]);
})->setName('test');

$app->get('/test2', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'test2.html', [
    ]);
})->setName('test2');

// Render from string
$app->get('/hi/{name}', function ($request, $response, $args) {
    $str = $this->get('view')->fetchFromString(
        '<p>Hi, my name is {{ name }}.</p>',
        [
            'name' => $args['name']
        ]
    );
    $response->getBody()->write($str);
    return $response;
});
