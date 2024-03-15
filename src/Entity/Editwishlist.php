<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'editwishlist')]
class EditWishlist
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    private int $ID_User;

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    private int $ID_Offers;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $putWishlist = null;

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

    public function getPutWishlist(): ?bool
    {
        return $this->putWishlist;
    }

    public function setPutWishlist(?bool $putWishlist): void
    {
        $this->putWishlist = $putWishlist;
    }
}
