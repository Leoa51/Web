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

    public function getIdUser(): int
    {
        return $this->ID_User;
    }

    public function setIdUser(int $ID_User): void
    {
        echo "ID_User = " . $ID_User . "\n";
        $this->ID_User = $ID_User;
    }

    public function getIdOffers(): int
    {
        return $this->ID_Offers;
    }

    public function setIdOffers(int $ID_Offers): void
    {
        echo "ID_Offers = " . $ID_Offers . "\n";
        $this->ID_Offers = $ID_Offers;
    }

    #[ORM\ManyToOne(targetEntity: 'User')]
    #[ORM\JoinColumn(name: 'ID_User', referencedColumnName: 'ID_User')]
    private ?User $user = null;

    #[ORM\ManyToOne(targetEntity: 'Offers')]
    #[ORM\JoinColumn(name: 'ID_Offers', referencedColumnName: 'ID_Offers')]
    private ?Offers $offer = null;

    public function getPutWishlist(): ?bool
    {
        return $this->putWishlist;
    }

    public function setPutWishlist(?bool $putWishlist): void
    {
        echo "putWishlist = " . $putWishlist . "\n";
        $this->putWishlist = $putWishlist;
    }
}
