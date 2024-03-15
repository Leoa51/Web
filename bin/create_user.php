<?php
// create_user.php <firstName> <lastName> <Type> <years> <login> <password> <ID_Address> <ID_Campus>
require_once __DIR__ . "/../doctrine/bootstrap.php";

$firstName = $argv[1];
$lastName = $argv[2];
$Type = $argv[3];
$years = $argv[4];
$login = $argv[5];
$password = $argv[6];
$ID_Address = $argv[7];
$ID_Campus = $argv[8];

$User = new \Entity\User_();
$User->setFirstName($firstName);
$User->setLastName($lastName);
$User->setType($Type);
$User->setYears($years);
$User->setLogin($login);
$User->setPassword($password);
$User->setIDAddress($ID_Address);
$User->setIDCampus($ID_Campus);

$entityManager->persist($User);
$entityManager->flush();

echo "Created User with ID " . $User->getIDUser() . "\n";
