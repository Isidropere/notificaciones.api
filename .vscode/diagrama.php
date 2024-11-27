
<?php
/*
Inicio
   |
   v
Estado: 'Solicitud' (Cliente A solicita intercambio)
   |
   v
Estado: 'Pendiente' (Esperando respuesta de Cliente B)
   |
   v
¿Cliente B acepta la solicitud?
   /                        \
  No                        Sí
  |                         |
  v                         v
Estado: 'Rechazada'     Estado: 'Aceptada'
   |                     |
   v                     v
  Fin        ¿Se requiere otro intercambio?
              /                 \
             No                 Sí
             |                  |
             v                  v
      Estado: 'Completada'   Estado: 'Mensaje'
                   |
                   v
          ¿Alerta requerida?
              / \
             No   Sí
             |     |
             v     v
            Fin    Estado: 'Alerta'
                       |
                       v
                      Fin  */