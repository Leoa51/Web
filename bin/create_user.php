<?php
// create_user.php <firstName> <lastName> <Type> <years> <login> <password> <ID_Address> <ID_Campus>
require_once __DIR__ . "/../doctrine/bootstrap.php";

use Entity\Address;
use Entity\Campus;

$firstName = $argv[1];
$lastName = $argv[2];
$Type = $argv[3];
$years = $argv[4];
$login = $argv[5];
$password = $argv[6];
$ID_Address = $argv[7];
$ID_Campus = $argv[8];

echo $firstName . "\n" . $lastName . "\n" . $Type . "\n" . $years . "\n" . $login . "\n" . $password . "\n" . $ID_Address . "\n" . "idcampus : " . $ID_Campus . "\n";

//try {
//    $address = $entityManager->getRepository(Address::class)->find($ID_Address);
////    echo "address : " . $address->getIDAddress() . " " . $address->getVille() . "\n";
//} catch (\Exception $e) {
//    echo "error \n";
//    echo $e->getMessage();
//    $holder = new Address();
//    $holder->setIDAddress(1);
//    $holder->setVille("");
//    $holder->setPostalCode(0);
//}


//$campus = $entityManager->getRepository(Campus::class)->find($ID_Campus);
//echo "campus : " . $campus->getIDCampus() . "\n";

$User = new \Entity\User();
$User->setFirstName($firstName);
$User->setLastName($lastName);
$User->setType($Type);
$User->setYears($years);
$User->setLogin($login);
$User->setPassword($password);
$User->setIDAddress($ID_Address);
$User->setIDCampus(1);
$User->setDel(false);

$entityManager->persist($User);
try {
    $entityManager->flush();
    echo "Created User with ID " . $User->getIDUser() . "\n";
} catch (\Exception $e) {
    echo "error \n";
    echo $e->getMessage();
}