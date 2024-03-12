<?php

namespace App\Service\Interface;

use App\Entity\Player;
use App\Entity\Quest;

interface QuestServiceInterface
{
    /**
     * @param Player $player
     * @return Quest|null
     */
    public function findRandomQuest(Player $player): Quest|null;
}
