<?php

namespace Controller;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Repository\CampusRepository;

class CampusController extends AbstractController
{
    private CampusRepository $campusRepository;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->campusRepository = new CampusRepository($container);

    }

    public function getCampus(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        return $this->withJson($response, $this->campusRepository->getPagniatedCampus($args['page']));
    }

    public function showCampusList(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        return $this->view->render($response, 'campus.test.twig', [
            'campuses' => $this->campusRepository->getPagniatedCampus(1)
        ]);
    }


}