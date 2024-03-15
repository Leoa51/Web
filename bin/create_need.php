<?php
// create_need.php <ID_Offers> <nameSkills>
require_once __DIR__ . "/../doctrine/bootstrap.php";

$offerId = $argv[1];
$nameSkills = $argv[2];

$Need = new \Entity\Need();
$Need->setIDOffers($offerId);
$Need->setNameSkills($nameSkills);

$entityManager->persist($Need);
$entityManager->flush();

echo "Created Need with ID Offers " . $Need->getIDOffers() . " and nameSkills " . $Need->getNameSkills() . "\n";