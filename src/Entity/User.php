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

    #[ORM\ManyToOne(targetEntity: 'Address')]
    #[ORM\JoinColumn(name: 'ID_Address', referencedColumnName: 'ID_Address')]
    private ?Address $IDAddress = null;

    #[ORM\ManyToOne(targetEntity: 'Campus')]
    #[ORM\JoinColumn(name: 'ID_Campus', referencedColumnName: 'ID_Campus')]
    private ?Campus $IDCampus = null;

    #[ORM\OneToMany(targetEntity: 'Postulate', mappedBy: 'user')]
    private $postulates;

    #[ORM\ManyToOne(targetEntity: 'Campus')]
    #[ORM\JoinColumn(name: 'ID_Campus', referencedColumnName: 'ID_Campus')]
    private ?Campus $campus = null;

    #[ORM\OneToMany(targetEntity: 'Editwishlist', mappedBy: 'user')]
    private $editwishlists;

    public function __construct()
    {
        $this->editwishlists = new ArrayCollection();
    }



    public function getIDUser(): ?int
    {
        return $this->ID_User;
    }

    public function setIDUser(?int $id): void
    {
        echo 'set ID_User : ' . $id . "\n";
        $this->ID_User = $id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): void
    {
        echo 'set firstName : ' . $firstName . "\n";
        $this->firstName = $firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): void
    {
        echo 'set lastName : ' . $lastName . "\n";
        $this->lastName = $lastName;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(?int $type): void
    {
        echo 'set type : ' . $type . "\n";
        $this->type = $type;
    }

    public function getYears(): string
    {
        return $this->years;
    }

    public function setYears(string $years): void
    {
        echo 'set years : ' . $years . "\n";
        $this->years = $years;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(?string $login): void
    {
        echo 'set login : ' . $login . "\n";
        $this->login = $login;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        echo 'set password : ' . $password . "\n";
        $this->password = $password;
    }

    public function isDel(): ?bool
    {
        return $this->del;
    }

    public function setDel(?bool $del): void
    {
        echo 'set del : ' . $del . "\n";
        $this->del = $del;
    }

    public function getIDAddress(): int
    {
        return $this->ID_Address;
    }

    public function setIDAddress(int $ID_Address): void
    {
        echo 'set ID_Address : ' . $ID_Address . "\n";
        $this->ID_Address = $ID_Address;
    }

    public function getIDCampus(): int
    {
        return $this->ID_Campus;
    }

    public function setIDCampus(int $ID_Campus): void
    {
        echo 'set ID_Campus : ' . $ID_Campus . "\n";
        $this->ID_Campus = $ID_Campus;
    }
}
