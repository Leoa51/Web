<?php
use DI\Container;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;


require __DIR__ . '\..\..\vendor\autoload.php';


// Create Container
$container = new Container();
AppFactory::setContainer($container);

// Set view in Container
$container->set('view', function() {

    return Twig::create('../pages', ['cache' => false]);

});


// Create App
$app = AppFactory::create();

// Add Twig-View Middleware
$app->add(TwigMiddleware::createFromContainer($app));


$app->get('/', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'Accueil.html', [
    ]);
})->setName('profile');


$app->get('/listCompany', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'listCompany.twig', [
    ]);
})->setName('entreprise');

$app->get('/publishCompany', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'publishCompany.twig', [
    ]);
})->setName('entreprise');

$app->get('/profilPilote', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'profilPilote.twig', [
    ]);
})->setName('base');
// Define named route
$app->get('/test', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'test.twig', [
    ]);
})->setName('profile');

$app->get('/test2', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'test2.html', [
    ]);
})->setName('profile');

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



// Run app
$app->run();