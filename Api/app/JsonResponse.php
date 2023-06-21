<?php

namespace App;

class JsonResponse
{
    public static function success($data = null)
    {
        $response = [
            'success' => true,
            'data' => $data
        ];
        self::sendResponse($response);
    }

    public static function error($message, $statusCode = 400)
    {
        $response = [
            'success' => false,
            'error' => [
                'message' => $message
            ]
        ];
        self::sendResponse($response, $statusCode);
    }

    private static function sendResponse($response, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
}

?>