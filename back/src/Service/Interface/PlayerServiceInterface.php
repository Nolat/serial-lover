<?php

namespace App\Service\Interface;

use App\Entity\Player;

interface PlayerServiceInterface
{
    /**
     * @param array $datas
     * @return array
     */
    public function search(array $datas): array;
}
