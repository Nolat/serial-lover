<?php

namespace App\Service;

use App\Entity\Player;
use App\Entity\PlayerQuest;
use App\Service\Interface\PlayerQuestServiceInterface;
use Doctrine\ORM\EntityManagerInterface;

class PlayerQuestService implements PlayerQuestServiceInterface
{
    private EntityManagerInterface $entityManager;
    private PlayerService $playerService;
    private QuestService $questService;

    public function __construct(EntityManagerInterface $entityManager, PlayerService $playerService, QuestService $questService) {
        $this->entityManager = $entityManager;
        $this->playerService = $playerService;
        $this->questService = $questService;
    }

    public function validPlayerQuest(Player $player): void
    {
        try {
            $currentQuest = $this->entityManager->getRepository(PlayerQuest::class)->findCurrentQuest($player);

            $currentQuest->setValid(true)
                ->setValidatedDate(new \DateTime());

            $this->entityManager->persist($currentQuest);
            $this->entityManager->flush();
        } catch (\Exception $e) {
        }
    }

    public function createPlayerQuest(Player $player): PlayerQuest|null
    {
        $quest = $this->questService->findRandomQuest($player);
        $target = $this->playerService->findRandomTarget($player);

        if (!$quest || !$target) {
            return null;
        }

        $newQuest = new PlayerQuest();
        $newQuest->setQuest($quest)
            ->setPlayer($player)
            ->setTarget($target);
        $this->entityManager->persist($newQuest);
        $this->entityManager->flush();

        return $newQuest;
    }
}
