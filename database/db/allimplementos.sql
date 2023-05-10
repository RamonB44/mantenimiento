SELECT
CONCAT(mi.modelo_de_implemento,' ',i.numero) AS implementos
FROM reporte_de_tractors rt
INNER JOIN programacion_de_tractors pt ON pt.id = rt.programacion_de_tractor_id

INNER JOIN implemento_programacions ip ON ip.programacion_de_tractor_id = pt.id
INNER JOIN implementos i ON i.id = ip.implemento_id
INNER JOIN modelo_del_implementos mi ON mi.id = i.modelo_del_implemento_id GROUP BY mi.id,i.numero

