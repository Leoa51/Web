<?php


require_once __DIR__ . "/../doctrine/bootstrap.php";

// ListPilotes / ListStudents

$query = $entityManager->createQuery('SELECT u FROM Entity\User u WHERE u.type = 2 ');
$users = $query->getResult();
$data = [];

foreach ( $users as $user ) {
    try {
        $query = $entityManager->createQuery('SELECT u FROM Entity\Address u WHERE u.ID_address ='. $user->getIDAddress() );
        $address = $query->getResult();
        $ville = $address[0]->getVille();
    }
    catch (\Exception $e) {
        $ville = "null";
    }
    $data[] = [$user->getLastName(), $user->getFirstName(), $ville, $user->getYears()];
}




// ListAddress
$query = $entityManager->createQuery('SELECT u FROM Entity\Address u');
$addresses = $query->getResult();

$addressdata = [];

foreach ( $addresses as $address ) {
    $addressdata[] = [$address->getIDAddress(), $address->getVille() , $address->getPostalCode()];
}



// ListCampus
$query = $entityManager->createQuery('SELECT u FROM Entity\Campus u');
$campuses = $query->getResult();

$campusdata = [];

foreach ( $campuses as $campus ) {
    $campusdata[] = [$campus->getIDCampus()];
}


// ListCompany
$query = $entityManager->createQuery('SELECT u FROM Entity\Company u');
$companies = $query->getResult();

$companydata = [];

foreach ( $companies as $company ) {
    $companydata[] = [$company->getIDCompany(), $company->getName(), $company->getActivitySector(), $company->getStats(), $company->getOpinion(), $company->getMark(), $company->getNumberOfWishlist(), $company->getNumberOfPostulation()];
}


// @TODO : Editwishlist
// @ TODO : Need


// ListOffers
$query = $entityManager->createQuery('SELECT u FROM Entity\Offers u');
$offers = $query->getResult();

$offersdata = [];

foreach ( $offers as $offer ) {
    $offersdata[] = [$offer->getIDOffers(), $offer->getTargetPromotion(), $offer->getDurationOfInternship(), $offer->getPayment(), $offer->getOfferDate(), $offer->getNumberOfPlaces()];
}



// ListPostulate
$query = $entityManager->createQuery('SELECT u FROM Entity\Postulate u');
$postulates = $query->getResult();

$postulatedata = [];

foreach ( $postulates as $postulate ) {
    $postulatedata[] = [$postulate->getIDUser(), $postulate->getIDOffers(), $postulate->getMotivationLetter(), $postulate->getCVName()];
}


//ListUser
$query = $entityManager->createQuery('SELECT u FROM Entity\User u');
$users = $query->getResult();

$userdata = [];

foreach ( $users as $user ) {
    $userdata[] = [$user->getIDUser(), $user->getFirstName(), $user->getLastName(), $user->getType(), $user->getYears(), $user->getLogin(), $user->getPassword()];
}