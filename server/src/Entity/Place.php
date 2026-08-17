<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlaceRepository")
 */
class Place
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"place_list", "place_detail","event_list", "event_detail", "appuser_detail","appuser_a_o_detail"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=144)
     * @Groups({"place_list", "place_detail", "event_detail", "appuser_detail", "appuser_a_o_detail","event_list"})
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * 
     */
    private $siret;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"place_list","place_detail", "event_detail", "appuser_a_o_detail"})
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=144)
     * @Groups({"place_list", "place_detail", "event_detail", "event_list", "appuser_a_o_detail"})
     */
    private $city;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"place_list", "place_detail", "event_detail", "appuser_a_o_detail", "event_list"})
     */
    private $zipcode;

    /**
     * @ORM\Column(type="string", length=89, nullable=true)
     * @Groups({"place_detail", "event_detail", "appuser_a_o_detail", "event_list","place_list"})
     */
    private $email;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"place_detail","place_list", "appuser_a_o_detail"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=89, nullable=true)
     * @Groups({"place_detail", "appuser_a_o_detail","place_list"})
     */
    private $website;

    /**
     * @ORM\Column(type="string", length=500)
     * @Groups({"place_list", "place_detail", "appuser_a_o_detail"})
     */
    private $image;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=144, nullable=true)
     * @Groups({"place_detail", "appuser_a_o_detail"})
     */
    private $facebook;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Event", mappedBy="eventPlace", cascade={"remove"})
     * @Groups({"place_detail"})
     */
    private $events;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppUser", inversedBy="places", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"place_detail"})
     */
    private $AppUserCreator;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="Place", cascade={"remove"})
     * @Groups({"place_detail"})
     */
    private $comments;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PlaceType", inversedBy="Places")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"place_list", "place_detail","event_detail","event_list", "appuser_a_o_detail"})
     */
    private $PlaceType;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbAlert;

    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->comments = new ArrayCollection();
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

    public function getSiret(): ?int
    {
        return $this->siret;
    }

    public function setSiret(?int $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZipcode(): ?int
    {
        return $this->zipcode;
    }

    public function setZipcode(int $zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

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

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

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

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->setEventPlace($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->contains($event)) {
            $this->events->removeElement($event);
            // set the owning side to null (unless already changed)
            if ($event->getEventPlace() === $this) {
                $event->setEventPlace(null);
            }
        }

        return $this;
    }

    public function getAppUserCreator(): ?AppUser
    {
        return $this->AppUserCreator;
    }

    public function setAppUserCreator(?AppUser $AppUserCreator): self
    {
        $this->AppUserCreator = $AppUserCreator;

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
            $comment->setPlace($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getPlace() === $this) {
                $comment->setPlace(null);
            }
        }

        return $this;
    }

    public function getPlaceType(): ?PlaceType
    {
        return $this->PlaceType;
    }

    public function setPlaceType(?PlaceType $PlaceType): self
    {
        $this->PlaceType = $PlaceType;

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
