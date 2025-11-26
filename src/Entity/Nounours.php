<?php

namespace App\Entity;

use App\Repository\NounoursRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NounoursRepository::class)]
class Nounours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $size = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $price = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $publishAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ispublished = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(?string $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getPublishAt(): ?\DateTimeImmutable
    {
        return $this->publishAt;
    }

    public function setPublishAt(\DateTimeImmutable $publishAt): static
    {
        $this->publishAt = $publishAt;

        return $this;
    }

    public function getIspublished(): ?string
    {
        return $this->ispublished;
    }

    public function setIspublished(?string $ispublished): static
    {
        $this->ispublished = $ispublished;

        return $this;
    }
}
