CREATE VIEW resumen_de_programacion AS
SELECT * FROM resumen_de_programacion_de_tractores
UNION SELECT * FROM resumen_de_programacion_de_autopropulsados
