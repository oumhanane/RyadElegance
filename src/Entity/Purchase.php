<?php

namespace App\Entity;

use App\Repository\PurchaseRepository;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PurchaseRepository::class)]
#[ORM\HasLifecycleCallbacks]

class Purchase
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'purchases')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $user = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Vous devez renseigner le pays.')]
    private ?string $country = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Vous devez renseigner la ville.')]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Vous devez renseigner la rue.')]
    private ?string $street = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Vous devez renseigner le code postal.')]
    private ?string $postalCode = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Vous devez renseigner le numéro de téléphone.')]
    private ?string $telephone = null;

    #[ORM\OneToOne(mappedBy: 'purchase', cascade: ['persist', 'remove'])]
    private ?ListProduct $listProduct = null;

    #[ORM\OneToOne(mappedBy: 'purchase', cascade: ['persist', 'remove'])]
    private ?Invoice $invoice = null;

    #[ORM\PrePersist]
    public function prePersist()
        {
            if(empty($this->createdAt))
            {
                $this->createdAt = new DateTime();
            }
        }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): static
    {
        $this->street = $street;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): static
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getListProduct(): ?ListProduct
    {
        return $this->listProduct;
    }

    public function setListProduct(ListProduct $listProduct): static
    {
        // set the owning side of the relation if necessary
        if ($listProduct->getPurchase() !== $this) {
            $listProduct->setPurchase($this);
        }

        $this->listProduct = $listProduct;

        return $this;
    }

    public function getInvoice(): ?Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(Invoice $invoice): static
    {
        // set the owning side of the relation if necessary
        if ($invoice->getPurchase() !== $this) {
            $invoice->setPurchase($this);
        }

        $this->invoice = $invoice;

        return $this;
    }
}
