
<?php


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Exception\HttpNotFoundException;


require_once __DIR__ . "/index_requirement.php";

session_start();

$app->get('/', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'Accueil.html', [
    ]);
})->setName('profile');


$app->map(['GET', 'POST'], '/opinion', function ($request, $response, $args) use ($entityManager) {
    if (!StudentPerm()) {
        return $response->withStatus(302)->withHeader('Location', '/accessDenied');
    }
    $httpMethod = $request->getMethod();
    if ($httpMethod === 'GET') {
        return $this->get('view')->render($response, 'opinion.twig', [
        ]);
    } elseif ($httpMethod === 'POST') {
        print_r("err");

        $data = $request->getParsedBody();
        $opinion = "vide";
        $rating = 5;

        if (htmlspecialchars($_POST['rating']) !== null) {
            $rating = htmlspecialchars($_POST['rating']);
        };

        if (htmlspecialchars($_POST['comment']) !== null) {
            $opinion = htmlspecialchars($_POST['comment']);
        };

        $Opinion = new \Entity\Opinion();
        $Opinion->setIDCompany(1);
        $Opinion->setOpinion($opinion);
        $Opinion->setSender($_SESSION['firstName'] . " " . $_SESSION['lastName']);
        $Opinion->setMark($rating);

        try {
            error_log('Before persist');
            $entityManager->persist($Opinion);
            $entityManager->flush();
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            return $response->withStatus(500);
        }

        return $response->withStatus(302)->withHeader('Location', '/showCompanyDetails');
    }

})->setName('opinion');


//$app->get('/creationOffers', function ($request, $response, $args) {
//    if (PilotPerm()) {
//        return $this->get('view')->render($response, 'creationOffers.twig', [
//        ]);
//    } else {
//        return $response->withStatus(302)->withHeader('Location', '/');
//    }
//})->setName('CreationOffre');

$app->get('/profilPilot', function ($request, $response, $args) {
    if (!PilotPerm()) {
        return $response->withStatus(302)->withHeader('Location', '/accessDenied');
    }
    return $this->get('view')->render($response, 'profilPilot.twig', [
        'prenom' => $_SESSION['firstName'],
        'nom' => $_SESSION['lastName'],
        'promotion' => $_SESSION['years'],
        'centre' => $_SESSION['centre']
    ]);
})->setName('ProfilPilot');

$app->get('/companyMenu', function ($request, $response, $args) {
    if (!StudentPerm()) {
        return $response->withStatus(302)->withHeader('Location', '/accessDenied');
    }
    return $this->get('view')->render($response, 'companyMenu.twig', [
    ]);
})->setName('companyMenu');

$app->get('/showCompanyDetails', function ($request, $response, $args) {
    if (!StudentPerm()) {
        return $response->withStatus(302)->withHeader('Location', '/accessDenied');
    }
    return $this->get('view')->render($response, 'showCompanyDetails.twig', [
    ]);
})->setName('Details company');

//$app->get('/statsCompany/{page}', function ($request, $response, $args) use ($entityManager) {
//
//    $statsCompany = StatsCompany($entityManager, $args['page']);
//
//    return $this->get('view')->render($response, 'statsCompany.twig', [
//        'data' => $statsCompany,
//        'page' => $args['page']
//    ]);
//})->setName('Stats company');

$app->get('/statsCompany/{page}', function ($request, $response, $args) use ($entityManager) {
    if (!AdminPerm()) {
        return $response->withStatus(302)->withHeader('Location', '/accessDenied');
    }

    $statsCompany = StatsCompany($entityManager, $args['page']);

    return $this->get('view')->render($response, 'statsCompany.twig', [
        'data' => $statsCompany['companies'],
        'page' => $args['page'],
        'totalCompanies' => $statsCompany['totalCompanies']
    ]);
})->setName('Stats company');

$app->get('/listPilot', function ($request, $response, $args) use ($entityManager) {
    if (!AdminPerm()) {
        return $response->withStatus(302)->withHeader('Location', '/accessDenied');
    }

    $listPilot = listPilot($entityManager);

    return $this->get('view')->render($response, 'listPilot.twig', [
        'data' => $listPilot['u']
    ]);
})->setName('List Pilot');




$app->get('/publishOffers', function ($request, $response, $args) {
    if (!PilotPerm()) {
        return $response->withStatus(302)->withHeader('Location', '/accessDenied');
    }
    return $this->get('view')->render($response, 'publishOffers.twig', [
    ]);
})->setName('Publish Offers');

$app->get('/listOffers', function ($request, $response, $args) use ($entityManager) {
    if (!AdminPerm()) {
        return $response->withStatus(302)->withHeader('Location', '/accessDenied');
    }

    $listOffers = showListOffers($entityManager);

    return $this->get('view')->render($response, 'listOffers.twig', [
        'data' => $listOffers['o']
    ]);
})->setName('List of Offers');

//$app->get('/listStudents', function ($request, $response, $args) use ($entityManager) {
//    if (!StudentPerm()) {
//        return $response->withStatus(302)->withHeader('Location', '/');
//    }
//
//    $listStudents = listStudents($entityManager);
//
//    return $this->get('view')->render($response, 'listStudents.twig', [
//        'data' => $listStudents['u']
//    ]);
//})->setName('list of Students');

$app->get('/listStudents', function ($request, $response, $args) use ($entityManager) {
    if (!AdminPerm()) {
        return $response->withStatus(302)->withHeader('Location', '/accessDenied');
    }

    $listStudents = listStudent($entityManager);

    return $this->get('view')->render($response, 'listStudents.twig', [
        'data' => $listStudents['u']
    ]);
})->setName('List of Students');


$app->get('/statsStudents', function ($request, $response, $args) {
    if (!PilotPerm()) {
        return $response->withStatus(302)->withHeader('Location', '/accessDenied');
    }
    return $this->get('view')->render($response, 'StatsStudents.twig', [
    ]);
})->setName('stats of students');

//$app->get('/creationStudents', function ($request, $response, $args) {
//    if (!PilotPerm()) {
//        return $response->withStatus(302)->withHeader('Location', '/');
//    }
//    return $this->get('view')->render($response, 'creationStudents.twig', [
//    ]);
//})->setName('stats of students');


$app->map(['GET', 'POST'], '/login', function ($request, $response, $args) use ($entityManager, $centers) {

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

                if (password_verify($password, $user['password'])) {
//                    setcookie('firstName', $user['firstName'], time() + (10 * 60), "/");
//                    setcookie('lastName', $user['lastName'], time() + (10 * 60), "/");
//                    setcookie('years', $user['years'], time() + (10 * 60), "/");
//                    setcookie('centre', $centers[$user['ID_Campus'] + 1], time() + (10 * 60), "/");
                    $_SESSION['firstName'] = $user['firstName'];
                    $_SESSION['lastName'] = $user['lastName'];
                    $_SESSION['years'] = $user['years'];
                    $_SESSION['centre'] = $centers[$user['ID_Campus'] + 1];
                    $_SESSION['ID_User'] = $user['ID_User'];

                    if ($user['type'] == "2") {
//                        setcookie('type', "Admin", time() + (10 * 60), "/");
                        $_SESSION['type'] = "Admin";
                        return $response->withStatus(302)->withHeader('Location', '/profilAdmin');
                    } elseif ($user['type'] == "1") {
//                        setcookie('type', "Pilot", time() + (10 * 60), "/");
                        $_SESSION['type'] = "Pilot";
                        return $response->withStatus(302)->withHeader('Location', '/profilPilot');
                    } elseif ($user['type'] == "0") {
//                        setcookie('type', "Student", time() + (10 * 60), "/");
                        $_SESSION['type'] = "Student";
                        return $response->withStatus(302)->withHeader('Location', '/profilStudents');
                    }

                }
            }
            return $this->get('view')->render($response, 'login.twig', []);
        }
    }
});


$app->get('/listCompany', function ($request, $response, $args) use ($entityManager) {
    if (!PilotPerm()) {
        return $response->withStatus(302)->withHeader('Location', '/accessDenied');
    }

    $listCompany = showListCompany($entityManager);

    return $this->get('view')->render($response, 'ListCompany.twig', [
        'data' => $listCompany['company']
    ]);
})->setName('List of Companies');


$app->get('/accessDenied', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'accessDenied.twig', [
    ]);
})->setName('Access denied to our site');

$app->get('/profilStudents', function ($request, $response, $args) {
    if (SpecialPerm()) {
        return $this->get('view')->render($response, 'profilStudents.twig', [
            'prenom' => $_SESSION['firstName'],
            'nom' => $_SESSION['lastName'],
            'promotion' => $_SESSION['years'],
            'centre' => $_SESSION['centre']
        ]);
    } else {
        return $response->withStatus(302)->withHeader('Location', '/accessDenied');
    }
})->setName('Profil of students');

$app->get('/application', function ($request, $response, $args) {
    if (SpecialPerm()) {
        return $this->get('view')->render($response, 'application.twig', [
        ]);
    } else {
        return $response->withStatus(302)->withHeader('Location', '/');
    }
})->setName('application');

$app->get('/statsOffers', function ($request, $response, $args) {
    if (!StudentPerm()) {
        return $response->withStatus(302)->withHeader('Location', '/');
    }
    return $this->get('view')->render($response, 'statsOffers.twig', [
    ]);
})->setName('Stats of Offers');

//$app->get('/listPilot', function ($request, $response, $args) use ($entityManager) {
//    if (AdminPerm()) {
//
//        $pilotdata = ListPilot($entityManager);
//
//        return $this->get('view')->render($response, 'listPilot.twig', ['data' => $pilotdata]);
//    } else {
//        return $response->withStatus(302)->withHeader('Location', '/');
//    }
//})->setName('list of pilot');

//$app->get('/creationPilot', function ($request, $response, $args) {
//    if (AdminPerm()) {
//        return $this->get('view')->render($response, 'creationPilot.twig', [
//        ]);
//    } else {
//        return $response->withStatus(302)->withHeader('Location', '/');
//    }
//})->setName('creation of pilot');

$app->get('/profilAdmin', function ($request, $response, $args) {
    if (AdminPerm()) {
        return $this->get('view')->render($response, 'profilAdmin.twig', [
        ]);
    } else {
        return $response->withStatus(302)->withHeader('Location', '/accessDenied');
    }
})->setName('Profil of Admin');

$app->get('/about', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'about.twig', [
    ]);
})->setName('About');

$app->get('/contact', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'contact.twig', [
    ]);
})->setName('Contact');

$app->get('/offersMenu', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'offersMenu.twig', [
    ]);
})->setName('Menu offers');

$app->get('/privacy', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'privacy.twig', [
    ]);
})->setName('Privacy');

$app->get('/disconnect', function ($request, $response, $args) {
    session_destroy();
    session_start();
    return $response->withStatus(302)->withHeader('Location', '/');
});

$app->get('/denied', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'denied.twig', [
    ]);
});


$app->get('/redirect', function ($request, $response, $args) {
    if (isset($_SESSION['type']) && $_SESSION['type'] == "Admin") {
        return $response->withStatus(302)->withHeader('Location', '/profilAdmin');
    } elseif (isset($_SESSION['type']) && $_SESSION['type'] == "Pilot") {
        return $response->withStatus(302)->withHeader('Location', '/profilPilot');
    } elseif (isset($_SESSION['type']) && $_SESSION['type'] == "Student") {
        return $response->withStatus(302)->withHeader('Location', '/profilStudents');
    } else {
        return $response->withStatus(302)->withHeader('Location', '/accessDenied');
    }
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
    return $this->get('view')->render($response, 'fetch.php', [
    ]);
})->setName('Profil of Admin');

//$app->get('/listPilot', function ($request, $response, $args) {
//    return $this->get('view')->render($response, 'listPilot.twig', [
//    ]);
//})->setName('List of Pilot');



//$app->post('/newaddress', function (Request $request, Response $response) {
//    $data = $request->getParsedBody();
////    $this->get('address')->create($data);
//    exec("php D:\Download\apps_travail\xampp\htdocs\site\bin\create_address.php api 1", $output, $status);
//
//    return $response;
//});

$app->map(['GET', 'POST'], '/publishCompany', function ($request, $response, $args) use ($entityManager) {
    if (!PilotPerm()) {
        return $response->withStatus(302)->withHeader('Location', '/accessDenied');
    }
    $httpMethod = $request->getMethod();
    if ($httpMethod === 'GET') {

        return $this->get('view')->render($response, 'publishCompany.twig', [
        ]);
    } elseif ($httpMethod === 'POST') {
        $data = $request->getParsedBody();

        $name = htmlspecialchars($data['name']);
        $activitySector = htmlspecialchars($data['activitySector']);

        $Company = new \Entity\Company();
        $Company->setName($name);
        $Company->setActivitySector($activitySector);
        $Company->setDel(0);
        try {

            error_log('Before persist');
            $entityManager->persist($Company);
            $entityManager->flush();
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            return $response->withStatus(500);
        }

        return $response->withStatus(302)->withHeader('Location', '/listCompany');
    }
})->setName('publishCompany');


$app->map(['GET', 'POST'], '/creationPilot', function ($request, $response, $args) use ($entityManager) {
    if (!PilotPerm()) {
        return $response->withStatus(302)->withHeader('Location', '/');
    }
    $httpMethod = $request->getMethod();
    if ($httpMethod === 'GET') {
        return $this->get('view')->render($response, 'creationPilot.twig', [
        ]);
    } elseif ($httpMethod === 'POST') {
        $data = $request->getParsedBody();

        $firstName = htmlspecialchars($data['firstName']);
        $lastName = htmlspecialchars($data['lastName']);
//        $type = htmlspecialchars($data['type']);
        $years = htmlspecialchars($data['years']);
        $login = htmlspecialchars($data['login']);
        $password = htmlspecialchars($data['password']);

        $User = new \Entity\User();
        $User->setFirstName($firstName); // Correction ici : $student au lieu de $User
        $User->setLastName($lastName);
        $User->setType(1);
        $User->setYears($years);
        $User->setLogin($login);
        $User->setPassword($password);
        $User->setDel(0);
        $User->setIDAddress(1);

        try {

            error_log('Before persist');
            $entityManager->persist($User);
            $entityManager->flush();
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            return $response->withStatus(500);
        }

        return $response->withStatus(302)->withHeader('Location', '/listPilot');
    }
})->setName('creationPilot');

$app->map(['GET', 'POST'], '/creationStudents', function ($request, $response, $args) use ($entityManager) {
    if (!StudentPerm()) {
        return $response->withStatus(302)->withHeader('Location', '/');
    }
    $httpMethod = $request->getMethod();
    if ($httpMethod === 'GET') {
        return $this->get('view')->render($response, 'creationStudents.twig', [
        ]);
    } elseif ($httpMethod === 'POST') {
        $data = $request->getParsedBody();

        $firstName = htmlspecialchars($data['firstName']);
        $lastName = htmlspecialchars($data['lastName']);
        $type = htmlspecialchars($data['type']);
        $years = htmlspecialchars($data['years']);
        $login = htmlspecialchars($data['login']);
        $password = htmlspecialchars($data['password']);
        $ID_Address = 0;

        $User = new \Entity\User();
        $User->setFirstName($firstName); // Correction ici : $student au lieu de $User
        $User->setLastName($lastName);
        $User->setType(0);
        $User->setYears($years);
        $User->setLogin($login);
        $User->setPassword($password);
        $User->setDel(false);
        $User->setIDAddress(1);

        try {

            error_log('Before persist');
            $entityManager->persist($User);
            $entityManager->flush();
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            return $response->withStatus(500);
        }

        return $response->withStatus(302)->withHeader('Location', '/listStudents');
    }
})->setName('creationStudents');


$app->map(['GET', 'POST'], '/creationOffers', function ($request, $response, $args) use ($entityManager) {
    if (!StudentPerm()) {
        return $response->withStatus(302)->withHeader('Location', '/');
    }
    // Reste du code inchangé
    $httpMethod = $request->getMethod();
    if ($httpMethod === 'GET') {
        return $this->get('view')->render($response, 'creationOffers.twig', [
        ]);
    } elseif ($httpMethod === 'POST') {
        $data = $request->getParsedBody();

        $company = htmlspecialchars($data['company']);
        $targetPromotion = htmlspecialchars($data['targetPromotion']);
        $durationOfInternship = htmlspecialchars($data['durationOfInternship']);
        $payment = htmlspecialchars($data['payment']);
        $offerDate = htmlspecialchars($data['offerDate']);
        $numberOfPlaces = htmlspecialchars($data['numberOfPlaces']);
        $ID_Address = 0;
        $ID_Company = 0;

        $offerDateStr = htmlspecialchars($data['offerDate']);
        $offerDate = DateTime::createFromFormat('Y-m-d', $offerDateStr);

        $Offers = new \Entity\Offers();
        $Offers->setCompany($company); // Correction ici : $student au lieu de $User
        $Offers->setTargetPromotion($targetPromotion);
        $Offers->setDurationOfInternship($durationOfInternship);
        $Offers->setPayment($payment);
        $Offers->setOfferDate($offerDate);
        $Offers->setNumberOfPlaces($numberOfPlaces);
        $Offers->setDel(0);
        $Offers->setIDAddress($ID_Address);
        $Offers->setIDCompany(1);
        $entityManager->persist($Offers);

        try {

            error_log('Before persist');
            $entityManager->flush();
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            return $response->withStatus(500);
        }

        return $response->withStatus(302)->withHeader('Location', '/listOffers');
    }
})->setName('creationOffers ');





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
