<?php

namespace Repository;

use Entity\Campus;
use Repository\AbstractRepository;

class CampusRepository extends AbstractRepository
{
    /**
     * @param int $page
     * @return Campus[]
     */
    public function getPagniatedCampus(int $page): array
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder
            ->select('ca')
            ->from(Campus::class, 'ca')
            ->setFirstResult(($page - 1) * 10)
            ->setMaxResults(10);

        $query = $queryBuilder->getQuery();
        $campuses = $query->getResult();

        /*
        $campusdata = [];

        foreach ($campuses as $campus) {
            $campusdata[] = [$campus->getIDCampus()];
        }
        */

        return $campuses;
    }
}