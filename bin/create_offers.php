<?php
// create_offers.php <company> <targetPromotion> <durationOfInternship> <payment> <offerDate> <numberOfPlaces> <ID_Address> <ID_Company>
require_once __DIR__ . "/../doctrine/bootstrap.php";

$company = $argv[1];
$targetPromotion = $argv[2];
$durationOfInternship = $argv[3];
$payment = $argv[4];
$offerDate = new \DateTime($argv[5]);
$numberOfPlaces = $argv[6];
$ID_Address = $argv[7];
$ID_Company = $argv[8];

$Offers = new \Entity\Offers();
$Offers->setCompany($company);
$Offers->setTargetPromotion($targetPromotion);
$Offers->setDurationOfInternship($durationOfInternship);
$Offers->setPayment($payment);
$Offers->setOfferDate($offerDate);
$Offers->setNumberOfPlaces($numberOfPlaces);
$Offers->setIDAddress($ID_Address);
$Offers->setIDCompany($ID_Company);

$entityManager->persist($Offers);
$entityManager->flush();

echo "Created Offers with ID " . $Offers->getIDOffers() . "\n";
