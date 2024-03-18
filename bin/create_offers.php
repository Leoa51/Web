<?php
// create_offers.php <company> <targetPromotion> <durationOfInternship> <payment> <offerDate> <numberOfPlaces> <ID_Address> <ID_Company>
require_once __DIR__ . "/../doctrine/bootstrap.php";
use Entity\Address;
use Entity\Company;


$company = $argv[1];
$targetPromotion = $argv[2];
$durationOfInternship = $argv[3];
$payment = $argv[4];
$offerDate = new \DateTime($argv[5]);
$numberOfPlaces = $argv[6];
$ID_Address = $argv[7];
$ID_Company = $argv[8];


$address = $entityManager->getRepository(Address::class)->find($ID_Address);
$companyEntity = $entityManager->getRepository(Company::class)->find($ID_Company);

if ($address == null ) {
    echo "Address not found\n";
    exit();
}
if ($companyEntity == null) {
    echo "Company not found\n";
    exit();
}
$Offers = new \Entity\Offers();
$Offers->setCompany($company);
$Offers->setTargetPromotion($targetPromotion);
$Offers->setDurationOfInternship($durationOfInternship);
$Offers->setPayment($payment);
$Offers->setOfferDate($offerDate);
$Offers->setNumberOfPlaces($numberOfPlaces);
$Offers->setIDAddress($address);
$Offers->setIDCompany($companyEntity);

$entityManager->persist($Offers);
$entityManager->flush();

echo "Created Offers with ID " . $Offers->getIDOffers() . "\n";
