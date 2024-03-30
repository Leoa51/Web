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


$app->post('/submit-review', function ($request, $response, $args) {
    // Récupérer les données envoyées par le formulaire
    $rating = $request->getParam('rating');
    $comment = $request->getParam('comment');

    // Vérifier que les données sont valides
    if (empty($rating) || empty($comment)) {
        // Retourner une réponse d'erreur si les données ne sont pas valides
        return $response->withStatus(400)->getBody()->write('Veuillez remplir tous les champs.');
    }

    // Enregistrer l'avis dans la base de données
    // ...

    // Rediriger l'utilisateur vers la page de liste des offres
    return $response->withStatus(302)->withHeader('Location', '/listOffers');
});


$app->map(['GET', 'POST'], '/opinion', function ($request, $response, $args) use ($entityManager) {
    session_start();
    $httpMethod = $request->getMethod();
    if ($httpMethod === 'GET') {
        return $this->get('view')->render($response, 'opinion.twig', [
        ]);
    } elseif ($httpMethod === 'POST') {
        var_dump("test");

        return $response->withStatus(302)->withHeader('Location', '/showCompanyDetails');
    }

})->setName('opinion');


$app->get('/creationOffers', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'creationOffers.twig', [
    ]);
})->setName('CreationOffre');

$app->get('/profilPilot', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'profilPilot.twig', [
        'prenom' => $_COOKIE['firstName'],
        'nom' => $_COOKIE['lastName'],
        'promotion' => $_COOKIE['years'],
        'centre' => $_COOKIE['centre']
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


$app->map(['GET', 'POST'], '/login', function ($request, $response, $args) use ($entityManager, $centers) {
    //            @todo hashing /!\ sel pas dans la bdd + probleme avec les centres non reconnus sur les pages de profil
    session_start();
    $httpMethod = $request->getMethod();

    if ($httpMethod === 'GET') {
        return $this->get('view')->render($response, '/login.twig', []);
    } elseif ($httpMethod === 'POST') {
        if (isset($_POST['email'], $_POST['password'])) {
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            $queryBuilder = $entityManager->createQueryBuilder();
            $queryBuilder
                ->select('u.ID_User', 'u.password', 'u.type', 'u.firstName', 'u.lastName', 'u.years')
                ->from('Entity\User', 'u')
                ->Where('u.login = :login')
                ->setParameter('login', $_POST['email'])
                ->andWhere('u.del = :del')
                ->setParameter('del', false);
            $query = $queryBuilder->getQuery();
            $users = $query->getResult();

            foreach ($users as $user) {

                if ($password == $user['password']) {
                    setcookie('firstName', $user['firstName'], time() + (1 * 60), "/");
                    setcookie('lastName', $user['lastName'], time() + (1 * 60), "/");
                    setcookie('years', $user['years'], time() + (1 * 60), "/");
                    setcookie('centre', $centers[$user['ID_Campus'] + 1], time() + (1 * 60), "/");
                    if ($user['type'] == "2") {
                        setcookie('type', "Admin", time() + (30 * 60), "/");
                        return $response->withStatus(302)->withHeader('Location', '/profilAdmin');
                    } elseif ($user['type'] == "1") {
                        setcookie('type', "Pilot", time() + (30 * 60), "/");
                        return $response->withStatus(302)->withHeader('Location', '/profilPilot');
                    } elseif ($user['type'] == "0") {
                        setcookie('type', "Student", time() + (30 * 60), "/");
                        return $response->withStatus(302)->withHeader('Location', '/profilStudents');
                    }

                }
            }
            return $this->get('view')->render($response, 'login.twig', []);
        }
    }
});


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
        'prenom' => $_COOKIE['firstName'],
        'nom' => $_COOKIE['lastName'],
        'promotion' => $_COOKIE['years'],
        'centre' => $_COOKIE['centre']
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

$app->get('/listPilot', function ($request, $response, $args) use ($entityManager) {

//    $pilotdata = ListPilot($entityManager);

    return $this->get('view')->render($response, 'listPilot.twig', ['data' => $pilotdata]);
})->setName('list of pilot');

$app->get('/creationPilot', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'creationPilot.twig', [
    ]);
})->setName('creation of pilot');

$app->get('/profilAdmin', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'profilAdmin.twig', [
//        'prenom' => $_COOKIE['firstName'],
//        'nom' => $_COOKIE['lastName'],
//        'promotion' => $_COOKIE['years']
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

$app->get('/offersMenu', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'offersMenu.twig', [
    ]);
})->setName('menu of offers');


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


$app->get('/apiaddress/{page}', function (Request $request, Response $response, array $args) use ($entityManager) {

    $queryArgs = $request->getQueryParams();

    $ville = $queryArgs['ville'] ?? null;
    $postalcode = $queryArgs['postalcode'] ?? null;

    error_log($ville);
    $addressdata = ListAddress($entityManager, $ville, $postalcode);

    $page = (int)$args['page'];
//    $search = (string) $args['search'];
    $limit = 10;
    $offset = ($page - 1) * $limit;

    $data = array_slice($addressdata, $offset, $limit);

    $json = json_encode($data);

    // Retourner les offres en JSON dans la réponse HTTP
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json');
});


$app->get('/apicampus/{page}', [\Controller\CampusController::class, 'getCampus']);
$app->get('/liste-campus', [\Controller\CampusController::class, 'showCampusList']);


$app->get('/apicompany/{page}', function (Request $request, Response $response, array $args) use ($entityManager) {

    $queryArgs = $request->getQueryParams();

    $id = $queryArgs['id'] ?? null;
    $name = $queryArgs['name'] ?? null;
    $activitySector = $queryArgs['activitySector'] ?? null;
    $stats = $queryArgs['stats'] ?? null;
    $del = $queryArgs['del'] ?? null;
    $invisibleForStudents = $queryArgs['invisibleForStudents'] ?? null;
    $opinion = $queryArgs['opinion'] ?? null;
    $mark = $queryArgs['mark'] ?? null;
    $numberOfWishlist = $queryArgs['numberOfWishlist'] ?? null;
    $numberOfPostulation = $queryArgs['numberOfPostulation'] ?? null;

    echo($id);

    !
    $companydata = ListCompany($entityManager, $id, $name, $activitySector, $stats, $del, $invisibleForStudents, $opinion, $mark, $numberOfWishlist, $numberOfPostulation);

    $page = (int)$args['page'];
    $limit = 10;
    $offset = ($page - 1) * $limit;

    $data = array_slice($companydata, $offset, $limit);

    $json = json_encode($data);

    // Retourner les offres en JSON dans la réponse HTTP
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json');
});


$app->get('/apioffers/{page}', function (Request $request, Response $response, array $args) use ($entityManager) {

    $queryArgs = $request->getQueryParams();

    $ID_Offers = $queryArgs['id'] ?? null;
    $company = $queryArgs['company'] ?? null;
    $targetPromotion = $queryArgs['targetPromotion'] ?? null;
    $durationOfInternship = $queryArgs['durationOfInternship'] ?? null;
    $payment = $queryArgs['payment'] ?? null;
    $offerDate = $queryArgs['offerDate'] ?? null;
    $numberOfPlaces = $queryArgs['numberOfPlaces'] ?? null;
    $del = $queryArgs['del'] ?? null;
    $ID_Address = $queryArgs['ID_Address'] ?? null;
    $ID_Company = $queryArgs['ID_Company'] ?? null;


    $offersdata = ListOffers($entityManager, $ID_Offers, $company, $targetPromotion, $durationOfInternship, $payment, $offerDate, $numberOfPlaces, $del, $ID_Address, $ID_Company);

    $page = (int)$args['page'];
    $limit = 10;
    $offset = ($page - 1) * $limit;

    $data = array_slice($offersdata, $offset, $limit);

    $json = json_encode($data);

    // Retourner les offres en JSON dans la réponse HTTP
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json');
});


$app->get('/apipostulate/{page}', function (Request $request, Response $response, array $args) use ($entityManager) {

    $queryArgs = $request->getQueryParams();


    $postulatedata = ListPostulate($entityManager);

    $page = (int)$args['page'];
    $limit = 10;
    $offset = ($page - 1) * $limit;

    $data = array_slice($postulatedata, $offset, $limit);

    $json = json_encode($data);

    // Retourner les offres en JSON dans la réponse HTTP
    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json');
});


$app->get('/apiuser/{page}', function (Request $request, Response $response, array $args) use ($entityManager) {

    $queryArgs = $request->getQueryParams();

    $ID_User = $queryArgs['id'] ?? null;
    $firstname = $queryArgs['firstname'] ?? null;
    $lastname = $queryArgs['lastname'] ?? null;
    $type = $queryArgs['type'] ?? null;
    $years = $queryArgs['years'] ?? null;
    $login = $queryArgs['login'] ?? null;
    $password = $queryArgs['password'] ?? null;
    $del = $queryArgs['del'] ?? null;
    $ID_Address = $queryArgs['ID_Address'] ?? null;
    $ID_Campus = $queryArgs['ID_Campus'] ?? null;


    $userdata = ListUser($entityManager, $ID_User, $firstname, $lastname, $type, $years, $login, $password, $del, $ID_Address, $ID_Campus);


    $page = (int)$args['page'];
    $limit = 10;
    $offset = ($page - 1) * $limit;

    $data = array_slice($userdata, $offset, $limit);

    $json = json_encode($data);


    $response->getBody()->write($json);
    return $response->withHeader('Content-Type', 'application/json');
});


$app->get('/fetch', function ($request, $response, $args) {
    session_start();
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

//$app->map(['GET', 'POST'], '/testpost', function ($request, $response, $args) use ($entityManager) {
//    $httpMethod = $request->getMethod();
//
//    if ($httpMethod === 'GET') {
//        return $this->get('view')->render($response, 'testpost.html', []);
//    } elseif ($httpMethod === 'POST') {
////        error_log("post");
////        $Address = new \Entity\Address();
////
//        $data = $request->getParsedBody();
////        $a = "api";
////        $b = "1";
//
//        if (isset($data['a'])) {
//            $a = $data['a'];
//        }
//        if (isset($data['b'])) {
//            $b = $data['b'];
//        }
////        $command = "php ../bin/create_address.php ". $a . " " . $b;
////        exec($command, $output, $status);
//
//        $Address->setVille($a);
//        $Address->setPostalCode($b);
//
//        try {
//            error_log('Before persist');
//            $entityManager->persist($Address);
//            $entityManager->flush();
//        } catch (\Exception $e) {
//            error_log($e->getMessage());
//            return $response->withStatus(500);
//        }
//
//        return $this->get('view')->render($response, 'testpost.html', []);
//
//    }
//
//
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