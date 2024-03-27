<?php

require_once 'vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use App\Entity\User;

$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;
$config = Setup::createAnnotationMetadataConfiguration([__DIR__ . "/src/Entity"], $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);
$entityManager = EntityManager::create([
    'dbname' => 'test',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
], $config);

function login(string $login, string $password): array
{
    global $entityManager;

    $user = $entityManager->getRepository(User::class)->findOneBy(['login' => $login]);

    if (!$user) {
        return ['result' => 'Utilisateur introuvable'];
    }

    if (!password_verify($password, $user->getPassword())) {
        return ['result' => 'Mot de passe incorrect'];
    }

    $userType = $user->getUserType();

    return ['result' => 'Connexion réussie', 'userType' => $userType];
}

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['login']) || !isset($data['password'])) {
    echo json_encode(['error' => 'Email et mot de passe requis']);
    exit;
}

$login = $data['login'];
$password = $data['password'];

$result = login($login, $password);

echo json_encode($result);
