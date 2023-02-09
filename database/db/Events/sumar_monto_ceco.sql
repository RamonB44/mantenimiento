CREATE EVENT `asignar_monto_ceco` ON SCHEDULE EVERY 1 MONTH STARTS '2022-06-01 00:00:00' ON COMPLETION NOT PRESERVE DISABLE DO
UPDATE detalle_monto_cecos SET esta_asignado = true WHERE fecha_de_asignacion <= CURDATE() AND esta_asignado = false
