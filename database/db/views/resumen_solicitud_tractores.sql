CREATE VIEW resumen_de_solicitud_tractores AS
SELECT pt.sede_id,pt.fecha,
t.modelo_de_tractor_id,mt.modelo_de_tractor,pt.solicitante AS solicitante_id,
u.name AS solicitante
FROM programacion_de_tractors pt
INNER JOIN tractors t ON pt.tractor_id = t.id
INNER JOIN modelo_de_tractors mt ON t.modelo_de_tractor_id = mt.id
INNER JOIN lotes l ON l.id = pt.lote_id
INNER JOIN fundos f ON f.id = l.fundo_id
INNER JOIN labors la ON la.id = pt.labor_id
INNER JOIN users u ON u.id = pt.solicitante
WHERE pt.tractor_id IS NOT NULL
GROUP BY pt.sede_id,pt.fecha,pt.solicitante,pt.tractor_id;
