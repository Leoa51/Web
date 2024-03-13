<?php
$app->get('/', function ($request, $response, $args) {
return $this->get('view')->render($response, 'Accueil.html', [
]);
})->setName('profile');


// Define named route
$app->get('/test', function ($request, $response, $args) {
return $this->get('view')->render($response, 'test.twig', [
]);
})->setName('profile');

$app->get('/base', function ($request, $response, $args) {
return $this->get('view')->render($response, 'base.twig', [
]);
})->setName('profile');

$app->get('/opinion', function ($request, $response, $args) {
return $this->get('view')->render($response, 'templates/opinion.twig', [
]);
})->setName('opinion');

$app->get('/creationOffers', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'templates/creationOffers.twig', [
    ]);
})->setName('CreationOffre');

$app->get('/profilPilote', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'templates/profilPilote.twig', [
    ]);
})->setName('ProfilPilote');

$app->get('/companyMenu', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'templates/companyMenu.twig', [
    ]);
})->setName('companyMenu');

$app->get('/showCompanyDetails', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'templates/showCompanyDetails.twig', [
    ]);
})->setName('Details company');

$app->get('/statsCompany', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'templates/statsCompany.twig', [
    ]);
})->setName('Stats company');

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