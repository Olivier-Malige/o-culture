<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlaceTypeRepository")
 */
class PlaceType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=55)
     * @Groups({"place_list", "place_detail","event_detail","event_list", "place_type_list", "appuser_a_o_detail"})
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Place", mappedBy="PlaceType")
     */
    private $Places;

    public function __construct()
    {
        $this->Places = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

  

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Place[]
     */
    public function getPlaces(): Collection
    {
        return $this->Places;
    }

    public function addPlace(Place $place): self
    {
        if (!$this->Places->contains($place)) {
            $this->Places[] = $place;
            $place->setPlaceType($this);
        }

        return $this;
    }

    public function removePlace(Place $place): self
    {
        if ($this->Places->contains($place)) {
            $this->Places->removeElement($place);
            // set the owning side to null (unless already changed)
            if ($place->getPlaceType() === $this) {
                $place->setPlaceType(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
