<?php

namespace App;

use Controllers\Home;
use Controllers\ErrorHttp;

class Router
{
    public function __construct($params)
    {

        $params = explode('/', $params);

        $nbParams = count($params);

        $pathErrorHttp = "";

        for ($i = 0; $i < $nbParams; $i++) {
            $pathErrorHttp .= "../";
        }

        if ($params[0] != "") {

            $controller = ucfirst($params[0]);

            $action = isset($params[1]) ? $params[1] : 'index';

            $_GET['params'] = array_slice($params, 2);

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
            call_user_func_array([$controller, $action], $params);

        } else {
            $controller = new Home();
            
            $controller->index();
        }
    }
}
