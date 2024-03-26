<?php

require_once __DIR__ . "/../doctrine/bootstrap.php";


//function ListUser ($entityManager)
//{
//    $queryBuilder = $entityManager->createQueryBuilder();
//    $queryBuilder
//        ->select('u')
//        ->from('Entity\User', 'u')
//
//    $query = $queryBuilder->getQuery();
//    $users = $query->getResult();
//
//    $data = [];
//
//    foreach ($users as $user) {
//        try {
//            $queryBuilder = $entityManager->createQueryBuilder();
//            $queryBuilder
//                ->select('a')
//                ->from('Entity\Address', 'a')
//                ->where('a.ID_address = :idAddress')
//                ->setParameter('idAddress', $user->getIDAddress());
//
//            $query = $queryBuilder->getQuery();
//            $address = $query->getResult();
//            $ville = $address[0]->getVille();
//        } catch (\Exception $e) {
//            $ville = "null";
//        }
//        $data[] = [$user->getLastName(), $user->getFirstName(), $ville, $user->getYears()];
//    }
//}

function ListUser ($entityManager)
{
    $queryBuilder = $entityManager->createQueryBuilder();
    $queryBuilder
        ->select('u')
        ->from('Entity\User', 'u');

    $query = $queryBuilder->getQuery();
    $users = $query->getResult();

    $userdata = [];

    foreach ($users as $user) {
        $userdata[] = [$user->getIDUser(), $user->getFirstName(), $user->getLastName(), $user->getType(), $user->getYears(), $user->getLogin(), $user->getPassword()];
    }

    return $userdata;
}

function ListPilot ($entityManager)
{
    $queryBuilder = $entityManager->createQueryBuilder();
    $queryBuilder
        ->select('u')
        ->from('Entity\User', 'u')
        ->where('u.type = 2');

    $query = $queryBuilder->getQuery();
    $users = $query->getResult();

    $data = [];

    foreach ($users as $user) {
        try {
            $queryBuilder = $entityManager->createQueryBuilder();
            $queryBuilder
                ->select('a')
                ->from('Entity\Address', 'a')
                ->where('a.ID_address = :idAddress')
                ->setParameter('idAddress', $user->getIDAddress());

            $query = $queryBuilder->getQuery();
            $address = $query->getResult();
            $ville = $address[0]->getVille();
        } catch (\Exception $e) {
            $ville = "null";
        }
        $data[] = [$user->getLastName(), $user->getFirstName(), $ville, $user->getYears()];
    }

    return $data;
}


function ListAddress($entityManager){
    $queryBuilder = $entityManager->createQueryBuilder();
    $queryBuilder
        ->select('a')
        ->from('Entity\Address', 'a');

    $query = $queryBuilder->getQuery();
    $addresses = $query->getResult();

    $addressdata = [];

    foreach ($addresses as $address) {
        $addressdata[] = [$address->getIDAddress(), $address->getVille(), $address->getPostalCode()];
    }

    return $addressdata;
}



function ListCampus($entityManager){
    $queryBuilder = $entityManager->createQueryBuilder();
    $queryBuilder
        ->select('ca')
        ->from('Entity\Campus', 'ca');

    $query = $queryBuilder->getQuery();
    $campuses = $query->getResult();

    $campusdata = [];

    foreach ($campuses as $campus) {
        $campusdata[] = [$campus->getIDCampus()];
    }

    return $campusdata;
}

function ListCompany($entityManager){
    $queryBuilder = $entityManager->createQueryBuilder();
    $queryBuilder
        ->select('co')
        ->from('Entity\Company', 'co');

    $query = $queryBuilder->getQuery();
    $companies = $query->getResult();

    $companydata = [];

    foreach ($companies as $company) {
        $companydata[] = [$company->getIDCompany(), $company->getName(), $company->getActivitySector(), $company->getStats(), $company->getOpinion(), $company->getMark(), $company->getNumberOfWishlist(), $company->getNumberOfPostulation()];
    }

    return $companydata;

}

function ListOffers($entityManager){
    $queryBuilder = $entityManager->createQueryBuilder();
    $queryBuilder
        ->select('o')
        ->from('Entity\Offers', 'o');

    $query = $queryBuilder->getQuery();
    $offers = $query->getResult();

    $offersdata = [];


    foreach ($offers as $offer) {
        $offersdata[] = [$offer->getIDOffers(), $offer->getTargetPromotion(), $offer->getDurationOfInternship(), $offer->getPayment(), $offer->getOfferDate(), $offer->getNumberOfPlaces()];
    }

    return $offersdata;

}

function ListPostulate ($entityManager)
{
    $queryBuilder = $entityManager->createQueryBuilder();
    $queryBuilder
        ->select('p')
        ->from('Entity\Postulate', 'p');

    $query = $queryBuilder->getQuery();
    $postulates = $query->getResult();

    $postulatedata = [];

    foreach ($postulates as $postulate) {
        $postulatedata[] = [$postulate->getIDUser(), $postulate->getIDOffers(), $postulate->getMotivationLetter(), $postulate->getCVName()];
    }

    return $postulatedata;

}



// ListUser

