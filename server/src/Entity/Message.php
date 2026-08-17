<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * 
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppUser", inversedBy="messagesSend")
     * @ORM\JoinColumn(nullable=false)
     * 
     */
    private $expeditor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppUser", inversedBy="messagesReceived")
     * @ORM\JoinColumn(nullable=false)
     * 
     */
    private $receiver;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
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

    public function getExpeditor(): ?AppUser
    {
        return $this->expeditor;
    }

    public function setExpeditor(?AppUser $expeditor): self
    {
        $this->expeditor = $expeditor;

        return $this;
    }

    public function getReceiver(): ?AppUser
    {
        return $this->receiver;
    }

    public function setReceiver(?AppUser $receiver): self
    {
        $this->receiver = $receiver;

        return $this;
    }
}
