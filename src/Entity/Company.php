<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'company')]
class Company
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $ID_Company = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $activitySector = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $stats = null;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $del = null;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $invisibleForStudents = null;

    #[ORM\Column(type: 'string', length: 200, nullable: true)]
    private ?string $opinion = null;

    #[ORM\Column(type: 'decimal', precision: 3, scale: 1, nullable: true)]
    private ?float $mark = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $numberOfWishlist = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $numberOfPostulation = null;

    public function getId(): ?int
    {
        return $this->ID_Company;
    }

    public function setId(?int $id): void
    {
        $this->ID_Company = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getActivitySector(): ?string
    {
        return $this->activitySector;
    }

    public function setActivitySector(?string $activitySector): void
    {
        $this->activitySector = $activitySector;
    }

    public function getStats(): ?string
    {
        return $this->stats;
    }

    public function setStats(?string $stats): void
    {
        $this->stats = $stats;
    }

    public function isDel(): ?bool
    {
        return $this->del;
    }

    public function setDel(?bool $del): void
    {
        $this->del = $del;
    }

    public function isInvisibleForStudents(): ?bool
    {
        return $this->invisibleForStudents;
    }

    public function setInvisibleForStudents(?bool $invisibleForStudents): void
    {
        $this->invisibleForStudents = $invisibleForStudents;
    }

    public function getOpinion(): ?string
    {
        return $this->opinion;
    }

    public function setOpinion(?string $opinion): void
    {
        $this->opinion = $opinion;
    }

    public function getMark(): ?float
    {
        return $this->mark;
    }

    public function setMark(?float $mark): void
    {
        $this->mark = $mark;
    }

    public function getNumberOfWishlist(): ?int
    {
        return $this->numberOfWishlist;
    }

    public function setNumberOfWishlist(?int $numberOfWishlist): void
    {
        $this->numberOfWishlist = $numberOfWishlist;
    }

    public function getNumberOfPostulation(): ?int
    {
        return $this->numberOfPostulation;
    }

    public function setNumberOfPostulation(?int $numberOfPostulation): void
    {
        $this->numberOfPostulation = $numberOfPostulation;
    }
}
