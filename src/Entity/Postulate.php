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

    #[ORM\Column(type: 'string', length: 50)]
    private ?string $motivationLetter;

    #[ORM\Column(type: 'string', length: 50)]
    private ?string $CVname;

    public function getIDUser(): int
    {
        return $this->ID_User;
    }

    public function setIDUser(int $ID_User): void
    {
        echo 'set ID_User : ' . $ID_User . "\n";
        $this->ID_User = $ID_User;
    }

    public function getIDOffers(): int
    {
        return $this->ID_Offers;
    }

    public function setIDOffers(int $ID_Offers): void
    {
        echo 'set ID_Offers : ' . $ID_Offers . "\n";
        $this->ID_Offers = $ID_Offers;
    }

    public function getMotivationLetter(): ?string
    {
        return $this->motivationLetter;
    }

    public function setMotivationLetter(?string $motivationLetter): void
    {
        echo 'set motivationLetter : ' . $motivationLetter . "\n";
        $this->motivationLetter = $motivationLetter;
    }

    public function getCVName(): ?string
    {
        return $this->CVname;
    }

    public function setCVName(?string $CVname): void
    {
        echo 'set CVname : ' . $CVname . "\n";
        $this->CVname = $CVname;
    }
}
