<?php

namespace App\Entity;

use App\Repository\OrderItemsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderItemsRepository::class)]
class OrderItems
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $subtotal_price = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'order_items')]
    private ?Orders $orders = null;

    #[ORM\ManyToOne(inversedBy: 'order_items')]
    private ?MenuItems $menuItems = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSubtotalPrice(): ?string
    {
        return $this->subtotal_price;
    }

    public function setSubtotalPrice(string $subtotal_price): static
    {
        $this->subtotal_price = $subtotal_price;

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

    public function getOrders(): ?Orders
    {
        return $this->orders;
    }

    public function setOrders(?Orders $orders): static
    {
        $this->orders = $orders;

        return $this;
    }

    public function getMenuItems(): ?MenuItems
    {
        return $this->menuItems;
    }

    public function setMenuItems(?MenuItems $menuItems): static
    {
        $this->menuItems = $menuItems;

        return $this;
    }
}
