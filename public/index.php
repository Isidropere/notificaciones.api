<?php
// Encabezados de seguridad y CORS
header("Access-Control-Allow-Origin: http://localhost:8081"); // Permite solicitudes solo desde tu dominio
header("Content-Type: application/json; charset=UTF-8");
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");
header("Content-Security-Policy: default-src 'self';");

require_once __DIR__ . '/../vendor/autoload.php';

// Crear el contenedor de dependencias
$container = require_once __DIR__ . '/../Src/Config/di-container.php';

use Src\Controllers\NotificacionesController;
use Src\Helpers\ResponseHelper_notificacion;

// Iniciar buffer de salida
ob_start();

// Obtener la conexión PDO desde el contenedor
$pdo = $container->get(PDO::class);

// Instanciar el controlador
$notificacionesController = $container->get(NotificacionesController::class);

// Detectar entorno para manejar solicitudes
if (php_sapi_name() === 'cli') {
    // Configuración simulada para CLI
    $requestMethod = 'GET';
    $requestUri = '/notificaciones';
} else {
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $requestUri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
}

// Enrutamiento básico
try {
    if ($requestUri === '/notificaciones' && $requestMethod === 'GET') {
        // Obtener todas las notificaciones
        $response = $notificacionesController->getAll();
        echo json_encode($response);
    } elseif (preg_match('/^\/notificaciones\/(\d+)$/', $requestUri, $matches) && $requestMethod === 'GET') {
        // Obtener una notificación por ID de cliemte para ver sus  notificaciones.
        $idCliente = $matches[1];
        $response = $notificacionesController->getById($idCliente);
        echo json_encode($response);
    } elseif ($requestUri === '/notificaciones' && $requestMethod === 'POST') {
        // Crear una nueva notificación
        $data = json_decode(file_get_contents('php://input'), true);
        $response = $notificacionesController->create($data);
        echo json_encode($response);
   } elseif (preg_match('/^\/notificaciones\/(\d+)$/', $requestUri, $matches) && $requestMethod === 'PUT') {
        // Actualizar una notificación por ID
        $id = $matches[1];
        $data = json_decode(file_get_contents('php://input'), true);
        $response = $notificacionesController->update($id, $data);
        echo json_encode($response);
    } elseif (preg_match('/^\/notificaciones\/updateLeido\/(\d+)$/', $requestUri, $matches) && $requestMethod === 'PUT') {
        // Actualizar una notificación específica por ID
        $id = $matches[1];
        $data = json_decode(file_get_contents('php://input'), true);
        $response = $notificacionesController->updateOne($id, $data);
        echo json_encode($response);
    } elseif (preg_match('/^\/notificaciones\/(\d+)$/', $requestUri, $matches) && $requestMethod === 'DELETE') {
        // Eliminar una notificación por ID
        $id = $matches[1];
        $response = $notificacionesController->delete($id);
        echo json_encode($response);
    } else {
        // Ruta no encontrada
        http_response_code(404);
        echo json_encode(ResponseHelper_NOTIFICACION::notFound("Ruta no encontrada."));
    }
} catch (Exception $e) {
    // Manejo de errores globales
    http_response_code(500);
    echo json_encode(ResponseHelper_NOTIFICACION::error($e->getMessage()));
}
