<?php

namespace App\Service\Interface;

use App\Entity\Player;
use App\Entity\PlayerQuest;

interface PlayerQuestServiceInterface
{
    /**
     * @param Player $player
     * @return void
     */
    public function validPlayerQuest(Player $player): void;

    /**
     * @param Player $player
     * @return PlayerQuest
     */
    public function createPlayerQuest(Player $player): PlayerQuest|null;
}
