<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdersRepository::class)]
class Orders
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $total_price = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    /**
     * @var Collection<int, OrderItems>
     */
    #[ORM\OneToMany(targetEntity: OrderItems::class, mappedBy: 'orders')]
    private Collection $order_items;

    public function __construct()
    {
        $this->order_items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalPrice(): ?string
    {
        return $this->total_price;
    }

    public function setTotalPrice(string $total_price): static
    {
        $this->total_price = $total_price;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, OrderItems>
     */
    public function getOrderItems(): Collection
    {
        return $this->order_items;
    }

    public function addOrderItem(OrderItems $orderItem): static
    {
        if (!$this->order_items->contains($orderItem)) {
            $this->order_items->add($orderItem);
            $orderItem->setOrders($this);
        }

        return $this;
    }

    public function removeOrderItem(OrderItems $orderItem): static
    {
        if ($this->order_items->removeElement($orderItem)) {
            // set the owning side to null (unless already changed)
            if ($orderItem->getOrders() === $this) {
                $orderItem->setOrders(null);
            }
        }

        return $this;
    }
}
