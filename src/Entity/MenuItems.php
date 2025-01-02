<?php

namespace App\Entity;

use App\Repository\MenuItemsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;



#[ORM\Entity(repositoryClass: MenuItemsRepository::class)]
#[Vich\Uploadable]
class MenuItems
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $price = null;

    #[ORM\Column]
    private ?int $stock_quantity = null;




    // VICHUPLOADER STARTS

    #[Vich\UploadableField(mapping: 'menu_item_img', fileNameProperty: 'imageName', size: 'imageSize')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageSize = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    // VICHUPLOADER ENDS




    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'menu_items')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MenuCategories $menuCategories = null;

    /**
     * @var Collection<int, OrderItems>
     */
    #[ORM\OneToMany(targetEntity: OrderItems::class, mappedBy: 'menuItems')]
    private Collection $order_items;

    public function __construct()
    {
        $this->order_items = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getStockQuantity(): ?int
    {
        return $this->stock_quantity;
    }

    public function setStockQuantity(int $stock_quantity): static
    {
        $this->stock_quantity = $stock_quantity;

        return $this;
    }



    // VICHUPLOADER STARTS

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }


    public function getImageName(): ?string
    {
        return $this->imageName;
    }


    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }



    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }



    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    // VICHUPLOADER ENDS





    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getMenuCategories(): ?MenuCategories
    {
        return $this->menuCategories;
    }

    public function setMenuCategories(?MenuCategories $menuCategories): static
    {
        $this->menuCategories = $menuCategories;

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
            $orderItem->setMenuItems($this);
        }

        return $this;
    }

    public function removeOrderItem(OrderItems $orderItem): static
    {
        if ($this->order_items->removeElement($orderItem)) {
            // set the owning side to null (unless already changed)
            if ($orderItem->getMenuItems() === $this) {
                $orderItem->setMenuItems(null);
            }
        }

        return $this;
    }
}
