<?php

namespace App\Service;

use App\Entity\Player;
use App\Service\Interface\PlayerServiceInterface;
use Doctrine\ORM\EntityManagerInterface;

class PlayerService implements PlayerServiceInterface
{
    private EntityManagerInterface $entityManager;
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function search(array $datas): array
    {
        $players = $this->entityManager->getRepository(Player::class)->search($datas);
        return $players;
    }

    public function findRandomTarget(Player $player): Player|null
    {
       return $this->entityManager->getRepository(Player::class)->findRandomTarget($player);
    }
}
