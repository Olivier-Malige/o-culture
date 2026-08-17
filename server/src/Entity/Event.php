<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 */
class Event
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * //TODO supprimer ce groupe ?
     * @Groups({"place_list","event_list", "place_detail", "event_detail", "appuser_detail","appuser_a_o_detail"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"event_list","event_detail", "place_detail", "appuser_detail"})
     */
    private $name;
    
    // @Assert \DateTime (format = "Y-m-d H:i:s")

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"event_list", "place_detail", "event_detail", "appuser_detail", "appuser_a_o_detail"})
     * @Type("DateTime<'Y-m-d h:i'>")
     * 
     */
    private $plannedDate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"event_list", "event_detail", "appuser_a_o_detail"})
     */
    private $nbSpectator;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"event_list", "place_detail", "event_detail", "appuser_a_o_detail"})
     */
    private $price;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"event_list", "event_detail", "appuser_a_o_detail"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=144, nullable=true)
     * @Groups({"event_list", "place_detail", "appuser_detail", "event_detail"})
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppUser", inversedBy="events", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"event_detail"})
     */
    private $appUserCreator;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Place", inversedBy="events", cascade={"persist"})
     * @Groups({"event_list", "event_detail","place_list", "place_detail", "appuser_detail", "appuser_a_o_detail"})
     */
    private $eventPlace;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EventType", inversedBy="events")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"event_list", "event_detail", "appuser_a_o_detail"})
     */
    private $eventType;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="Event", cascade={"remove"})
     * @Groups({"event_detail"})
     */
    private $comments;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\AppUser", inversedBy="EventsPro", cascade={"persist"})
     * @ORM\JoinTable(name="event_performer_appuser")
     * @Groups({"event_list", "place_detail"})
     */
    private $AppUserPerformer;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\AppUser", inversedBy="EventsParticipant", cascade={"persist"})
     * @ORM\JoinTable(name="event_participant_appuser")
     */
    private $AppUserParticipant;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", inversedBy="EventsTag")
     */
    private $EventTags;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbAlert;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->AppUserPerformer = new ArrayCollection();
        $this->AppUserParticipant = new ArrayCollection();
        $this->EventTags = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->isActive = true;
        $this->status = 1;
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

    public function getPlannedDate(): ?\DateTimeInterface
    {
        return $this->plannedDate;
    }

    public function setPlannedDate(\DateTimeInterface $plannedDate): self
    {
        $this->plannedDate = $plannedDate;

        return $this;
    }

    public function getNbSpectator(): ?int
    {
        return $this->nbSpectator;
    }

    public function setNbSpectator(?int $nbSpectator): self
    {
        $this->nbSpectator = $nbSpectator;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getimage(): ?string
    {
        return $this->image;
    }

    public function setimage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

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

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getAppUserCreator(): ?AppUser
    {
        return $this->appUserCreator;
    }

    public function setAppUserCreator(?AppUser $appUserCreator): self
    {
        $this->appUserCreator = $appUserCreator;

        return $this;
    }

    public function getEventPlace(): ?Place
    {
        return $this->eventPlace;
    }

    public function setEventPlace(?Place $eventPlace): self
    {
        $this->eventPlace = $eventPlace;

        return $this;
    }

    public function getEventType(): ?EventType
    {
        return $this->eventType;
    }

    public function setEventType(?EventType $eventType): self
    {
        $this->eventType = $eventType;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setEvent($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getEvent() === $this) {
                $comment->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AppUser[]
     */
    public function getAppUserPerformer()
    {
        return $this->AppUserPerformer;
    }

    public function addAppUserPerformer(AppUser $appUserPerformer): self
    {
        if (!$this->AppUserPerformer->contains($appUserPerformer)) {
            $this->AppUserPerformer[] = $appUserPerformer;
        }

        return $this;
    }

    public function removeAppUserPerformer(AppUser $appUserPerformer): self
    {
        if ($this->AppUserPerformer->contains($appUserPerformer)) {
            $this->AppUserPerformer->removeElement($appUserPerformer);
        }

        return $this;
    }

    /**
     * @return Collection|AppUser[]
     */
    public function getAppUserParticipant(): Collection
    {
        return $this->AppUserParticipant;
    }

    public function addAppUserParticipant(AppUser $appUserParticipant): self
    {
        if (!$this->AppUserParticipant->contains($appUserParticipant)) {
            $this->AppUserParticipant[] = $appUserParticipant;
        }

        return $this;
    }

    public function removeAppUserParticipant(AppUser $appUserParticipant): self
    {
        if ($this->AppUserParticipant->contains($appUserParticipant)) {
            $this->AppUserParticipant->removeElement($appUserParticipant);
        }

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getEventTags(): Collection
    {
        return $this->EventTags;
    }

    public function addEventTag(Tag $eventTag): self
    {
        if (!$this->EventTags->contains($eventTag)) {
            $this->EventTags[] = $eventTag;
        }

        return $this;
    }

    public function removeEventTag(Tag $eventTag): self
    {
        if ($this->EventTags->contains($eventTag)) {
            $this->EventTags->removeElement($eventTag);
        }

        return $this;
    }

    public function getNbAlert(): ?int
    {
        return $this->nbAlert;
    }

    public function setNbAlert(?int $nbAlert): self
    {
        $this->nbAlert = $nbAlert;

        return $this;
    }

    public function __toString(){
        return $this->name;
    }

}
