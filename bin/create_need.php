<?php
// create_need.php <ID_Offers> <nameSkills>
require_once __DIR__ . "/../doctrine/bootstrap.php";

use Entity\Skill;
use Entity\Offers;

$Idoffers = $argv[1];
$nameSkills = $argv[2];

$offer = $entityManager->getRepository(Offers::class)->find($Idoffers);
//$skill = $entityManager->getRepository(Skill::class)->find($nameSkills);


$Need = new \Entity\Need();
$Need->setIDOffers($offer);
$Need->setNameSkills($nameSkills);

$entityManager->persist($Need);
$entityManager->flush();

echo "Created Need with ID Offers " . $Need->getIDOffers() . " and nameSkills " . $Need->getNameSkills() . "\n";
