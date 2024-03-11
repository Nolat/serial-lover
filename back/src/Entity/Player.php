<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

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

    #[ORM\OneToMany(targetEntity: PlayerQuest::class, mappedBy: 'player')]
    private Collection $playerQuests;

    public function __construct()
    {
        $this->playerQuests = new ArrayCollection();
    }

    #[VirtualProperty]
    public function getQuestFromPlayerQuests() {
        $array = [];
        foreach ($this->playerQuests as $playerQuest) {
            $array[] = $playerQuest->getQuest()->getId();
        }

        return $array;
    }

    #[VirtualProperty]
    public function getTargetFromPlayerQuests() {
        $array = [];
        foreach ($this->playerQuests as $playerQuest) {
            $array[] = $playerQuest->getTarget()->getId();
        }

        return $array;
    }

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

    /**
     * @return Collection<int, PlayerQuest>
     */
    public function getPlayerQuests(): Collection
    {
        return $this->playerQuests;
    }

    public function addPlayerQuest(PlayerQuest $playerQuest): static
    {
        if (!$this->playerQuests->contains($playerQuest)) {
            $this->playerQuests->add($playerQuest);
            $playerQuest->setPlayer($this);
        }

        return $this;
    }

    public function removePlayerQuest(PlayerQuest $playerQuest): static
    {
        if ($this->playerQuests->removeElement($playerQuest)) {
            // set the owning side to null (unless already changed)
            if ($playerQuest->getPlayer() === $this) {
                $playerQuest->setPlayer(null);
            }
        }

        return $this;
    }
}
