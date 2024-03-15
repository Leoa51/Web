<?php
// create_editwishlist.php <ID_User> <ID_Offers> <putWishlist>
require_once __DIR__ . "/../doctrine/bootstrap.php";

$Iduser = $argv[1];
$Idoffers = $argv[2];
$putWishlist = $argv[3];

$Editwishlist = new \Entity\Editwishlist();
$Editwishlist->setIDUser($Iduser);
$Editwishlist->setIDOffers($Idoffers);
$Editwishlist->setPutWishlist($putWishlist);

$entityManager->persist($Editwishlist);
$entityManager->flush();

echo "Created Editwishlist with ID User " . $Editwishlist->getIDUser() . " and ID Offers " . $Editwishlist->getIDOffers() . "\n";
