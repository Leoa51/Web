<?php

use Entity\Company;
use Entity\Offers;
use Entity\Address;


require_once __DIR__ . "/../doctrine/bootstrap.php";
$centers = array("erreur", "Reims", "Lyon", "Paris", "Nantes", "Strasbourg", "Bordeaux", "Toulouse", "Rennes", "Lille", "Marseille", "Tunis", "Narbonne", "Clermont-Ferrand", "Aix-en-Provence", "Marseille", "Lorient", "Villeurbanne", "Brest", "Nancy", "Montpellier");

function StudentPerm()
{
    if (isset($_SESSION) && ($_SESSION['type'] == "Student" || $_SESSION['type'] == "Pilot" || $_SESSION['type'] == "Admin")) {
        return true;
    } else {
        return false;
    }
}

function PilotPerm()
{
    if (isset($_SESSION) && ($_SESSION['type'] == "Pilot" || $_SESSION['type'] == "Admin")) {
        return true;
    } else {
        echo "access denied"; //@todo retourner une erreur
        return false;
    }
}

function AdminPerm()
{
    if (isset($_SESSION) && $_SESSION['type'] == "Admin") {
        return true;
    } else {
        echo "access denied"; //@todo retourner une erreur
        return false;
    }
}

function SpecialPerm()
{
    if (isset($_SESSION) && ($_SESSION['type'] == "Student" || $_SESSION['type'] == "Admin")) {
        return true;
    } else {
        echo "access denied"; //@todo retourner une erreur
        return false;
    }
}


function StatsCompany($entityManager, $page)
{
    $queryBuilder = $entityManager->createQueryBuilder();
    $queryBuilder
        ->select('company.name', 'company.activitySector', 'company.stats', 'address.ville')
        ->from(Company::class, 'company')
        ->leftJoin(Offers::class, 'offers', 'WITH', 'offers.ID_Company = company.ID_Company')
        ->leftJoin(Address::class, 'address', 'WITH', 'address.ID_Address = offers.ID_Address')
        ->setFirstResult(($page - 1) * 10)
        ->setMaxResults(10)
        ->orderBy('company.stats', 'ASC')
        ->where('company.del = 0');

    $query = $queryBuilder->getQuery();
    $companies = $query->getResult();

    $totalCompanies = $entityManager->createQueryBuilder()
        ->select('COUNT(company.ID_Company)')
        ->from(Company::class, 'company')
        ->where('company.del = 0')
        ->getQuery()
        ->getSingleScalarResult();


    return ['companies' => $companies, 'totalCompanies' => $totalCompanies];

//    return $companies;
}

//$var = StatsCompany($entityManager, 1);
//var_dump($var);

function ListAddress($entityManager, $ville, $postalcode)
{
    $queryBuilder = $entityManager->createQueryBuilder();
    $queryBuilder
        ->select('a')
        ->from('Entity\Address', 'a');
    if ($ville !== null) {
        error_log($ville . "\n");
        $queryBuilder
            ->where('a.ville = :ville')
            ->setParameter('ville', $ville);
    }
    if ($postalcode !== null) {
        error_log($postalcode . "\n");
        $queryBuilder
            ->andWhere('a.postalCode = :postalCode')
            ->setParameter('postalCode', $postalcode);
    }


    $query = $queryBuilder->getQuery();
    $addresses = $query->getResult();

    $addressdata = [];

    foreach ($addresses as $address) {
        $addressdata[] = [$address->getIDAddress(), $address->getVille(), $address->getPostalCode()];
    }

    return $addressdata;
}


function ListCompany($entityManager, $id, $name, $activitySector, $stats, $del, $invisibleForStudents, $opinion, $mark, $numberOfWishlist, $numberOfPostulation)
{
    $queryBuilder = $entityManager->createQueryBuilder();
    $queryBuilder
        ->select('co')
        ->from('Entity\Company', 'co');
    if ($id !== null) {
        error_log($id . "\n");
        $queryBuilder
            ->where('co.ID_Company = :id')
            ->setParameter('id', $id);
    }
    if ($name !== null) {
        error_log($name . "\n");
        $queryBuilder
            ->where('co.name = :name')
            ->setParameter('name', $name);
    }
    if ($activitySector !== null) {
        error_log($activitySector . "\n");
        $queryBuilder
            ->andWhere('co.activitySector = :activitySector')
            ->setParameter('activitySector', $activitySector);
    }
    if ($stats !== null) {
        error_log($stats . "\n");
        $queryBuilder
            ->andWhere('co.stats = :stats')
            ->setParameter('stats', $stats);
    }
    if ($del !== null) {
        error_log($del . "\n");
        $queryBuilder
            ->andWhere('co.del = :del')
            ->setParameter('del', $del);
    }
    if ($mark !== null) {
        error_log($mark . "\n");
        $queryBuilder
            ->where('co.mark = :mark')
            ->setParameter('mark', $mark);
    }
    if ($invisibleForStudents !== null) {
        error_log($invisibleForStudents . "\n");
        $queryBuilder
            ->andWhere('co.invisibleForStudents = :invisibleForStudents')
            ->setParameter('invisibleForStudents', $invisibleForStudents);
    }
    if ($opinion !== null) {
        error_log($opinion . "\n");
        $queryBuilder
            ->andWhere('co.opinion = :opinion')
            ->setParameter('opinion', $opinion);
    }
    if ($numberOfWishlist !== null) {
        error_log($numberOfWishlist . "\n");
        $queryBuilder
            ->andWhere('co.numberOfWishlist = :numberOfWishlist')
            ->setParameter('numberOfWishlist', $numberOfWishlist);
    }
    if ($numberOfPostulation !== null) {
        error_log($numberOfPostulation . "\n");
        $queryBuilder
            ->andWhere('co.numberOfPostulation = :numberOfPostulation')
            ->setParameter('numberOfPostulation', $numberOfPostulation);
    }
    $query = $queryBuilder->getQuery();
    $companies = $query->getResult();

    $companydata = [];

    foreach ($companies as $company) {
        $companydata[] = [$company->getIDCompany(), $company->getName(), $company->getActivitySector(), $company->getStats(), $company->getOpinion(), $company->getMark(), $company->getNumberOfWishlist(), $company->getNumberOfPostulation()];
    }

    return $companydata;

}

function ListOffers($entityManager, $ID_Offers, $company, $targetPromotion, $durationOfInternship, $payment, $offerDate, $numberOfPlaces, $del, $ID_Address, $ID_Company)
{
    $queryBuilder = $entityManager->createQueryBuilder();
    $queryBuilder
        ->select('o')
        ->from('Entity\Offers', 'o');

    if ($ID_Offers !== null) {
        error_log($ID_Offers . "\n");
        $queryBuilder
            ->where('o.ID_Offers = :IDOffers')
            ->setParameter('IDOffers', $ID_Offers);
    }
    if ($company !== null) {
        error_log($company . "\n");
        $queryBuilder
            ->andWhere('o.company = :company')
            ->setParameter('company', $company);
    }
    if ($targetPromotion !== null) {
        error_log($targetPromotion . "\n");
        $queryBuilder
            ->andWhere('o.targetPromotion = :targetPromotion')
            ->setParameter('targetPromotion', $targetPromotion);
    }
    if ($durationOfInternship !== null) {
        error_log($durationOfInternship . "\n");
        $queryBuilder
            ->andWhere('o.durationOfInternship = :durationOfInternship')
            ->setParameter('durationOfInternship', $durationOfInternship);
    }
    if ($payment !== null) {
        error_log($payment . "\n");
        $queryBuilder
            ->andWhere('o.payment = :payment')
            ->setParameter('payment', $payment);
    }
    if ($offerDate !== null) {
        error_log($offerDate . "\n");
        $queryBuilder
            ->andWhere('o.offerDate = :offerDate')
            ->setParameter('offerDate', $offerDate);
    }
    if ($numberOfPlaces !== null) {
        error_log($numberOfPlaces . "\n");
        $queryBuilder
            ->andWhere('o.numberOfPlaces = :numberOfPlaces')
            ->setParameter('numberOfPlaces', $numberOfPlaces);
    }
    if ($del !== null) {
        error_log($del . "\n");
        $queryBuilder
            ->andWhere('o.del = :del')
            ->setParameter('del', $del);
    }
    if ($ID_Address !== null) {
        error_log($ID_Address . "\n");
        $queryBuilder
            ->andWhere('o.ID_Address = :IDAddress')
            ->setParameter('IDAddress', $ID_Address);
    }
    if ($ID_Company !== null) {
        error_log($ID_Company . "\n");
        $queryBuilder
            ->andWhere('o.ID_Company = :IDCompany')
            ->setParameter('IDCompany', $ID_Company);
    }

    $query = $queryBuilder->getQuery();
    $offers = $query->getResult();

    $offersdata = [];


    foreach ($offers as $offer) {
        $offersdata[] = [$offer->getIDOffers(), $offer->getTargetPromotion(), $offer->getDurationOfInternship(), $offer->getPayment(), $offer->getOfferDate(), $offer->getNumberOfPlaces()];
    }

    return $offersdata;

}

function ListPostulate($entityManager)
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
function ListUser($entityManager, $ID_User, $firstname, $lastname, $type, $years, $login, $password, $del, $ID_Address, $ID_Campus)
{
    $queryBuilder = $entityManager->createQueryBuilder();
    $queryBuilder
        ->select('u')
        ->from('Entity\User', 'u');

    if ($ID_User !== null) {
        error_log($ID_User . "\n");
        $queryBuilder
            ->where('u.ID_User = :IDUser')
            ->setParameter('IDUser', $ID_User);
    }
    if ($firstname !== null) {
        error_log($firstname . "\n");
        $queryBuilder
            ->andWhere('u.firstname = :firstname')
            ->setParameter('firstname', $firstname);
    }
    if ($lastname !== null) {
        error_log($lastname . "\n");
        $queryBuilder
            ->andWhere('u.lastname = :lastname')
            ->setParameter('lastname', $lastname);
    }
    if ($type !== null) {
        error_log($type . "\n");
        $queryBuilder
            ->andWhere('u.type = :type')
            ->setParameter('type', $type);
    }
    if ($years !== null) {
        error_log($years . "\n");
        $queryBuilder
            ->andWhere('u.years = :years')
            ->setParameter('years', $years);
    }
    if ($login !== null) {
        error_log($login . "\n");
        $queryBuilder
            ->andWhere('u.login = :login')
            ->setParameter('login', $login);
    }
//    @todo hash password
    if ($password !== null) {
        error_log($password . "\n");
        $queryBuilder
            ->andWhere('u.password = :password')
            ->setParameter('password', $password);
    }
    if ($del !== null) {
        error_log($del . "\n");
        $queryBuilder
            ->andWhere('u.del = :del')
            ->setParameter('del', $del);
    }
    if ($ID_Address !== null) {
        error_log($ID_Address . "\n");
        $queryBuilder
            ->andWhere('u.ID_Address = :IDAddress')
            ->setParameter('IDAddress', $ID_Address);
    }
    if ($ID_Campus !== null) {
        error_log($ID_Campus . "\n");
        $queryBuilder
            ->andWhere('u.ID_Campus = :IDCampus')
            ->setParameter('IDCampus', $ID_Campus);
    }

    $query = $queryBuilder->getQuery();
    $users = $query->getResult();

    $userdata = [];

    foreach ($users as $user) {
        $userdata[] = [$user->getIDUser(), $user->getFirstName(), $user->getLastName(), $user->getType(), $user->getYears(), $user->getLogin(), $user->getPassword()];
    }

    return $userdata;
}

function ListPilot($entityManager)
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





