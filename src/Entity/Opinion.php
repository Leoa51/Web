<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'opinion')]
class Opinion
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private ?int $ID_Opinion = null;

    #[ORM\Column(type: 'integer')]
    #[ORM\ManyToOne(targetEntity: 'Company')]
    #[ORM\JoinColumn(name: 'ID_Company', referencedColumnName: 'ID_Company')]
    private ?int $ID_Company = null;

    #[ORM\Column(type: 'string', length: 200, nullable: true)]
    private ?string $opinion = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $sender = null;
    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $mark = null;

    /**
     * @return int|null
     */
    public function getIDOpinion(): ?int
    {
        return $this->ID_Opinion;
    }

    /**
     * @param int|null $ID_Opinion
     */
    public function setIDOpinion(?int $ID_Opinion): void
    {
        $this->ID_Opinion = $ID_Opinion;
    }

    /**
     * @return int|null
     */
    public function getIDCompany(): ?int
    {
        return $this->ID_Company;
    }

    /**
     * @param int|null $ID_Company
     */
    public function setIDCompany(?int $ID_Company): void
    {
        $this->ID_Company = $ID_Company;
    }

    /**
     * @return string|null
     */
    public function getOpinion(): ?string
    {
        return $this->opinion;
    }

    /**
     * @param string|null $opinion
     */
    public function setOpinion(?string $opinion): void
    {
        $this->opinion = $opinion;
    }

    /**
     * @return int|null
     */
    public function getSender(): ?int
    {
        return $this->sender;
    }

    /**
     * @param int|null $sender
     */
    public function setSender(?string $sender): void
    {
        $this->sender = $sender;
    }

    /**
     * @return float|null
     */
    public function getMark(): ?float
    {
        return $this->mark;
    }

    /**
     * @param float|null $mark
     */
    public function setMark(?float $mark): void
    {
        $this->mark = $mark;
    }


}