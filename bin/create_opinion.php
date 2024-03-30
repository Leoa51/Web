<?php


// create_company.php <name> <activitySector> <stats> <opinion> <mark>
require_once __DIR__ . "/../doctrine/bootstrap.php";

$ID_Company = $argv[1];
$opinion = $argv[2];
$sender = $argv[3];
$mark = $argv[4];


$Opinion = new \Entity\Opinion();
$Opinion->setIDCompany($ID_Company);
$Opinion->setOpinion($opinion);
$Opinion->setSender($sender);
$Opinion->setMark($mark);

$entityManager->persist($Opinion);
$entityManager->flush();

echo "Created Opinion with ID " . $Opinion->getIDOpinion() . "\n";

