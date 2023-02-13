CREATE VIEW detalle_monto_cecos_por_meses AS
SELECT centro_de_costo_id, monto,MONTH(fecha_de_asignacion) AS mes FROM `detalle_monto_cecos`