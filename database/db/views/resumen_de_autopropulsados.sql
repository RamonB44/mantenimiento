CREATE VIEW resumen_de_programacion_de_autopropulsados AS
SELECT DISTINCT pt.sede_id,pt.fecha,f.id AS fundo_id,f.fundo,pt.labor_id,la.labor, CONCAT(mi.modelo_de_implemento,' ',i.numero) AS numero_de_maquinas,pt.solicitante AS solicitante_id,u.name AS solicitante, IF(pt.turno='MAÑANA','DIA','NOCHE') AS turno FROM implemento_programacions ip INNER JOIN programacion_de_tractors pt ON pt.id = ip.programacion_de_tractor_id INNER JOIN implementos i ON i.id = ip.implemento_id INNER JOIN modelo_del_implementos mi ON mi.id = i.modelo_del_implemento_id INNER JOIN implemento_programacions INNER JOIN lotes l ON l.id = pt.lote_id INNER JOIN fundos f ON f.id = l.fundo_id INNER JOIN labors la ON la.id = pt.labor_id INNER JOIN users u ON u.id = pt.solicitante WHERE pt.tractor_id IS NULL;
