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
//    private ?int $IDAddress = null;
    private ?Address $IDAddress = null;

    #[ORM\ManyToOne(targetEntity: 'Company')]
    #[ORM\JoinColumn(name: 'ID_Company', referencedColumnName: 'ID_Company')]
//    private ?int $IDCompany = null;
    private ?Company $IDCompany = null;


    public function getIDOffers(): ?int
    {
        return $this->ID_Offers;
    }

    public function setIDOffers(int $ID_Offers): void
    {
        echo 'set ID_Offers : ' . $ID_Offers . "\n";
        $this->ID_Offers = $ID_Offers;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): void
    {
        echo 'set company : ' . $company . "\n";
        $this->company = $company;
    }

    public function getTargetPromotion(): ?string
    {
        return $this->targetPromotion;
    }

    public function setTargetPromotion(?string $targetPromotion): void
    {
        echo 'set targetPromotion : ' . $targetPromotion . "\n";
        $this->targetPromotion = $targetPromotion;
    }

    public function getDurationOfInternship(): ?string
    {
        return $this->durationOfInternship;
    }

    public function setDurationOfInternship(?string $durationOfInternship): void
    {
        echo 'set durationOfInternship : ' . $durationOfInternship . "\n";
        $this->durationOfInternship = $durationOfInternship;
    }

    public function getPayment(): ?float
    {
        return $this->payment;
    }

    public function setPayment(?float $payment): void
    {
        echo 'set payment : ' . $payment . "\n";
        $this->payment = $payment;
    }

    public function getOfferDate(): ?\DateTimeInterface
    {
        return $this->offerDate;
    }

    public function setOfferDate(?\DateTimeInterface $offerDate): void
    {
        echo 'set offerDate : ' . $offerDate->format('d-m-Y') . "\n";
        $this->offerDate = $offerDate;
    }

    public function getNumberOfPlaces(): ?int
    {
        return $this->numberOfPlaces;
    }

    public function setNumberOfPlaces(?int $numberOfPlaces): void
    {
        echo 'set numberOfPlaces : ' . $numberOfPlaces . "\n";
        $this->numberOfPlaces = $numberOfPlaces;
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

    public function getIDAddress(): ?Address
    {
        return $this->IDAddress;
    }

    public function setIDAddress(?Address $IDAddress): void
    {
        echo 'set IDAddress : ' . $IDAddress->getIDAddress() . "\n";
        $this->IDAddress = $IDAddress;
    }

    public function getIDCompany(): ?Company
    {
        return $this->IDCompany;
    }

    public function setIDCompany(?Company $IDCompany): void
    {
        try {
            echo 'set IDCompany : ' . $IDCompany->getIDCompany() . "\n";
            $this->IDCompany = $IDCompany;
        }
        catch (Exception $e) {
            echo $e->getMessage();
            $this->IDCompany = null;
        }

    }
}
