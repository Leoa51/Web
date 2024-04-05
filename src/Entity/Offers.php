<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'offers')]
class Offers
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $ID_Offers = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $company = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $targetPromotion = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $durationOfInternship = null;

    #[ORM\Column(type: 'decimal', precision: 8, scale: 2, nullable: true)]
    private ?float $payment = null;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $offerDate = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $numberOfPlaces = null;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $del = null;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $ID_Address;


    #[ORM\ManyToOne(targetEntity: 'Company')]
    #[ORM\JoinColumn(name: 'ID_Company', referencedColumnName: 'ID_Company')]
    private ?int $ID_Company = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private int $ID_Campus;

    #[ORM\OneToMany(targetEntity: 'Address', mappedBy: 'user')]
    #[ORM\JoinColumn(name: 'ID_Address', referencedColumnName: 'ID_Address')]
    private ?Address $IDAddress = null;

    #[ORM\ManyToOne(targetEntity: 'Campus')]
    #[ORM\JoinColumn(name: 'ID_Company', referencedColumnName: 'ID_Company')]
    private ?int $IDCompany;

    #[ORM\OneToMany(targetEntity: 'Postulate', mappedBy: 'offer')]
    private $postulates;

    #[ORM\OneToMany(targetEntity: 'Editwishlist', mappedBy: 'offer')]
    private $editwishlists;
//    public function __construct()
//    {
//        $this->postulates = new ArrayCollection();
//    }


    public function getIDOffers(): ?int
    {
        return $this->ID_Offers;
    }

    public function setIDOffers(int $ID_Offers): void
    {
        $this->ID_Offers = $ID_Offers;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): void
    {
        $this->company = $company;
    }

    public function getTargetPromotion(): ?string
    {
        return $this->targetPromotion;
    }

    public function setTargetPromotion(?string $targetPromotion): void
    {
        $this->targetPromotion = $targetPromotion;
    }

    public function getDurationOfInternship(): ?string
    {
        return $this->durationOfInternship;
    }

    public function setDurationOfInternship(?string $durationOfInternship): void
    {
        $this->durationOfInternship = $durationOfInternship;
    }

    public function getPayment(): ?float
    {
        return $this->payment;
    }

    public function setPayment(?float $payment): void
    {
        $this->payment = $payment;
    }

    public function getOfferDate(): ?\DateTimeInterface
    {
        return $this->offerDate;
    }

    public function setOfferDate(?\DateTimeInterface $offerDate): void
    {
        $this->offerDate = $offerDate;
    }

    public function getNumberOfPlaces(): ?int
    {
        return $this->numberOfPlaces;
    }

    public function setNumberOfPlaces(?int $numberOfPlaces): void
    {
        $this->numberOfPlaces = $numberOfPlaces;
    }

    public function isDel(): ?bool
    {
        return $this->del;
    }

    public function setDel(?bool $del): void
    {
        $this->del = $del;
    }

//    public function getIDAddress(): ?Address
//    {
//        return $this->ID_Address;
//    }

//    public function setIDAddress(?Address $ID_Address): void
//    {
//        echo 'set ID_Address : ' . $ID_Address->getIDAddress() . "\n";
//        $this->ID_Address = $ID_Address;
//    }

    public function getIDAddress(): ?int
    {
        return $this->ID_Address;
    }

    public function setIDAddress(?int $ID_Address): void
    {
        $this->ID_Address = $ID_Address;
    }

//    public function getIDCompany(): ?Company
//    {
//        return $this->ID_Company;
//    }
//
//    public function setIDCompany(?Company $ID_Company): void
//    {
//        echo 'set ID_Company : ' . $ID_Company->getIDCompany() . "\n";
//        $this->ID_Company = $ID_Company;
//    }

    public function getIDCompany(): ?int
    {
        return $this->ID_Company;
    }

    public function setIDCompany(?int $ID_Company): void
    {
        $this->ID_Company = $ID_Company;
    }


}
