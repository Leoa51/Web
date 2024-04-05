<?php
// create_offers.php <company> <targetPromotion> <durationOfInternship> <payment> <offerDate> <numberOfPlaces> <ID_Address> <ID_Company>
require_once __DIR__ . "/../doctrine/bootstrap.php";
use Entity\Address;
use Entity\Company;


// Récupération des arguments en ligne de commande
$company = $argv[1];
$targetPromotion = $argv[2];
$durationOfInternship = $argv[3];
$payment = $argv[4];
$offerDate = $argv[5];
$numberOfPlaces = $argv[6];
$ID_Address = $argv[7];
$ID_Company = $argv[8];

// Affichage des arguments pour vérification
echo $company . "\n" . $targetPromotion . "\n" . $durationOfInternship . "\n" . $payment . "\n" . $offerDate . "\n" . $numberOfPlaces . "\n" . $ID_Address . "\n" . "idcompany : " . $ID_Company . "\n";

// Création d'un objet DateTime pour la date d'offre
$offerDateObj = new DateTime($offerDate);

// Création de l'entité Offers
$Offers = new \Entity\Offers();
$Offers->setCompany($company);
$Offers->setTargetPromotion($targetPromotion);
$Offers->setDurationOfInternship($durationOfInternship);
$Offers->setPayment($payment);
$Offers->setOfferDate($offerDateObj); // Assignation de l'objet DateTime
$Offers->setNumberOfPlaces($numberOfPlaces);
$Offers->setIDAddress($ID_Address);
$Offers->setIDCompany($ID_Company);

// Persistance de l'entité Offers
$entityManager->persist($Offers);
try {
    $entityManager->flush();
    echo "Created Offers with ID " . $Offers->getIDOffers() . "\n";
} catch (\Exception $e) {
    echo "error \n";
    echo $e->getMessage();
}
