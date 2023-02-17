CREATE VIEW resumen_pedido_por_ceco AS
SELECT centro_de_costo_id,fecha_de_pedido,codigo,articulo,tipo,unidad_de_medida,abreviacion,SUM(cantidad_validada) AS cantidad_total,precio FROM `lista_de_detalle_de_pedido` WHERE cantidad_validada > 0 GROUP BY fecha_de_pedido,sede_id,codigo,centro_de_costo_id
