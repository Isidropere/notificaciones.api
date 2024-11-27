<?php
namespace Src\Services;

use PDO;
use PDOException;
class NotificacionesService
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function CreateTtransaccion( $idProducto , $idClienteEmisor, $idClienteReceptor, $estado, $FechaCreacion, $FechaActualizacion)
    {
        try {


            $query = "INSERT INTO  Transacciones
            (   id_producto_Transacciones,
                id_cliente_Emisor,
                id_cliente_Receptor,
                Estado_Transacciones,
                FechaCreacion_Transacciones,
                FechaActualizacion_Transacciones
               ) 
            VALUES 
            (
              :id_producto_Transacciones,
                :id_cliente_Emisor,
                :id_cliente_Receptor,
                :Estado_Transacciones,
                :FechaCreacion_Transacciones,
                :FechaActualizacion_Transacciones
              )";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(":id_producto_Transacciones",  $idProducto,  PDO::PARAM_INT);
                $stmt->bindParam(":id_cliente_Emisor",  $idClienteEmisor);
                $stmt->bindParam(":id_cliente_Receptor",  $idClienteReceptor);
                $stmt->bindParam(":Estado_Transacciones",  $estado);
                $stmt->bindParam(":FechaCreacion_Transacciones",  $FechaCreacion);
                $stmt->bindParam(":FechaActualizacion_Transacciones",  $FechaActualizacion);
                return $stmt->execute();


        } catch (PDOException $e) {
            throw new \Exception("Error al verificar la suscripción: " . $e->getMessage());
        }
    }
/*
    public function UpdateTransaccion($idTransaccion, $idProducto = null, $idClienteEmisor = null, $idClienteReceptor = null, $estado = null, $FechaActualizacion = null)
            {
            try {
                // Inicia la consulta base
                $query = "UPDATE Transacciones SET ";
                $params = [];
                $fields = [];

                // Agrega dinámicamente los campos que se deben actualizar
                if ($idProducto !== null) {
                    $fields[] = "id_producto_Transacciones = :id_producto_Transacciones";
                    $params[":id_producto_Transacciones"] = $idProducto;
                }

                if ($idClienteEmisor !== null) {
                    $fields[] = "id_cliente_Emisor = :id_cliente_Emisor";
                    $params[":id_cliente_Emisor"] = $idClienteEmisor;
                }

                if ($idClienteReceptor !== null) {
                    $fields[] = "id_cliente_Receptor = :id_cliente_Receptor";
                    $params[":id_cliente_Receptor"] = $idClienteReceptor;
                }

                if ($estado !== null) {
                    $fields[] = "Estado_Transacciones = :Estado_Transacciones";
                    $params[":Estado_Transacciones"] = $estado;
                }

                if ($FechaActualizacion !== null) {
                    $fields[] = "FechaActualizacion_Transacciones = :FechaActualizacion_Transacciones";
                    $params[":FechaActualizacion_Transacciones"] = $FechaActualizacion;
                }

                // Si no hay campos para actualizar, regresa sin ejecutar
                if (empty($fields)) {
                    throw new \Exception("No hay campos para actualizar.");
                }

                // Une los campos dinámicos en la consulta
                $query .= implode(", ", $fields);
                $query .= " WHERE id_Transacciones = :id_Transacciones";

                // Agrega el parámetro obligatorio de la condición WHERE
                $params[":id_Transacciones"] = $idTransaccion;

                // Prepara y ejecuta la consulta
                $stmt = $this->conn->prepare($query);
                foreach ($params as $key => $value) {
                    $stmt->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
                }

                return $stmt->execute();
            } catch (PDOException $e) {
                throw new \Exception("Error al actualizar la transacción: " . $e->getMessage());
            }
        }*/



}