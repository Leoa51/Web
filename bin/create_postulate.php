<?php
// create_postulate.php <ID_User> <ID_Offers> <motivationLetter> <CVname>
require_once __DIR__ . "/../doctrine/bootstrap.php";

//use Entity\User;
//use Entity\Offers;

$ID_User = $argv[1];
$ID_Offers = $argv[2];
$motivationLetter = $argv[3];
$CVname = $argv[4];

//$user = $entityManager->getRepository(User::class)->find($ID_User);
//$offer = $entityManager->getRepository(Offers::class)->find($ID_Offers);

$Postulate = new \Entity\Postulate();
$Postulate->setIDUser($ID_User);
$Postulate->setIDOffers($ID_Offers);
//$Postulate->setIDUser($user);
//$Postulate->setIDOffers($offer);
$Postulate->setMotivationLetter($motivationLetter);
$Postulate->setCVname($CVname);

$entityManager->persist($Postulate);
$entityManager->flush();

echo "Created Postulate with ID User " . $Postulate->getIDUser() . " and ID Offers " . $Postulate->getIDOffers() . "\n";
