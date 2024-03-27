<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'campus')]
class Campus implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    public int|null $ID_Campus = null;

    public function getIDCampus(): ?int
    {
        return $this->ID_Campus;
    }

    public function setIDCampus(?int $id): void
    {
        echo 'set id : ' . $id . "\n";
        $this->ID_Campus = $id;
    }

    #[\Override] public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}
