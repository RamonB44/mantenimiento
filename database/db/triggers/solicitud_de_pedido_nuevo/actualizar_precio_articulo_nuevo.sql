DELIMITER $$
CREATE TRIGGER `validar_ninguna_solicitud` AFTER UPDATE ON `solicitud_de_nuevo_articulos`
 FOR EACH ROW BEGIN
	IF NOT EXISTS (SELECT * FROM detalle_de_solicitud_de_pedidos WHERE solicitud_de_pedido_id = new.solicitud_de_pedido_id AND estado = 'PENDIENTE') AND NOT EXISTS (SELECT * FROM solicitud_de_nuevo_articulos WHERE solicitud_de_pedido_id = new.solicitud_de_pedido_id AND estado = 'PENDIENTE') THEN
        UPDATE solicitud_de_pedidos SET estado = 'VALIDADO' WHERE id = new.solicitud_de_pedido_id;
    END IF;
END $$