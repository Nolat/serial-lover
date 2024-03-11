<?php

namespace App\Entity;

use App\Repository\QuestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: QuestRepository::class)]
class Quest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['quest_get'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['quest_get'])]
    private ?string $content = null;

    #[ORM\OneToMany(targetEntity: PlayerQuest::class, mappedBy: 'quest')]
    private Collection $playerQuests;

    public function __construct()
    {
        $this->playerQuests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

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
            $playerQuest->setQuest($this);
        }

        return $this;
    }

    public function removePlayerQuest(PlayerQuest $playerQuest): static
    {
        if ($this->playerQuests->removeElement($playerQuest)) {
            // set the owning side to null (unless already changed)
            if ($playerQuest->getQuest() === $this) {
                $playerQuest->setQuest(null);
            }
        }

        return $this;
    }
}
