<?php
namespace Src\Models;

use PDO;
use PDOException;
use Src\Services\SuscripcionesService;
class Notificaciones
{
    private $conn;
    private $table = 'notificaciones';

    // Propiedades de notificaciones
      public $id_notificaciones;
      public $id_cliente_notificaciones ;
      public $id_producto_notificaciones;
      public $TipoNotificacion ;
      public $Contenido ;
      public $FechaCreacion ;
      public $Leido ;
      
    public function __construct($conn) {
        $this->conn = $conn;
    }

     // Obtener todos los notificaciones
     public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un notificaciones por ID
    public function getById($idCliente) {
        $query = "SELECT * FROM " . $this->table . " WHERE id_cliente_notificaciones = :idCliente and Leido =0 ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idCliente", $idCliente);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo notificaciones
    public function create($data) {
        $query = "INSERT INTO " . $this->table . " 
                  ( id_cliente_notificaciones, 
                    id_producto_notificaciones,
                    TipoNotificacion, 
                    Contenido,
                    FechaCreacion,
                    fecha_actualizacion_notificacion,
                    Leido ) 
                  VALUES 
                  (:id_cliente_notificaciones, 
                    :id_producto_notificaciones,
                    :TipoNotificacion, 
                    :Contenido,
                    :FechaCreacion,
                     now(),
                    :Leido )";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id_cliente_notificaciones", $data['id_cliente_notificaciones']);
        $stmt->bindParam(":id_producto_notificaciones", $data['id_producto_notificaciones']);
        $stmt->bindParam(":TipoNotificacion", $data['TipoNotificacion']);
        $stmt->bindParam(":Contenido", $data['Contenido']);
        $stmt->bindParam(":FechaCreacion", $data['FechaCreacion']);
        $stmt->bindParam(":Leido", $data['Leido']);
        
        return $stmt->execute();
    }

     // Actualizar un cliente por ID
     public function updateOne($id, $data) {
        $query = "UPDATE " . $this->table . " 
                  SET
                  FechaCreacion =now(),
                  fecha_actualizacion_notificacion =now(),
                  Leido = :Leido
                  WHERE id_notificaciones = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":Leido", $data['Leido']);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
    // Actualizar un cliente por ID
    public function update($id, $data) {
        $query = "UPDATE " . $this->table . " 
                  SET
                  id_cliente_notificaciones = :id_cliente_notificaciones, 
                  id_producto_notificaciones = :id_producto_notificaciones,
                  TipoNotificacion = :TipoNotificacion, 
                  Contenido = :Contenido,
                  FechaCreacion = :FechaCreacion, 
                   fecha_actualizacion_notificacion =now()
                  Leido = :Leido
                  WHERE id_notificaciones = :id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":id_cliente_notificaciones", $data['id_cliente_notificaciones']);
        $stmt->bindParam(":id_producto_notificaciones", $data['id_producto_notificaciones']);
        $stmt->bindParam(":TipoNotificacion", $data['TipoNotificacion']); /*'Solicitud','Pendiente','Aceptada','Rechazada','Completada','Alerta','Mensaje'*/ 
        $stmt->bindParam(":Contenido", $data['Contenido']);
        $stmt->bindParam(":FechaCreacion", $data['FechaCreacion']);
        $stmt->bindParam(":Leido", $data['Leido']);
        $stmt->bindParam(":id", $id);
        
        return $stmt->execute();
    }


     // Eliminar un notificaciones por ID
     public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id_notificaciones = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        
        return $stmt->execute();
    }
}
