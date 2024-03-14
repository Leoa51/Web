<?php
// create_product.php <name>
require_once __DIR__ . "/../doctrine/bootstrap.php";

$newProductName = $argv[1];

$product = new \Entity\Product();
$product->setName($newProductName);

$entityManager->persist($product);
$entityManager->flush();

echo "Created Product with ID " . $product->getId() . "\n";