<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'postulate')]
class Postulate
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    private int $ID_User;

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    private int $ID_Offers;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $motivationLetter = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $CVname = null;

    public function getUserId(): int
    {
        return $this->ID_User;
    }

    public function setUserId(int $ID_User): void
    {
        $this->ID_User = $ID_User;
    }

    public function getOfferId(): int
    {
        return $this->ID_Offers;
    }

    public function setOfferId(int $ID_Offers): void
    {
        $this->ID_Offers = $ID_Offers;
    }

    public function getMotivationLetter(): ?string
    {
        return $this->motivationLetter;
    }

    public function setMotivationLetter(?string $motivationLetter): void
    {
        $this->motivationLetter = $motivationLetter;
    }

    public function getCVName(): ?string
    {
        return $this->CVname;
    }

    public function setCVName(?string $CVname): void
    {
        $this->CVname = $CVname;
    }
}
