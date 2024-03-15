<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'campus')]
class Campus
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $ID_Campus = null;

    public function getId(): ?int
    {
        return $this->ID_Campus;
    }

    public function setId(?int $id): void
    {
        $this->ID_Campus = $id;
    }
}
