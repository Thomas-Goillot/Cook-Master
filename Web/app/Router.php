<?php 

namespace App;

use Controllers\Main;

class Router {
    public function __construct($params){

        $params = explode('/', $params);

        if ($params[0] != "") {
            $controller = ucfirst($params[0]);

            $action = isset($params[1]) ? $params[1] : 'index';

            $controller = "Controllers\\".$controller;

            $controller = new $controller();

            if (method_exists($controller, $action)) {
                unset($params[0]);
                unset($params[1]);
                call_user_func_array([$controller, $action], $params);
            } else {
                http_response_code(404);
                echo "La page recherchée n'existe pas";
            }
        } else {

            $controller = new Main();

            $controller->index();
        }

    }
}


?>