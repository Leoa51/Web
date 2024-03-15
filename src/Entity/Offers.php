<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'offers')]
class Offer
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int $ID_Offers;

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

    #[ORM\ManyToOne(targetEntity: 'Address')]
    #[ORM\JoinColumn(name: 'ID_Address', referencedColumnName: 'ID_Address')]
    private ?Address $address = null;

    #[ORM\ManyToOne(targetEntity: 'Company')]
    #[ORM\JoinColumn(name: 'ID_Company', referencedColumnName: 'ID_Company')]
    private ?Company $companyEntity = null;

    public function getId(): ?int
    {
        return $this->ID_Offers;
    }

    public function setId(int $ID_Offers): void
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

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): void
    {
        $this->address = $address;
    }

    public function getCompanyEntity(): ?Company
    {
        return $this->companyEntity;
    }

    public function setCompanyEntity(?Company $companyEntity): void
    {
        $this->companyEntity = $companyEntity;
    }
}
