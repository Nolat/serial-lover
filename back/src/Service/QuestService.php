<?php

namespace App\Service;

use App\Entity\Player;
use App\Entity\Quest;
use App\Service\Interface\PlayerServiceInterface;
use App\Service\Interface\QuestServiceInterface;
use Doctrine\ORM\EntityManagerInterface;

class QuestService implements QuestServiceInterface
{
    private EntityManagerInterface $entityManager;
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function findRandomQuest(Player $player): Quest|null
    {
        return $this->entityManager->getRepository(Quest::class)->findRandomQuest($player);
    }
}
