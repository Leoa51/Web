<?php
// create_address.php <name>
require_once __DIR__ . "/../doctrine/bootstrap.php";

$newVille = $argv[1];
$newpostal = $argv[2];

$Address = new \Entity\Address();
$Address->setVille($newVille);
$Address->setPostalCode($newpostal);

$entityManager->persist($Address);
$entityManager->flush();

echo "Created Product with ID " . $Address->getIDAddress() . "\n";