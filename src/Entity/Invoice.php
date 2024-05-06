<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'invoice', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Purchase $purchase = null;

    #[ORM\Column]
    private ?int $total = null;

    #[ORM\Column]
    private ?bool $isPaid = null;

    #[ORM\OneToMany(mappedBy: 'invoice', targetEntity: ContentInvoice::class, orphanRemoval: true)]
    private Collection $contentInvoices;

    public function __construct()
    {
        $this->contentInvoices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPurchase(): ?Purchase
    {
        return $this->purchase;
    }

    public function setPurchase(Purchase $purchase): static
    {
        $this->purchase = $purchase;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function isIsPaid(): ?bool
    {
        return $this->isPaid;
    }

    public function setIsPaid(bool $isPaid): static
    {
        $this->isPaid = $isPaid;

        return $this;
    }

    /**
     * @return Collection<int, ContentInvoice>
     */
    public function getContentInvoices(): Collection
    {
        return $this->contentInvoices;
    }

    public function addContentInvoice(ContentInvoice $contentInvoice): static
    {
        if (!$this->contentInvoices->contains($contentInvoice)) {
            $this->contentInvoices->add($contentInvoice);
            $contentInvoice->setInvoice($this);
        }

        return $this;
    }

    public function removeContentInvoice(ContentInvoice $contentInvoice): static
    {
        if ($this->contentInvoices->removeElement($contentInvoice)) {
            // set the owning side to null (unless already changed)
            if ($contentInvoice->getInvoice() === $this) {
                $contentInvoice->setInvoice(null);
            }
        }

        return $this;
    }
}
