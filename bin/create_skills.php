<?php
// create_skills.php <nameSkills>
require_once __DIR__ . "/../doctrine/bootstrap.php";

$nameSkills = $argv[1];

$Skills = new \Entity\Skills();
$Skills->setNameSkills($nameSkills);

$entityManager->persist($Skills);
$entityManager->flush();

echo "Created Skills with name " . $Skills->getNameSkills() . "\n";
