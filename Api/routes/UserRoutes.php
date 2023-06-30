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
            $password = hash('sha256', $password . 'cookmaster');
        }

        return $password;
    }

    public function login(){

        $requestData = JsonRequest::getRequestBody();

        $email = $requestData['email'] ?? null;
        $password = $requestData['password'] ?? null;

        if (!isset($email) || empty($email) || !isset($password) || empty($password)) {
            JsonResponse::error('L\'email et le mot de passe sont requis', 400);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            JsonResponse::error('L\'email n\'est pas valide', 400);
        }

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


    public function register(){

        $requestData = JsonRequest::getRequestBody();

        $email = $requestData['email'] ?? null;
        $password = $requestData['password'] ?? null;
        $name = $requestData['name'] ?? null;
        $surname = $requestData['surname'] ?? null;
        $phone = $requestData['phone'] ?? null;

        if (!isset($email) || empty($email) || !isset($password) || empty($password) || !isset($name) || empty($name) || !isset($surname) || empty($surname) || !isset($phone) || empty($phone)) {
            JsonResponse::error('L\'email, le mot de passe, le nom, le prénom et le téléphone sont requis', 400);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            JsonResponse::error('L\'email n\'est pas valide', 400);
        }

        if (strlen($password) < 8 && strlen($password) > 35) {
            JsonResponse::error('Le mot de passe doit contenir au moins '. 8 .' caractères', 400);
        }

        if(strlen($name) > 100){
            JsonResponse::error('Le nom ne doit pas dépasser 100 caractères', 400);
        }

        if(strlen($surname) > 100){
            JsonResponse::error('Le prénom ne doit pas dépasser 100 caractères', 400);
        }

        if(strlen($phone) > 25 && strlen($phone) < 10){
            JsonResponse::error('Le numéro de téléphone ne doit pas dépasser 10 caractères', 400);
        }

        //check if the email is already used
        $userRepository = new UserRepository();
        $user = $userRepository->getUserByEmail($email);

        if ($user) {
            JsonResponse::error('L\'email est déjà utilisé', 400);
        }

        $password = $this->hashPassword($password);

        $userRepository->createUser($name, $surname, $email, $phone, $password);

        JsonResponse::success("L'utilisateur a bien été créé");
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
