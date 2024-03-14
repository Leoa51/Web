<?php
// bootstrap.php
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once __DIR__ . "/../vendor/autoload.php";
//echo DIR . "/src";
// Create a simple "default" Doctrine ORM configuration for Attributes
$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: array(__DIR__ . "/../src/Entity"),
    isDevMode: true,
);
// or if you prefer XML
// $config = ORMSetup::createXMLMetadataConfiguration(
//    paths: array(_DIR."/config/xml"),
//    isDevMode: true,
//);

// configuring the database connection
$connection = DriverManager::getConnection([
    'driver' => 'pdo_mysql',
    'dbname' => 'test',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost',
], $config);

// obtaining the entity manager
$entityManager = new EntityManager($connection, $config);