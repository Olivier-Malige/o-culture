<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation\Exclude;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AppUserRepository")
 * @UniqueEntity(fields="username", message="ce username existe déjà")
 * @UniqueEntity(fields="email", message="Cette adresse email existe déjà")
 */
class AppUser implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"appuser_list", "event_list"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=89, unique=true)
     * @Groups({"appuser_detail", "appuser_list"})
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=89, unique=true)
     * @Groups({"appuser_detail", "appuser_list"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=89)
     * @Exclude
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=89, nullable=true)
     * @Groups({"place_detail", "event_list", "event_detail", "appuser_detail", "appuser_list", "appuser_a_detail"})
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"appuser_a_o_detail"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=144, nullable=true)
     * @Groups({"appuser_detail"})
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=89)
     * @Groups({"appuser_detail"})
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=144, nullable=true)
     * @Groups({"appuser_a_o_detail"})
     */
    private $facebook;

    /**
     * @ORM\Column(type="string", length=144, nullable=true)
     * @Groups({"appuser_a_o_detail"})
     */
    private $twitter;

    /**
     * @ORM\Column(type="string", length=89, nullable=true)
     * @Groups({"appuser_a_o_detail"})
     */
    private $website;

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
     * @ORM\OneToMany(targetEntity="App\Entity\Event", mappedBy="appUserCreator", cascade={"remove"})
     * @Groups({"appuser_a_o_detail","appuser_detail"})
     */
    private $events;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Place", mappedBy="AppUserCreator", cascade={"remove"})
     * @Groups({"appuser_a_o_detail"})
     */
    private $places;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Role", inversedBy="appUsers")
     * @Groups({"appuser_list"})
     */
    private $role;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="AppUser", cascade={"remove"})
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="expeditor", cascade={"persist"})
     * 
     */
    private $messagesSend;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="receiver", cascade={"persist"})
     * 
     */
    private $messagesReceived;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Event", mappedBy="AppUserPerformer")
     * @ORM\JoinTable(name="event_performer_appuser")
     * @Groups({"appuser_a_o_detail"})
     */
    private $EventsPro;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Event", mappedBy="AppUserParticipant")
     * @ORM\JoinTable(name="event_participant_appuser")
     * @Groups({"appuser_detail"})
     */
    private $EventsParticipant;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ArtistType", inversedBy="appUsers")
     * @Groups({"appuser_a_detail"})
     */
    private $AppUserArtistType;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"appuser_detail"})
     */
    private $zipcode;

    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->places = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->messagesSend = new ArrayCollection();
        $this->messagesReceived = new ArrayCollection();
        $this->EventsPro = new ArrayCollection();
        $this->EventsParticipant = new ArrayCollection();
        $this->AppUserArtistType = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->isActive = true;
    }
    ///////// UserInterface //////////////
    public function getSalt()
    {
        return null;
    }
    public function eraseCredentials(): void
    {
    }

    /**
     * Login identifier: the firewall looks up users by email.
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }
    //////////////////////////////////////
    public function getId()
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

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

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): self
    {
        $this->twitter = $twitter;

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
            $event->setAppUserCreator($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->contains($event)) {
            $this->events->removeElement($event);
            // set the owning side to null (unless already changed)
            if ($event->getAppUserCreator() === $this) {
                $event->setAppUserCreator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Place[]
     */
    public function getPlaces(): Collection
    {
        return $this->places;
    }

    public function addPlace(Place $place): self
    {
        if (!$this->places->contains($place)) {
            $this->places[] = $place;
            $place->setAppUserCreator($this);
        }

        return $this;
    }

    public function removePlace(Place $place): self
    {
        if ($this->places->contains($place)) {
            $this->places->removeElement($place);
            // set the owning side to null (unless already changed)
            if ($place->getAppUserCreator() === $this) {
                $place->setAppUserCreator(null);
            }
        }

        return $this;
    }

    public function getRoles(): array
    {
       $role = $this->getRole();

       return $role ? array($role->getCode()) : array('ROLE_USER');
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

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
            $comment->setAppUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getAppUser() === $this) {
                $comment->setAppUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessagesReceived(): Collection
    {
        return $this->messagesReceived;
    }

    public function addMessagesReceived(Message $messagesReceived): self
    {
        if (!$this->messagesReceived->contains($messagesReceived)) {
            $this->messagesReceived[] = $messagesReceived;
            $messagesReceived->setReceiver($this);
        }

        return $this;
    }

    public function removeMessagesReceived(Message $messagesReceived): self
    {
        if ($this->messagesReceived->contains($messagesReceived)) {
            $this->messagesReceived->removeElement($messagesReceived);
            // set the owning side to null (unless already changed)
            if ($messagesReceived->getReceiver() === $this) {
                $messagesReceived->setReceiver(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessagesSend(): Collection
    {
        return $this->messagesSend;
    }

    public function addMessagesSend(Message $messagesSend): self
    {
        if (!$this->messagesSend->contains($messagesSend)) {
            $this->messagesSend[] = $messagesSend;
            $messagesSend->setExpeditor($this);
        }

        return $this;
    }

    public function removeMessagesSend(Message $messagesSend): self
    {
        if ($this->messagesSend->contains($messagesSend)) {
            $this->messagesSend->removeElement($messagesSend);
            // set the owning side to null (unless already changed)
            if ($messagesSend->getExpeditor() === $this) {
                $messagesSend->setExpeditor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getEventsPro(): Collection
    {
        return $this->EventsPro;
    }

    public function addEventsPro(Event $eventsPro): self
    {
        if (!$this->EventsPro->contains($eventsPro)) {
            $this->EventsPro[] = $eventsPro;
            $eventsPro->addAppUserPerformer($this);
        }

        return $this;
    }

    public function removeEventsPro(Event $eventsPro): self
    {
        if ($this->EventsPro->contains($eventsPro)) {
            $this->EventsPro->removeElement($eventsPro);
            $eventsPro->removeAppUserPerformer($this);
        }

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getEventsParticipant(): Collection
    {
        return $this->EventsParticipant;
    }

    public function addEventsParticipant(Event $eventsParticipant): self
    {
        if (!$this->EventsParticipant->contains($eventsParticipant)) {
            $this->EventsParticipant[] = $eventsParticipant;
            $eventsParticipant->addAppUserParticipant($this);
        }

        return $this;
    }

    public function removeEventsParticipant(Event $eventsParticipant): self
    {
        if ($this->EventsParticipant->contains($eventsParticipant)) {
            $this->EventsParticipant->removeElement($eventsParticipant);
            $eventsParticipant->removeAppUserParticipant($this);
        }

        return $this;
    }

    /**
     * @return Collection|ArtistType[]
     */
    public function getAppUserArtistType(): Collection
    {
        return $this->AppUserArtistType;
    }

    public function addAppUserArtistType(ArtistType $appUserArtistType): self
    {
        if (!$this->AppUserArtistType->contains($appUserArtistType)) {
            $this->AppUserArtistType[] = $appUserArtistType;
        }

        return $this;
    }

    public function removeAppUserArtistType(ArtistType $appUserArtistType): self
    {
        if ($this->AppUserArtistType->contains($appUserArtistType)) {
            $this->AppUserArtistType->removeElement($appUserArtistType);
        }

        return $this;
    }

    public function __toString(){
        return $this->username;
    }

    public function getZipcode(): ?int
    {
        return $this->zipcode;
    }

    public function setZipcode(int $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }
}
