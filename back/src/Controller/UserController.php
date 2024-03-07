<?php

namespace App\Controller;

use App\Controller\AbstractController\AbstractApiController;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/user', name: 'api_user_')]
class UserController extends AbstractApiController
{

}
