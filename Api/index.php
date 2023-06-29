<?php

ini_set('display_errors', 1);

require('../web/config/config.php');
require('vendor/autoload.php');

use App\JsonResponse;
use App\Router;
use Routes\UserRoutes;

$router = new Router();

$userController = new UserRoutes();

$validAccessToken = 'test';

$authMiddleware = function () use ($validAccessToken) {
    $headers = getallheaders();
    return true;
/*     if (isset($headers['Authorization']) && $headers['Authorization'] === 'Bearer ' . $validAccessToken) {
        return true;
    } else {
        JsonResponse::error('Unauthorized', 401);
        return false;
    } */
};

// Ajoutez des routes en utilisant les méthodes du contrôleur d'utilisateurs
$router->addRoute('GET', '/login/{email}/{password}', [$userController, 'login'], $authMiddleware);

$router->addRoute('GET', '/users/{id}', [$userController, 'getUser'], $authMiddleware);
$router->addRoute('GET', '/users', [$userController, 'getUsers'], $authMiddleware);
$router->addRoute('POST', '/users', [$userController, 'createUser'], $authMiddleware);

// Récupérez la méthode HTTP et l'URI de la requête entrante (supposons qu'ils soient dans des variables $method et $uri)
$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Gérez la requête en utilisant le routeur
$router->handleRequest($method, $uri);
