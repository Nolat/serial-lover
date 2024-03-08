<?php

namespace App\Controller;

use App\Controller\AbstractController\AbstractApiController;
use App\Service\PlayerService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/players', name: 'api_players_')]
class PlayerController extends AbstractApiController
{
    #[Route('', name: 'get_all', methods: 'GET')]
    public function getAllPlayers(PlayerService $playerService, Request $request) {
        $datas = [
            'search' => $request->get('search')
        ];

        $players = $playerService->search($datas);

        return $this->renderSerializeJson($players, ['player_get']);
    }
}
