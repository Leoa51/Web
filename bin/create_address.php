<?php
// create_address.php <name>
require_once __DIR__ . "/../doctrine/bootstrap.php";

$newVille = $argv[1];
$newpostal = $argv[2];

//echo \DI\string($newVille . "\n");
//echo \DI\string($newpostal . "\n");

$Address = new \Entity\Address();
$Address->setVille($newVille);
$Address->setPostalCode($newpostal);



$entityManager->persist($Address);
$entityManager->flush();
error_log( "Created Product with ID " . $Address->getIDAddress() . "\n");