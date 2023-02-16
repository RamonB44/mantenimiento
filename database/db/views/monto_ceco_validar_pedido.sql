CREATE VIEW montos_usado_validar_pedido AS
SELECT fecha_de_pedido,centro_de_costo_id,SUM(precio*cantidad_validada) AS total FROM `lista_de_detalle_de_pedido` GROUP BY fecha_de_pedido,centro_de_costo_id
