<?php
namespace Src\Controllers;

use Src\Models\Notificaciones;
use Src\Helpers\ResponseHelper_notificacion;
use Src\Services\NotificacionesService;

class NotificacionesController
{
    private $notificaciones;
    private $NotificacionesService;
    private $clienteReceptor;
 

    public function __construct(Notificaciones $notificaciones, NotificacionesService $NotificacionesService)
    {
        $this->notificaciones = $notificaciones;
        $this->NotificacionesService = $NotificacionesService;
    }

  

    // Obtener todas las notificaciones
    public function getAll()
    {
        try {
            $result = $this->notificaciones->getAll();
            return ResponseHelper_notificacion::success($result);
        } catch (\Exception $e) {
            return ResponseHelper_notificacion::error($e->getMessage());
        }
    }

    // Obtener una notificación por idCliente
    public function getById($idCliente)
    {
        try {
            $result = $this->notificaciones->getById($idCliente);
            if ($result) {
                return ResponseHelper_notificacion::success($result);
            } else {
                return ResponseHelper_notificacion::notFound("Notificación no encontrada.");
            }
        } catch (\Exception $e) {
            return ResponseHelper_notificacion::error($e->getMessage());
        }
    }

    // Crear una nueva notificación
    public function create($data)
    { 
         // Validar los datos antes de continuar
         $validationErrors = \Src\Validation\NotificacionValidaciones::validateCreateNotificacion($data);

         // Si hay errores de validación, devolverlos como respuesta
             if (!empty($validationErrors)) {
                 return ResponseHelper_notificacion::error(
                     "Datos de notificacion inválidos",
                     ['errors' => $validationErrors]
                 );
             }
        try {
            $isCreated = $this->notificaciones->create($data);
            if ($isCreated) {
                $FechaActual =  (new \DateTime())->format('Y-m-d H:i:s') ;
                $this->NotificacionesService->CreateTtransaccion(
                    $data['id_producto_notificaciones'],
                    $data['id_cliente_notificaciones'],
                    $data['id_cliente_Receptor'],
                    $data['TipoNotificacion'], /*'Solicitud','Pendiente','Aceptada','Rechazada','Completada','Alerta','Mensaje'*/
                    $FechaActual, 
                    $FechaActual
                );

                return ResponseHelper_notificacion::success(
                    200,
                    "The process was successful",
                    "¡Éxito! La notificacion fue creado correctamente.",
                );
            } else {
                return ResponseHelper_notificacion::error("Error al crear la notificación.");
            }
        } catch (\Exception $e) {
            return ResponseHelper_notificacion::error($e->getMessage());
        }
    }

    // Actualizar una notificación por ID
    public function update($id, $data)
    {
        try {
            $isUpdated = $this->notificaciones->update($id, $data);
            if ($isUpdated) {
                return ResponseHelper_notificacion::success("Notificación actualizada exitosamente.");
            } else {
                return ResponseHelper_notificacion::notFound("Error al actualizar, notificación no encontrada.");
            }
        } catch (\Exception $e) {
            return ResponseHelper_notificacion::error($e->getMessage());
        }
    }
    public function updateOne($id, $data)
    {
        try {
            $isUpdated = $this->notificaciones->updateOne($id, $data);
            if ($isUpdated) {
                return ResponseHelper_notificacion::success("Notificación actualizada exitosamente.");
            } else {
                return ResponseHelper_notificacion::notFound("Error al actualizar, notificación no encontrada.");
            }
        } catch (\Exception $e) {
            return ResponseHelper_notificacion::error($e->getMessage());
        }
    }

    // Eliminar una notificación por ID
    public function delete($id)
    {
        try {
            $isDeleted = $this->notificaciones->delete($id);
            if ($isDeleted) {
                return ResponseHelper_notificacion::success("Notificación eliminada exitosamente.");
            } else {
                return ResponseHelper_notificacion::notFound("Error al eliminar, notificación no encontrada.");
            }
        } catch (\Exception $e) {
            return ResponseHelper_notificacion::error($e->getMessage());
        }
    }
}
