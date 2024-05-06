<?php

namespace App\Entity;

use App\Repository\ContentListProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContentListProductRepository::class)]
class ContentListProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'contentListProducts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?listProduct $listProduct = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?product $product = null;

    #[ORM\Column]
    private ?int $quantity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getListProduct(): ?listProduct
    {
        return $this->listProduct;
    }

    public function setListProduct(?listProduct $listProduct): static
    {
        $this->listProduct = $listProduct;

        return $this;
    }

    public function getProduct(): ?product
    {
        return $this->product;
    }

    public function setProduct(?product $product): static
    {
        $this->product = $product;

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
}
