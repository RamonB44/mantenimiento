CREATE VIEW vista_reporte_de_tractores AS
SELECT pt.sede_id,s.sede,pt.fecha,pt.turno,f.fundo,l.lote,rt.correlativo, u.codigo AS codigo_tractorista, u.name AS tractorista, CASE WHEN pt.tractor_id IS NULL THEN 'AUTOPROPULSADO' ELSE CONCAT(mt.modelo_de_tractor,' ',t.numero) END AS tractor, rt.horometro_inicial, rt.horometro_final, la.labor, GROUP_CONCAT(mi.modelo_de_implemento,' ',i.numero) AS implementos FROM reporte_de_tractors rt INNER JOIN programacion_de_tractors pt ON pt.id = rt.programacion_de_tractor_id INNER JOIN sedes s ON s.id = pt.sede_id INNER JOIN lotes l ON l.id = pt.lote_id INNER JOIN fundos f ON f.id = l.fundo_id INNER JOIN users u ON u.id = pt.tractorista LEFT JOIN tractors t ON t.id = pt.tractor_id LEFT JOIN modelo_de_tractors mt ON mt.id = t.modelo_de_tractor_id INNER JOIN labors la ON la.id = pt.labor_id INNER JOIN implemento_programacions ip ON ip.programacion_de_tractor_id = pt.id INNER JOIN implementos i ON i.id = ip.implemento_id INNER JOIN modelo_del_implementos mi ON mi.id = i.modelo_del_implemento_id GROUP BY rt.id;
