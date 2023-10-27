<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column]
    private ?int $price_net = null;

    #[ORM\Column]
    private ?int $price_gross = null;

    #[ORM\Column]
    #[ORM\Nullable]
    private ?int $vat_rate = null;

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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPriceNet(): ?int
    {
        return $this->price_net;
    }

    public function setPriceNet(int $price_net): static
    {
        $this->price_net = $price_net;

        return $this;
    }

    public function getPriceGross(): ?int
    {
        return $this->price_gross;
    }

    public function setPriceGross(int $price_gross): static
    {
        $this->price_gross = $price_gross;

        return $this;
    }

    public function getVatRate(): ?int
    {
        return $this->vat_rate;
    }

    public function setVatRate(int $vat_rate): static
    {
        $this->vat_rate = $vat_rate;

        return $this;
    }
}
