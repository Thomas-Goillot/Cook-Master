<?php

ini_set('display_errors', 1);

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
$router->addRoute('POST', '/login', [$userController, 'login'], $authMiddleware);
$router->addRoute('POST', '/register', [$userController, 'register'], $authMiddleware);

$router->addRoute('GET', '/users/{id}', [$userController, 'getUser'], $authMiddleware);
$router->addRoute('GET', '/users', [$userController, 'getUsers'], $authMiddleware);
$router->addRoute('POST', '/users', [$userController, 'createUser'], $authMiddleware);
$router->addRoute('PATCH', '/users', [$userController, 'updateUser'], $authMiddleware);

$router->addRoute('GET', '/course/{id}', [$userController, 'getUserCourses'], $authMiddleware);


$router->addRoute('GET', '/shop', [$userController, 'getShop'], $authMiddleware);
$router->addRoute('GET', '/events/{id}', [$userController, 'getUserEvents'], $authMiddleware);
$router->addRoute('GET', '/pastevents/{id}', [$userController, 'getPastUserEvents'], $authMiddleware);
$router->addRoute('GET', '/events', [$userController, 'getAllEvents'], $authMiddleware);


// Récupérez la méthode HTTP et l'URI de la requête entrante (supposons qu'ils soient dans des variables $method et $uri)
$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Gérez la requête en utilisant le routeur
$router->handleRequest($method, $uri);
