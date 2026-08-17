<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TagRepository")
 */
class Tag
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"tag_list"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=55)
     * @Groups({"tag_list"})
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
     * @ORM\ManyToOne(targetEntity="App\Entity\EventType", inversedBy="tags")
     */
    private $EventType;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Event", mappedBy="EventTags")
     */
    private $EventsTag;

    public function __construct()
    {
        $this->EventsTag = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->isActive = true;
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

    public function getEventType(): ?EventType
    {
        return $this->EventType;
    }

    public function setEventType(?EventType $EventType): self
    {
        $this->EventType = $EventType;

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getEventsTag(): Collection
    {
        return $this->EventsTag;
    }

    public function addEventsTag(Event $eventsTag): self
    {
        if (!$this->EventsTag->contains($eventsTag)) {
            $this->EventsTag[] = $eventsTag;
            $eventsTag->addEventTag($this);
        }

        return $this;
    }

    public function removeEventsTag(Event $eventsTag): self
    {
        if ($this->EventsTag->contains($eventsTag)) {
            $this->EventsTag->removeElement($eventsTag);
            $eventsTag->removeEventTag($this);
        }

        return $this;
    }

    public function __toString(){
        return $this->name;
    }
}
