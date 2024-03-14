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

$app->get('/publishOffers', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'templates/publishOffers.twig', [
    ]);
})->setName('Publish Offers');

$app->get('/listOffers', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'templates/listOffers.twig', [
    ]);
})->setName('list of offers');

$app->get('/listStudents', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'listStudents.twig', [
    ]);
})->setName('list of students');

$app->get('/statsStudents', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'templates/StatsStudents.twig', [
    ]);
})->setName('stats of students');

$app->get('/creationStudents', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'templates/creationStudents.twig', [
    ]);
})->setName('stats of students');

$app->get('/login', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'templates/login.twig', [
    ]);
})->setName('login');

$app->get('/listCompany', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'templates/listCompany.twig', [
    ]);
})->setName('list of company');

$app->get('/publishCompany', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'templates/publishCompany.twig', [
    ]);
})->setName('Publication of company');

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