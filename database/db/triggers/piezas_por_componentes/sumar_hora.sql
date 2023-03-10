DELIMITER $$
CREATE TRIGGER `sumar_horas_piezas` AFTER INSERT ON `pieza_por_componentes` FOR EACH ROW
BEGIN
DECLARE cantidad_de_horas INT;
IF EXISTS(SELECT * FROM componentes_para_mantenimientos WHERE modelo_id = new.id AND modelo_type = 'App\\Models\\PiezaPorComponente' AND orden_de_trabajo_id IS NULL) THEN
    UPDATE componentes_para_mantenimientos SET horas_de_uso = horas_de_uso + new.horas WHERE modelo_id = new.id AND modelo_type = 'App\\Models\\PiezaPorComponente' AND orden_de_trabajo_id IS NULL;
ELSE
    INSERT INTO componentes_para_mantenimientos(modelo_id,modelo_type,horas_de_uso,created_at,updated_at) VALUES (new.id,'App\\Models\\PiezaPorComponente',new.horas,CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP());
END IF;
END $$
