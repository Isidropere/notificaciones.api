<?php
namespace Src\Helpers;

class ResponseHelper_notificacion
{
    public static function success($data, $message = "Operación exitosa")
    {
        $response = [
            "status" => "success",
            "message" => $message,
            "data" => $data
        ];

        header('Content-Type: application/json');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }

    public static function error($message, $code = 500)
    {
        $response = [
            "status" => "error",
            "message" => $message,
            "code" => $code
        ];

        header('Content-Type: application/json');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }

    public static function notFound($message = "Recurso no encontrado")
    {
        $response = [
            "status" => "error",
            "message" => $message,
            "code" => 404
        ];

        header('Content-Type: application/json');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
}
