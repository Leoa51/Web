<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'user_')]
class User
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $ID_User = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $firstName = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $lastName = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $type = null;

    #[ORM\Column(type: 'string', length: 50, nullable: false)]
    private string $years;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $login = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $password = null;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $del = null;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $ID_Address;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $ID_Campus;

    public function getIDUser(): ?int
    {
        return $this->ID_User;
    }

    public function setIDUser(?int $id): void
    {
        $this->ID_User = $id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(?int $type): void
    {
        $this->type = $type;
    }

    public function getYears(): string
    {
        return $this->years;
    }

    public function setYears(string $years): void
    {
        $this->years = $years;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(?string $login): void
    {
        $this->login = $login;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function isDel(): ?bool
    {
        return $this->del;
    }

    public function setDel(?bool $del): void
    {
        $this->del = $del;
    }

    public function getIDAddress(): int
    {
        return $this->ID_Address;
    }

    public function setIDAddress(int $ID_Address): void
    {
        $this->ID_Address = $ID_Address;
    }

    public function getIDCampus(): int
    {
        return $this->ID_Campus;
    }

    public function setIDCampus(int $ID_Campus): void
    {
        $this->ID_Campus = $ID_Campus;
    }
}
