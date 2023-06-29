<?php

namespace Routes;

use App\JsonRequest;
use App\JsonResponse;
use Model\UserRepository;

class UserRoutes
{

    private function hashPassword(string $password): string
    {

        for ($i = 0; $i < 12; $i++) {
            $password = hash('sha256', $password . 12);
        }

        return $password;
    }

    public function login(){

        $requestData = JsonRequest::getRequestBody();

        $email = $requestData['email'];
        $password = $requestData['password'];

        //check if email and password are not empty and set
        if (!isset($email) || empty($email) || !isset($password) || empty($password)) {
            JsonResponse::error('L\'email et le mot de passe sont requis', 400);
        }

        //check that the email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            JsonResponse::error('L\'email n\'est pas valide', 400);
        }

        //check that the password is valid
        if (strlen($password) < 8) {
            JsonResponse::error('Le mot de passe doit contenir au moins '. 8 .' caractères', 400);
        }

        $password = $this->hashPassword($password);

        $userRepository = new UserRepository();

        $user = $userRepository->getUserByEmailAndPassword($email, $password);

        if (!$user) {
            JsonResponse::error('Identifiant incorect', 404);
        }

        JsonResponse::success($user['id_users']);
        
    }


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
