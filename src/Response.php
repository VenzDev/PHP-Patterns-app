<?php

namespace App;

class Response
{
    public static function MethodNotFound()
    {
        $data = [
            'status'  => 'error',
            'message' => 'Method not found',
            'code'    => 422
        ];

        self::jsonOutput(422, $data);
    }

    public static function json($status, $data, $message, $code)
    {
        $data = [
            'status'  => $status,
            'message' => $message,
            'code'    => $code,
            'data'    => $data
        ];

        self::jsonOutput($code, $data);
    }

    private static function jsonOutput($code, $data)
    {
        http_response_code($code);
        echo '<pre>';
        echo json_encode($data);
        echo '</pre>';
        exit;
    }

}