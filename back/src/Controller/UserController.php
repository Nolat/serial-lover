<?php

namespace App\Controller;

use App\Controller\AbstractController\AbstractApiController;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/users', name: 'api_users_')]
class UserController extends AbstractApiController
{
}
