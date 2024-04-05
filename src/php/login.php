<?php

require_once __DIR__ . "/../doctrine/bootstrap.php";

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


            if ($user['type'] == "2") {
//                        setcookie('type', "Admin", time() + (10 * 60), "/");
                $_SESSION['type'] = "Admin";
                header('Location: /ProfilAdmin');
            } elseif ($user['type'] == "1") {
//                        setcookie('type', "Pilot", time() + (10 * 60), "/");
                $_SESSION['type'] = "Pilot";
                header('Location: /ProfilPilot');
            } elseif ($user['type'] == "0") {
//                        setcookie('type', "Student", time() + (10 * 60), "/");
                $_SESSION['type'] = "Student";
                header('Location: /ProfilStudents');
            }

        }
    }
    header('Location: /login');
}
