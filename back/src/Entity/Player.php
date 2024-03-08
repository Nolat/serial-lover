<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
class Player
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['player_get'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['player_get'])]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    #[Groups(['player_get'])]
    private ?string $lastname = null;

    #[ORM\Column(options: ['default' => false])]
    #[Groups(['player_get'])]
    private ?bool $isPlaying = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function isIsPlaying(): ?bool
    {
        return $this->isPlaying;
    }

    public function setIsPlaying(bool $isPlaying): static
    {
        $this->isPlaying = $isPlaying;

        return $this;
    }
}
