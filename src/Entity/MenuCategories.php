<?php

namespace App\Entity;

use App\Repository\MenuCategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuCategoriesRepository::class)]
class MenuCategories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    /**
     * @var Collection<int, MenuItems>
     */
    #[ORM\OneToMany(targetEntity: MenuItems::class, mappedBy: 'menuCategories')]
    private Collection $menu_items;

    public function __construct()
    {
        $this->menu_items = new ArrayCollection();
    }

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
     * @return Collection<int, MenuItems>
     */
    public function getMenuItems(): Collection
    {
        return $this->menu_items;
    }

    public function addMenuItem(MenuItems $menuItem): static
    {
        if (!$this->menu_items->contains($menuItem)) {
            $this->menu_items->add($menuItem);
            $menuItem->setMenuCategories($this);
        }

        return $this;
    }

    public function removeMenuItem(MenuItems $menuItem): static
    {
        if ($this->menu_items->removeElement($menuItem)) {
            // set the owning side to null (unless already changed)
            if ($menuItem->getMenuCategories() === $this) {
                $menuItem->setMenuCategories(null);
            }
        }

        return $this;
    }
}
