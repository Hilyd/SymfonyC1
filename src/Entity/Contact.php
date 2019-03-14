<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as A;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */

class Contact
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     * @A\NotBlank()
     * @A\Length(max=40)
     */
    private $subject;

    /**
     * @ORM\Column(type="string", length=80)
     * @A\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="text")
     * @A\NotBlank()
     * @A\Length(min=10)
     */
    private $message;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

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

    public function getmessage(): ?string
    {
        return $this->message;
    }

    public function setmessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
