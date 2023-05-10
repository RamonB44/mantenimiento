DELIMITER $$
CREATE TRIGGER `actualizar_horas_piezas` AFTER UPDATE ON `pieza_por_componentes` FOR EACH ROW
BEGIN
DECLARE cantidad_de_horas INT;
SET cantidad_de_horas = new.horas - old.horas;
IF EXISTS(SELECT * FROM componentes_para_mantenimientos WHERE modelo_id = new.id AND modelo_type = 'App\\Models\\PiezaPorComponente' AND orden_de_trabajo_id IS NULL) THEN
    UPDATE componentes_para_mantenimientos SET horas_de_uso = horas_de_uso + cantidad_de_horas WHERE modelo_id = new.id AND modelo_type = 'App\\Models\\PiezaPorComponente' AND orden_de_trabajo_id IS NULL;
ELSE
    INSERT INTO componentes_para_mantenimientos(modelo_id,modelo_type,horas_de_uso,created_at,updated_at) VALUES (new.id,'App\\Models\\PiezaPorComponente',cantidad_de_horas,CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP());
END IF;
END $$
