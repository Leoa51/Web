<?php
// create_company.php <name> <activitySector> <stats> <opinion> <mark>
require_once __DIR__ . "/../doctrine/bootstrap.php";

$newName = $argv[1];
$newActivitySector = $argv[2];
$newStats = $argv[3];
$newOpinion = $argv[4];
$newMark = $argv[5];

$Company = new \Entity\Company();
$Company->setName($newName);
$Company->setActivitySector($newActivitySector);
$Company->setStats($newStats);
$Company->setOpinion($newOpinion);
$Company->setMark($newMark);

$entityManager->persist($Company);
$entityManager->flush();

echo "Created Company with ID " . $Company->getId() . "\n";
