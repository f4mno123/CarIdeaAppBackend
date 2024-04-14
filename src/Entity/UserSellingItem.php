<?php

namespace App\Entity;

use App\Repository\UserSellingItemRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: UserSellingItemRepository::class)]
class UserSellingItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'SellingItemList')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('selling_item')]
    private ?User $user = null;

    #[ORM\ManyToOne(targetEntity: SellingItem::class, inversedBy: 'UserSellingItems')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('selling_item')]
    private ?SellingItem $sellingItem = null;

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     */
    public function setUser(?User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return SellingItem|null
     */
    public function getSellingItem(): ?SellingItem
    {
        return $this->sellingItem;
    }

    /**
     * @param SellingItem|null $sellingItem
     */
    public function setSellingItem(?SellingItem $sellingItem): void
    {
        $this->sellingItem = $sellingItem;
    }



    public function getId(): ?int
    {
        return $this->id;
    }
}
