<?php
// create_postulate.php <ID_User> <ID_Offers> <motivationLetter> <CVname>
require_once __DIR__ . "/../doctrine/bootstrap.php";

$ID_User = $argv[1];
$ID_Offers = $argv[2];
$motivationLetter = $argv[3];
$CVname = $argv[4];

$Postulate = new \Entity\Postulate();
$Postulate->setIDUser($ID_User);
$Postulate->setIDOffers($ID_Offers);
$Postulate->setMotivationLetter($motivationLetter);
$Postulate->setCVname($CVname);

$entityManager->persist($Postulate);
$entityManager->flush();

echo "Created Postulate with ID User " . $Postulate->getIDUser() . " and ID Offers " . $Postulate->getIDOffers() . "\n";
