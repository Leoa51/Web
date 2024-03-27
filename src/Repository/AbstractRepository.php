<?php

namespace Repository;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

abstract class AbstractRepository
{
    protected EntityManager $entityManager;
    protected ContainerInterface $container;
    

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->entityManager = $container->get(EntityManager::class);
    }
}