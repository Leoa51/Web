<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


#[ORM\Entity]
#[ORM\Table(name: 'user_')]
class User
{

//    @todo : ajouter le sel
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
    private Address $ID_Address;

    #[ORM\Column(type: 'integer', nullable: true)]
    private int $ID_Campus;

    #[ORM\OneToMany(targetEntity: 'Address', mappedBy: 'user')]
    #[ORM\JoinColumn(name: 'ID_Address', referencedColumnName: 'ID_Address')]
    private ?Address $IDAddress = null;

    #[ORM\ManyToOne(targetEntity: 'Campus')]
    #[ORM\JoinColumn(name: 'ID_Campus', referencedColumnName: 'ID_Campus')]
    private ?int $IDCampus;

    #[ORM\OneToMany(targetEntity: 'Postulate', mappedBy: 'user')]
    private $postulates;

//    #[ORM\ManyToOne(targetEntity: 'Campus')]
//    #[ORM\JoinColumn(name: 'ID_Campus', referencedColumnName: 'ID_Campus')]
//    private ?Campus $campus = null;

    #[ORM\OneToMany(targetEntity: 'Editwishlist', mappedBy: 'user')]
    private $editwishlists;

//    public function __construct()
//    {
//        $this->editwishlists = new ArrayCollection();
//    }


    public function getIDUser(): ?int
    {
        return $this->ID_User;
    }

    public function setIDUser(?int $id): void
    {
        error_log('set ID_User : ' . $id . "\n");
        $this->ID_User = $id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): void
    {
        error_log('set firstName : ' . $firstName . "\n");
        $this->firstName = $firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): void
    {
        error_log('set lastName : ' . $lastName . "\n");
        $this->lastName = $lastName;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(?int $type): void
    {
        error_log('set type : ' . $type . "\n");
        $this->type = $type;
    }

    public function getYears(): string
    {
        return $this->years;
    }

    public function setYears(string $years): void
    {
        error_log('set years : ' . $years . "\n");
        $this->years = $years;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(?string $login): void
    {
        error_log('set login : ' . $login . "\n");
        $this->login = $login;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function isPasswordValid(?string $pass): bool
    {
        return password_verify($pass, $this->getPassword());
    }

//    public function setPassword(?string $password, UserPasswordEncoderInterface $encoder): void
    public function setPassword(?string $password): void
    {
        error_log('set password : ' . $password . "\n");
        $encodedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->password = $encodedPassword;
    }

    public function isDel(): ?bool
    {
        return $this->del;
    }

    public function setDel(?bool $del): void
    {
        error_log('set del : ' . $del . "\n");
        $this->del = $del;
    }

    public function getIDAddress(): int
    {
        return $this->ID_Address;
    }

    public function setIDAddress(Address $ID_Address): void
    {
//        error_log('set ID_Address : ' . $ID_Address . "\n");
        $this->ID_Address = $ID_Address;
    }

    public function getIDCampus(): int
    {
        return $this->ID_Campus;
    }

    public function setIDCampus(int $ID_Campus): void
    {
//        error_log('set ID_Campus : ' . $ID_Campus . "\n");
        $this->ID_Campus = $ID_Campus;
    }
}
