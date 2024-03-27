<?php

namespace Controller;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Views\Twig;

abstract class AbstractController
{
    protected EntityManager $entityManager;
    protected ContainerInterface $container;
    protected Twig $view;

    // constructor receives container instance
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->entityManager = $container->get(EntityManager::class);
        $this->view = $container->get(Twig::class);
    }

    public function withJson(ResponseInterface $response, $data): ResponseInterface
    {
        $json = json_encode($data);

        // Retourner les offres en JSON dans la réponse HTTP
        $response->getBody()->write($json);
        return $response->withHeader('Content-Type', 'application/json');
    }
}