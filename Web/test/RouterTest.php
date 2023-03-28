<?php

use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{

    public function testRouterWithValidControllerAndAction()
    {
        $params = 'user/profile';
        $router = new App\Router($params);

        // Vérifier que le code de réponse est 200 OK
        $this->assertEquals(http_response_code(), 200);

        // Vérifier que l'action appelée est bien 'profile'
        $this->expectOutputString('Profile page');
    }

    public function testRouterWithInvalidController()
    {
        $params = 'invalidController';
        $router = new App\Router($params);

        // Vérifier que le code de réponse est 404 Not Found
        $this->assertEquals(http_response_code(), 404);

        // Vérifier que le message d'erreur est correct
        $this->expectOutputString("La page recherchée n'existe pas");
    }

    public function testRouterWithInvalidAction()
    {
        $params = 'user/invalidAction';
        $router = new App\Router($params);

        // Vérifier que le code de réponse est 404 Not Found
        $this->assertEquals(http_response_code(), 404);

        // Vérifier que le message d'erreur est correct
        $this->expectOutputString("La page recherchée n'existe pas");
    }
}
