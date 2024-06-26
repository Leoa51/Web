<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'address')]
class Address
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int $ID_Address;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $ville = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $postalCode = null;

    public function getIDAddress(): ?int
    {
        return $this->ID_Address;
    }

    public function setIDAddress(int $ID_Address): void
    {
        error_log('set IDAddress : ' . $ID_Address . "\n");
        $this->ID_Address = $ID_Address;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): void
    {
        error_log('set ville : ' . $ville . "\n");
        $this->ville = $ville;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(?int $postalCode): void
    {
        error_log('set postalCode : ' . $postalCode . "\n");
        $this->postalCode = $postalCode;
    }
}
