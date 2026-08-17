<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;
/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"event_detail", "place_detail"})
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Groups({"event_detail", "place_detail"})
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"place_detail", "event_detail"})
     * @Type("DateTime<'Y-m-d h:i'>")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"event_detail"})
     */
    private $nbLikes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Event", inversedBy="comments")
     */
    private $Event;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Place", inversedBy="comments")
     */
    private $Place;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppUser", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"place_detail","event_detail"})
     */
    private $AppUser;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"event_detail", "place_detail"})
     */
    private $nbAlert;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->isActive = true;
        $this->status = 1;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function getNbLikes(): ?int
    {
        return $this->nbLikes;
    }

    public function setNbLikes(?int $nbLikes): self
    {
        $this->nbLikes = $nbLikes;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->Event;
    }

    public function setEvent(?Event $Event): self
    {
        $this->Event = $Event;

        return $this;
    }

    public function getPlace(): ?Place
    {
        return $this->Place;
    }

    public function setPlace(?Place $Place): self
    {
        $this->Place = $Place;

        return $this;
    }

    public function getAppUser(): ?AppUser
    {
        return $this->AppUser;
    }

    public function setAppUser(?AppUser $AppUser): self
    {
        $this->AppUser = $AppUser;

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

    public function getNbAlert(): ?int
    {
        return $this->nbAlert;
    }

    public function setNbAlert(?int $nbAlert): self
    {
        $this->nbAlert = $nbAlert;

        return $this;
    }
}
