<?php

namespace App\Controller;

use App\Controller\AbstractController\AbstractApiController;
use App\Entity\Player;
use App\Entity\PlayerQuest;
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

    #[Route('/{id}/quest', name: 'get_current_player_quest', methods: 'GET')]
    public function getCurrentPlayerQuest($id) {
        $player = $this->entityManager->getRepository(Player::class)->find($id);
        $currentQuest = $this->entityManager->getRepository(PlayerQuest::class)->findCurrentQuest($player);
        if ($currentQuest) {
            return $this->renderSerializeJson($currentQuest, ['player_get', 'player_quest_get', 'quest_get']);
        }
        return $this->renderSerializeJson('Vous avez terminé toutes les quêtes disponible, n\'hesitez pas à faire réclamation aux près d\'Alexis qui n\'a pas assez rempli la BDD OMG WTF WHAT ARE YOU DOING');
    }

    #[Route('/{id}/score', name: 'get_current_player_score', methods: 'GET')]
    public function getCurrentPlayerScore($id) {
        $player = $this->entityManager->getRepository(Player::class)->find($id);
        $nbValidatedQuests = $this->entityManager->getRepository(PlayerQuest::class)->findNbValidatedQuests($player);
        if ($nbValidatedQuests) {
            return $this->renderSerializeJson($nbValidatedQuests, ['player_get', 'player_quest_get', 'quest_get']);
        }
        return $this->renderSerializeJson('Vous avez terminé toutes les quêtes disponible, n\'hesitez pas à faire réclamation aux près d\'Alexis qui n\'a pas assez rempli la BDD OMG WTF WHAT ARE YOU DOING');
    }
}
