DELIMITER $$
CREATE TRIGGER `poner_precio_de_articulo` AFTER INSERT ON `detalle_de_solicitud_de_pedidos` FOR EACH ROW
BEGIN
DECLARE operario INT DEFAULT 0;
DECLARE sede INT DEFAULT 0;
    IF new.estado = 'VALIDADO' THEN
        SELECT solicitante,sede_id INTO operario,sede FROM solicitud_de_pedidos WHERE id = new.solicitud_de_pedido_id LIMIT 1;
    	INSERT INTO stock_operarios (user_id,articulo_id,cantidad,sede_id,created_at,updated_at) VALUES (operario,new.articulo_id,new.cantidad_validada,sede,CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP());
    END IF;
    IF NOT EXISTS (SELECT * FROM detalle_de_solicitud_de_pedidos WHERE solicitud_de_pedido_id = new.solicitud_de_pedido_id AND estado = 'PENDIENTE') AND NOT EXISTS (SELECT * FROM solicitud_de_nuevo_articulos WHERE solicitud_de_pedido_id = new.solicitud_de_pedido_id AND estado = 'PENDIENTE') THEN
        UPDATE solicitud_de_pedidos SET estado = 'VALIDADO' WHERE id = new.solicitud_de_pedido_id;
    END IF;
END $$
