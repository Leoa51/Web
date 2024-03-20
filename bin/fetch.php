<?php
require_once __DIR__ . "/../doctrine/bootstrap.php";

$query = $entityManager->createQuery('SELECT u FROM Entity\User u WHERE u.ID_User = 1');
$users = $query->getResult();
echo $users[0]->getLastName();