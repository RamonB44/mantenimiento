DELIMITER $$
CREATE TRIGGER `actualizar_precio_de_articulo` AFTER UPDATE ON `detalle_de_solicitud_de_pedidos` FOR EACH ROW 
BEGIN
    IF new.cantidad_validada > 0 THEN
        UPDATE articulos SET precio_estimado = new.precio WHERE id = new.articulo_id;
    END IF;
    IF NOT EXISTS (SELECT * FROM detalle_de_solicitud_de_pedidos WHERE solicitud_de_pedido_id = new.solicitud_de_pedido_id AND estado = 'PENDIENTE') AND NOT EXISTS (SELECT * FROM solicitud_de_nuevo_articulos WHERE solicitud_de_pedido_id = new.solicitud_de_pedido_id AND estado = 'PENDIENTE') THEN
        UPDATE solicitud_de_pedidos SET estado = 'VALIDADO' WHERE id = new.solicitud_de_pedido_id;
    END IF;
END $$
