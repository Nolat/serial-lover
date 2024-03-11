<?php

namespace App\Entity;

use App\Repository\PlayerQuestRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PlayerQuestRepository::class)]
class PlayerQuest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['player_quest_get'])]
    private ?int $id = null;

    #[ORM\Column(options: ['default' => false])]
    #[Groups(['player_quest_get'])]
    private ?bool $valid = false;

    #[ORM\ManyToOne()]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['player_quest_get'])]
    private ?Player $target = null;

    #[ORM\ManyToOne(inversedBy: 'playerQuests')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['player_quest_get'])]
    private ?Quest $quest = null;

    #[ORM\ManyToOne(inversedBy: 'playerQuests')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['player_quest_get'])]
    private ?Player $player = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $validatedDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isValid(): ?bool
    {
        return $this->valid;
    }

    public function setValid(bool $valid): static
    {
        $this->valid = $valid;

        return $this;
    }

    public function getTarget(): ?Player
    {
        return $this->target;
    }

    public function setTarget(?Player $target): static
    {
        $this->target = $target;

        return $this;
    }

    public function getQuest(): ?Quest
    {
        return $this->quest;
    }

    public function setQuest(?Quest $quest): static
    {
        $this->quest = $quest;

        return $this;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): static
    {
        $this->player = $player;

        return $this;
    }

    public function getValidatedDate(): ?\DateTimeInterface
    {
        return $this->validatedDate;
    }

    public function setValidatedDate(?\DateTimeInterface $validatedDate): static
    {
        $this->validatedDate = $validatedDate;

        return $this;
    }
}
