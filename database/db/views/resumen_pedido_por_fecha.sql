CREATE VIEW resumen_pedido_por_fecha AS
SELECT sp.sede_id,sp.fecha_de_pedido_id,dsp.articulo_id,a.codigo,a.articulo,a.tiempo_de_vida,um.abreviacion as unidad_de_medida,SUM(dsp.cantidad_validada) AS cantidad, dsp.precio AS precio,(SUM(dsp.cantidad_validada)*dsp.precio) AS total FROM detalle_de_solicitud_de_pedidos dsp INNER JOIN solicitud_de_pedidos sp ON sp.id = dsp.solicitud_de_pedido_id INNER JOIN articulos a ON a.id = dsp.articulo_id INNER JOIN unidad_de_medidas um ON um.id = a.unidad_de_medida_id WHERE dsp.estado = 'VALIDADO' GROUP BY dsp.articulo_id,sp.fecha_de_pedido_id,sp.sede_id