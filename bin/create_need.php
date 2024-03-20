<?php
// create_need.php <ID_Offers> <nameSkills>
require_once __DIR__ . "/../doctrine/bootstrap.php";

use Entity\Skill;
use Entity\Offers;

$IDoffers = $argv[1];
$nameSkills = $argv[2];



echo $IDoffers . "\n" . $nameSkills . "\n";

//$offer = $entityManager->getRepository(Offers::class)->find($IDoffers);
//$skill = $entityManager->getRepository(Skill::class)->find($nameSkills);


$Need = new \Entity\Need();
$Need->setIDOffers($IDoffers);
$Need->setNameSkills($nameSkills);

$entityManager->persist($Need);

try {
    $entityManager->flush();
    echo "Created Need with ID Offers " . $Need->getIDOffers() . " and nameSkills " . $Need->getNameSkills();
}
catch (\Exception $e) {
    echo "error \n";
    echo $e->getMessage();
}

