<?php


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Exception\HttpNotFoundException;



require_once __DIR__ . "/index_requirement.php";


$app->get('/', function ($request, $response, $args) {
return $this->get('view')->render($response, 'Accueil.html', [
]);
})->setName('profile');


// Define named route
$app->get('/opinion', function ($request, $response, $args) {
return $this->get('view')->render($response, 'opinion.twig', [
]);
})->setName('opinion');

$app->get('/creationOffers', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'creationOffers.twig', [
    ]);
})->setName('CreationOffre');

$app->get('/profilPilot', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'profilPilot.twig', [
    ]);
})->setName('ProfilPilot');

$app->get('/companyMenu', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'companyMenu.twig', [
    ]);
})->setName('companyMenu');

$app->get('/showCompanyDetails', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'showCompanyDetails.twig', [
    ]);
})->setName('Details company');

$app->get('/statsCompany', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'statsCompany.twig', [
    ]);
})->setName('Stats company');

$app->get('/publishOffers', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'publishOffers.twig', [
    ]);
})->setName('Publish Offers');

$app->get('/listOffers', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'listOffers.twig', [
    ]);
})->setName('list of offers');

$app->get('/listStudents', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'listStudents.twig', [
    ]);
})->setName('list of students');

$app->get('/statsStudents', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'StatsStudents.twig', [
    ]);
})->setName('stats of students');

$app->get('/creationStudents', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'creationStudents.twig', [
    ]);
})->setName('stats of students');

$app->get('/login', function ($request, $response, $args) {
    return $this->get('view')->render($response, '/login.twig', [
    ]);
})->setName('login');

$app->get('/listCompany', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'listCompany.twig', [
    ]);
})->setName('list of company');

$app->get('/publishCompany', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'publishCompany.twig', [
    ]);
})->setName('Publication of company');

$app->get('/profilStudents', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'profilStudents.twig', [
    ]);
})->setName('Profil of students');

$app->get('/application', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'application.twig', [
    ]);
})->setName('application');

$app->get('/statsOffers', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'statsOffers.twig', [
    ]);
})->setName('Stats of Offers');

$app->get('/listPilot', function ($request, $response, $args) use ($data) {
    return $this->get('view')->render($response, 'listPilot.twig', ['data' => $data]);
})->setName('list of pilot');

$app->get('/creationPilote', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'creationPilote.twig', [
    ]);
})->setName('creation of pilot');

$app->get('/profilAdmin', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'profilAdmin.twig', [
    ]);
})->setName('Profil of Admin');

$app->get('/about', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'about.twig', [
    ]);
})->setName('About');

$app->get('/contact', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'contact.twig', [
    ]);
})->setName('Contact');

$app->get('/privacy', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'privacy.twig', [
    ]);
})->setName('Privacy');



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



$app->get('/apiaddress/{page}', function (Request $request, Response $response , array $args) use ($addressdata) {
    $page = (int) $args['page'];
//    $search = (string) $args['search'];
    $limit = 10;
    $offset = ($page - 1) * $limit;

    $data = array_slice($addressdata, $offset, $limit);

    $json = json_encode($data);

    // Retourner les offres en JSON dans la réponse HTTP
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json');
});


$app->get('/apicampus/{page}', function (Request $request, Response $response , array $args) use ($campusdata) {
    $page = (int) $args['page'];
    $limit = 10;
    $offset = ($page - 1) * $limit;

    $data = array_slice($campusdata, $offset, $limit);

    $json = json_encode($data);

    // Retourner les offres en JSON dans la réponse HTTP
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json');
});


$app->get('/apicompany/{page}', function (Request $request, Response $response , array $args) use ($companydata) {
    $page = (int) $args['page'];
    $limit = 10;
    $offset = ($page - 1) * $limit;

    $data = array_slice($companydata, $offset, $limit);

    $json = json_encode($data);

    // Retourner les offres en JSON dans la réponse HTTP
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json');
});




$app->get('/apioffers/{page}', function (Request $request, Response $response , array $args) use ($offersdata) {
    $page = (int) $args['page'];
    $limit = 10;
    $offset = ($page - 1) * $limit;

    $data = array_slice($offersdata, $offset, $limit);

    $json = json_encode($data);

    // Retourner les offres en JSON dans la réponse HTTP
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json');
});


$app->get('/apipostulate/{page}', function (Request $request, Response $response , array $args) use ($postulatedata) {
    $page = (int) $args['page'];
    $limit = 10;
    $offset = ($page - 1) * $limit;

    $data = array_slice($postulatedata, $offset, $limit);

    $json = json_encode($data);

    // Retourner les offres en JSON dans la réponse HTTP
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json');
});


$app->get('/apiuser/{page}', function (Request $request, Response $response , array $args) use ($userdata) {
    $page = (int) $args['page'];
    $limit = 10;
    $offset = ($page - 1) * $limit;

    $data = array_slice($userdata, $offset, $limit);

    $json = json_encode($data);

    // Retourner les offres en JSON dans la réponse HTTP
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json');
});



$app->get('/fetch', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'fetch.php', [
    ]);
})->setName('Profil of Admin');


//$app->post('/newaddress', function (Request $request, Response $response) {
//    $data = $request->getParsedBody();
////    $this->get('address')->create($data);
//    exec("php D:\Download\apps_travail\xampp\htdocs\site\bin\create_address.php api 1", $output, $status);
//
//    return $response;
//});











$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($request, $handler) {
    $response = $handler->handle($request);
    return $response
        ->withHeader('Access-Control-Allow-Origin', 'http://site.stagehub.com')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});


$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
    throw new HttpNotFoundException($request);
});