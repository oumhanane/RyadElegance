<?php

namespace App\Entity;

use App\Repository\ListProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListProductRepository::class)]
class ListProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'listProduct', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?purchase $purchase = null;

    #[ORM\OneToMany(mappedBy: 'listProduct', targetEntity: ContentListProduct::class, orphanRemoval: true)]
    private Collection $contentListProducts;

    public function __construct()
    {
        $this->contentListProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPurchase(): ?purchase
    {
        return $this->purchase;
    }

    public function setPurchase(purchase $purchase): static
    {
        $this->purchase = $purchase;

        return $this;
    }

    /**
     * @return Collection<int, ContentListProduct>
     */
    public function getContentListProducts(): Collection
    {
        return $this->contentListProducts;
    }

    public function addContentListProduct(ContentListProduct $contentListProduct): static
    {
        if (!$this->contentListProducts->contains($contentListProduct)) {
            $this->contentListProducts->add($contentListProduct);
            $contentListProduct->setListProduct($this);
        }

        return $this;
    }

    public function removeContentListProduct(ContentListProduct $contentListProduct): static
    {
        if ($this->contentListProducts->removeElement($contentListProduct)) {
            // set the owning side to null (unless already changed)
            if ($contentListProduct->getListProduct() === $this) {
                $contentListProduct->setListProduct(null);
            }
        }

        return $this;
    }
}
