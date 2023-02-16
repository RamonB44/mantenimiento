DELIMITER //
CREATE TRIGGER `actualizar_precio_de_articulo` AFTER UPDATE ON `detalle_de_solicitud_de_pedidos`
 FOR EACH ROW IF new.cantidad_validada > 0 THEN
	UPDATE articulos SET precio_estimado = new.precio WHERE id = new.articulo_id;
END IF
//