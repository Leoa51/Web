<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'skills')]
class Skill
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 50)]
    private string $nameSkills;

    public function getNameSkills(): string
    {
        return $this->nameSkills;
    }

    public function setNameSkills(string $nameSkills): void
    {
        $this->nameSkills = $nameSkills;
    }
}
