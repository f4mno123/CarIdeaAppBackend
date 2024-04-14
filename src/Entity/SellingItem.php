<?php

namespace App\Entity;

use App\Repository\SellingItemRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: SellingItemRepository::class)]
class SellingItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('selling_item')]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    #[Groups('selling_item')]
    private ?string $itemName = null;

    #[ORM\Column]
    #[Groups('selling_item')]
    private ?int $price = null;

    #[ORM\Column(length: 255)]
    #[Groups('selling_item')]
    private ?string $itemDescription = null;

    #[ORM\Column(length: 255)]
    #[Groups('selling_item')]
    private ?string $imageLinkBlob = null;

    #[ORM\OneToMany(targetEntity: UserSellingItem::class, mappedBy: 'sellingItem')]
    private Collection $UserSellingItems;

    /**
     * @return Collection
     */
    public function getUserSellingItems(): Collection
    {
        return $this->UserSellingItems;
    }

    /**
     * @param Collection $UserSellingItems
     */
    public function setUserSellingItems(Collection $UserSellingItems): void
    {
        $this->UserSellingItems = $UserSellingItems;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItemName(): ?string
    {
        return $this->itemName;
    }

    public function setItemName(string $itemName): static
    {
        $this->itemName = $itemName;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getItemDescription(): ?string
    {
        return $this->itemDescription;
    }

    public function setItemDescription(string $itemDescription): static
    {
        $this->itemDescription = $itemDescription;

        return $this;
    }

    public function getImageLinkBlob(): ?string
    {
        return $this->imageLinkBlob;
    }

    public function setImageLinkBlob(string $imageLinkBlob): static
    {
        $this->imageLinkBlob = $imageLinkBlob;

        return $this;
    }

}
