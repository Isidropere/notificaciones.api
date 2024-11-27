<?php
use DI\ContainerBuilder;
use Src\Config\Database;
use Src\Models\Productos;
use Src\Models\Notificaciones;
use Src\Models\Clientes;
use Src\Services\SuscripcionesService;
use Src\Services\NotificacionesService;

require_once __DIR__ . '/../../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions([
    Database::class => function () {
        return new Database();
    },
    PDO::class => function (Database $database) {
        return $database->getConnection();
    },
    Productos::class => function (PDO $pdo) {
        return new Productos($pdo);
    },
    SuscripcionesService::class => function (PDO $pdo) {
        return new SuscripcionesService($pdo);
    },

    NotificacionesService::class => function (PDO $pdo) {
        return new NotificacionesService($pdo);
    },
    Notificaciones::class => function (PDO $pdo) {
        return new Notificaciones($pdo);
    },
    Clientes::class => function (PDO $pdo) {
        return new Clientes($pdo);
    },
    
]);

return $containerBuilder->build();
