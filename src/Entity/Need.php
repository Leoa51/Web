<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'need')]
class Need
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    private Offers $ID_Offers;

    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 50)]
    private string $nameSkills;

    #[ORM\ManyToOne(targetEntity: 'Offers')]
    #[ORM\JoinColumn(name: 'ID_Offers', referencedColumnName: 'ID_Offers')]
    private Offers $offers;

    #[ORM\ManyToOne(targetEntity: 'Skill')]
    #[ORM\JoinColumn(name: 'nameSkills', referencedColumnName: 'nameSkills')]
    private Skill $skill;

    public function getIDOffers(): ?Offers
    {
        return $this->ID_Offers;
    }

    public function setIDOffers(Offers $ID_Offers): void
    {
        $this->ID_Offers = $ID_Offers;
    }

    public function getNameSkills(): string
    {
        return $this->nameSkills;
    }

    public function setNameSkills(string $nameSkills): void
    {
        $this->nameSkills = $nameSkills;
    }

    public function getOffer(): Offer
    {
        return $this->offer;
    }

    public function setOffer(Offer $offer): void
    {
        $this->offer = $offer;
    }

    public function getSkill(): Skill
    {
        return $this->skill;
    }

    public function setSkill(Skill $skill): void
    {
        $this->skill = $skill;
    }
}
