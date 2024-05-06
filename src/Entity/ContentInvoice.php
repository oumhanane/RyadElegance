<?php

namespace App\Entity;

use App\Repository\ContentInvoiceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContentInvoiceRepository::class)]
class ContentInvoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'contentInvoices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?invoice $invoice = null;

    #[ORM\Column(length: 255)]
    private ?string $productName = null;

    #[ORM\Column]
    private ?int $priceProduct = null;

    #[ORM\Column(length: 255)]
    private ?string $imageProduct = null;

    #[ORM\Column]
    private ?int $quantity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvoice(): ?invoice
    {
        return $this->invoice;
    }

    public function setInvoice(?invoice $invoice): static
    {
        $this->invoice = $invoice;

        return $this;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): static
    {
        $this->productName = $productName;

        return $this;
    }

    public function getPriceProduct(): ?int
    {
        return $this->priceProduct;
    }

    public function setPriceProduct(int $priceProduct): static
    {
        $this->priceProduct = $priceProduct;

        return $this;
    }

    public function getImageProduct(): ?string
    {
        return $this->imageProduct;
    }

    public function setImageProduct(string $imageProduct): static
    {
        $this->imageProduct = $imageProduct;

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
