<?php

namespace Routes;

use App\JsonRequest;
use App\JsonResponse;
use Model\UserRepository;

class UserRoutes
{
    public function getUsers()
    {
        $userRepository = new UserRepository();

        $users = $userRepository->getAllUsers();

        JsonResponse::success($users);
    }
 
    public function createUser()
    {
        $requestData = JsonRequest::getRequestBody();

        if (!isset($requestData['name']) || empty($requestData['name'])) {
            JsonResponse::error('Le nom de l\'utilisateur est requis', 400);
        }

       
    }

    public function getUser($id)
    {
        $userRepository = new UserRepository();

        $user = $userRepository->getUserById($id);

        if (!$user) {
            JsonResponse::error('Utilisateur non trouvé', 404);
        }

        JsonResponse::success($user);
    }
}
