<?php

namespace App\Controller;

use App\Controller\AbstractController\AbstractApiController;
use App\Entity\Player;
use App\Entity\PlayerQuest;
use App\Service\PlayerService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        if ($datas['search']) {
            $players = $playerService->search($datas);
            return $this->renderSerializeJson($players, ['player_get']);
        }
        return $this->renderSerializeJson([]);
    }

    #[Route('/{id}', name: 'update_player', methods: 'PUT')]
    public function updatePlayer(PlayerService $playerService, Request $request, $id) {
        $datas = json_decode($request->getContent(), true);
        if (isset($datas['is_playing']) && gettype($datas['is_playing']) === 'boolean') {
            $player = $this->entityManager->getRepository(Player::class)->find($id);
            if ($player){
                $player->setIsPlaying($datas['is_playing']);
                $this->entityManager->flush();
                return $this->renderSerializeJson($player, ['player_get']);
            }
            return new JsonResponse('Joueur inconnu',500, [], true);
        }
        return new JsonResponse('Une erreur c\'est produite',500, [], true);
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
