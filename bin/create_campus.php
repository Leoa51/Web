<?php
// create_campus.php <name>
require_once __DIR__ . "/../doctrine/bootstrap.php";


$Campus = new \Entity\Campus();

$entityManager->persist($Campus);
$entityManager->flush();

echo "Created Campus with ID " . $Campus->getIDCampus() . "\n";
