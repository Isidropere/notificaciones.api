<?php
namespace Src\Helpers;

class ResponseHelper {
    public static function sendResponse($status, $comment, $message = null, $redirect = null, $result = null) {
        $response = [
            "status" => $status,
            "comment" => $comment,
        ];

        // Agregar los campos opcionales solo si tienen valor
        if (!empty($message)) {
            $response["message"] = $message;
        }

        if (!empty($redirect)) {
            $response["redirect"] = $redirect;
        }

        if (!empty($result)) {
            $response["result"] = $result;
        }

        // Establecer encabezado JSON y retornar la respuesta
        header('Content-Type: application/json');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
};



