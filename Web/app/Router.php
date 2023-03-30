<?php

namespace App;

use Controllers\Home;
use Controllers\ErrorHttp;

class Router
{
    public function __construct($params)
    {

        $params = explode('/', $params);

        if ($params[0] != "") {


            $controller = ucfirst($params[0]);

            $action = isset($params[1]) ? $params[1] : 'index';

            $controller = "Controllers\\" . $controller;

            if (!class_exists($controller)) {
                http_response_code(404);
                $controller = new ErrorHttp();

                $controller->error();

                return;

            }

            if (!method_exists($controller, $action)) {
                http_response_code(404);
                $controller = new ErrorHttp();

                $controller->error();

                return;
            }

            http_response_code(200);

            $controller = new $controller();
            unset($params[0]);
            unset($params[1]);
            call_user_func_array([$controller, $action], $params);

        } else {
            $controller = new Home();
            $controller->acceuil();
        }
    }
}
