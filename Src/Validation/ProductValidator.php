<?php
namespace Src\Validation;

class ProductValidator
{
    public static function validateCreateProduct($data)
    {
        // Validar que los campos necesarios existan y sean válidos
        $errors = [];

        if (empty($data['id_cliente_producto']) || !is_numeric($data['id_cliente_producto'])) {
            $errors[] = 'El id_cliente_producto es obligatorio y debe ser numérico.';
        }

        if (empty($data['nombre_producto'])) {
            $errors[] = 'El nombre del producto es obligatorio.';
        }

        if (empty($data['precio_producto']) || !is_numeric($data['precio_producto'])) {
            $errors[] = 'El precio del producto es obligatorio y debe ser numérico.';
        }

        if (empty($data['img_prin_producto'])) {
            $errors[] = 'La imagen principal del producto es obligatoria.';
        }

        if (empty($data['tipo_producto'])) {
            $errors[] = 'El tipo de producto es obligatorio.';
        }

        if (empty($data['descripcion_producto'])) {
            $errors[] = 'La descripción del producto es obligatoria.';
        }

        if (empty($data['categoria_producto'])) {
            $errors[] = 'La categoría del producto es obligatoria.';
        }

        if (empty($data['status_producto'])) {
            $errors[] = 'El estado del producto es obligatorio.';
        }

        if (empty($data['estado_producto'])) {
            $errors[] = 'El estado del producto es obligatorio.';
        }

        if (empty($data['cantida_producto']) || !is_numeric($data['cantida_producto'])) {
            $errors[] = 'La cantidad del producto es obligatoria y debe ser numérica.';
        }

        if (empty($data['id_carrito_producto'])) {
            $errors[] = 'El id del carrito del producto es obligatorio.';
        }

        // Validar las imágenes adicionales
        for ($i = 1; $i <= 6; $i++) {
            if (isset($data["img{$i}_producto"]) && empty($data["img{$i}_producto"])) {
                $errors[] = "La imagen $i del producto no puede estar vacía.";
            }
        }

        // Validar la fecha de creación
        if (empty($data['date_created_producto']) || !strtotime($data['date_created_producto'])) {
            $errors[] = 'La fecha de creación del producto es obligatoria y debe ser una fecha válida.';
        }

        return $errors;
    }
}
