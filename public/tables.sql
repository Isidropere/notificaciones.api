

CREATE TABLE Transacciones (
    transaccionID INT AUTO_INCREMENT PRIMARY KEY,
    id_producto_Transacciones INT NOT NULL, -- Producto objeto del intercambio
    id_cliente_Emisor INT NOT NULL, -- Usuario que inicia la transacción
    id_cliente_Receptor INT NOT NULL, -- Usuario que recibe la solicitud de intercambio
    Estado ENUM('Pendiente', 'Aceptada', 'Rechazada', 'Completada') DEFAULT 'Pendiente',
    FechaCreacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    FechaActualizacion DATETIME ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_producto_Transacciones) REFERENCES productos(id_producto),
    FOREIGN KEY (id_cliente_Emisor) REFERENCES clientes(id_cliente),
    FOREIGN KEY (id_cliente_Receptor) REFERENCES clientes(id_cliente)
);

CREATE TABLE notificaciones (
    id_notificaciones INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente_notificaciones INT(11) NOT NULL, -- cliente que recibe la notificación
    id_producto_notificaciones INT(11) NOT NULL,
    TipoNotificacion ENUM('Solicitud', 'Aceptada', 'Rechazada', 'Mensaje', 'Alerta') NOT NULL,
    Contenido TEXT NOT NULL, -- Detalle de la notificación
    FechaCreacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    Leido TINYINT(1) DEFAULT 0, -- 0 = No leído, 1 = Leído
    FOREIGN KEY (id_cliente_notificaciones) REFERENCES clientes(id_cliente),
    FOREIGN KEY (id_producto_notificaciones) REFERENCES tb_productos(id_producto)
);



CREATE TABLE `notificaciones` (
  `id_notificaciones` INT AUTO_INCREMENT PRIMARY KEY,
  `id_cliente_notificaciones` int(11) NOT NULL,
  `id_producto_notificaciones` int(11) NOT NULL,
  `mensaje_Notificaciones` text NOT NULL,
  `es_leido` tinyint(1) DEFAULT 0,
  `fecha_notificacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
