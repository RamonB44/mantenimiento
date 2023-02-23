CREATE VIEW cantidad_de_tareas_por_sistema AS
SELECT COUNT(t.id) AS cantidad_de_tareas,c.sistema_id,m.id AS modelo_de_implemento FROM componente_por_modelos c INNER JOIN tareas t ON t.articulo_id = c.articulo_id INNER JOIN modelo_del_implementos m ON m.id = c.modelo_id GROUP BY c.sistema_id,c.modelo_id
