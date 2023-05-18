CREATE VIEW resumen_de_programacion_de_tractores AS
SELECT pt.sede_id,pt.fecha,f.id AS fundo_id,f.fundo,pt.labor_id,la.labor,COUNT(*) AS numero_de_maquinas,
pt.solicitante AS solicitante_id,u.name AS solicitante, IF(pt.turno='MAÑANA','DIA','NOCHE') AS turno
FROM programacion_de_tractors pt
INNER JOIN lotes l ON l.id = pt.lote_id
INNER JOIN fundos f ON f.id = l.fundo_id
INNER JOIN labors la ON la.id = pt.labor_id
INNER JOIN users u ON u.id = pt.solicitante
WHERE pt.tractor_id IS NOT NULL
GROUP BY pt.sede_id,pt.fecha,l.fundo_id,pt.labor_id,pt.solicitante,pt.turno;
