CREATE EVENT `abrir_o_cerrar_pedido` ON SCHEDULE EVERY 1 DAY STARTS '2023-02-09 07:30:00' ON COMPLETION NOT PRESERVE ENABLE DO
BEGIN
    UPDATE fecha_de_pedidos SET estado = "ABIERTO" WHERE fecha_de_apertura <= CURDATE() AND estado = "PENDIENTE" LIMIT 1;
    UPDATE fecha_de_pedidos SET estado = "CERRADO" WHERE fecha_de_cierre <= CURDATE() AND estado = "ABIERTO" LIMIT 1;
END
