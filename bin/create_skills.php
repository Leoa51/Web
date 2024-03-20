<?php
// create_skills.php <nameSkills>
require_once __DIR__ . "/../doctrine/bootstrap.php";

use Entity\Skill;

$nameSkills = $argv[1];

echo $nameSkills. "\n";

$Skills = new \Entity\Skill();
$Skills->setNameSkills($nameSkills);

$entityManager->persist($Skills);
try {
    $entityManager->flush();
    echo "Created Skills with ID " . $Skills->getNameSkills() . "\n";
}
catch (\Exception $e) {
    echo "error \n";
    echo $e->getMessage();
}

