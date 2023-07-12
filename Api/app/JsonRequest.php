<?php

namespace App;

class JsonRequest
{
    public static function getRequestBody()
    {
        $json = file_get_contents('php://input');
        return json_decode($json, true);
    }
}
