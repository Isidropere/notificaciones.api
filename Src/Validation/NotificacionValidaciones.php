<?php
namespace Src\Validation;

class NotificacionValidaciones{

    public static function validateCreateNotificacion($data){

        // Validar que los campos necesarios existan y sean válidos
        $errors = [];

        if (empty($data['id_cliente_notificaciones']) || !is_numeric($data['id_cliente_notificaciones'])) {
            $errors[] = 'El id_cliente_notificaciones es obligatorio y debe ser numérico.';
        }

        if (empty($data['id_producto_notificaciones']) || !is_numeric($data['id_producto_notificaciones'])) {
            $errors[] = 'El id_producto_notificaciones es obligatorio y debe ser numérico.';
        } 

        if (empty($data['Contenido'])) {
            $errors[] = 'El mensaje de notificacion es obligatorio.';
        }

        if (!isset($data['Leido']) || !in_array($data['Leido'], [0, 1], true)) {
            $errors[] = 'El estatus de la notificación debe ser 0 o 1.';
        }
        

        // Validar la fecha de creación
        if (empty($data['FechaCreacion']) || !strtotime($data['FechaCreacion'])) {
            $errors[] = 'La fecha de creación de la notificacion es obligatoria y debe ser una fecha válida.';
        }

        return $errors;

    }
}