DELIMITER $$
CREATE TRIGGER `agregar_piezas_por_modelo` AFTER INSERT ON `componente_por_implementos` FOR EACH ROW
BEGIN
    DECLARE pieza_id INT;
    DECLARE modelo_del_componente INT;
    DECLARE pieza_final INT DEFAULT 0;
    DECLARE tiempo_de_vida_pieza DOUBLE;
    DECLARE cursor_piezas CURSOR FOR SELECT pieza FROM pieza_por_modelos WHERE articulo_id = new.articulo_id;
    DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET pieza_final = 1;
    -- actualizar new.estado a PARA CAMBIO CUANDO SE SOBREPASE LAS HORAS ESTABLECIDAS
    IF EXISTS(SELECT * FROM componentes_para_mantenimientos WHERE modelo_id = new.id AND modelo_type = 'App\\Models\\ComponentePorImplemento' AND orden_de_trabajo_id IS NULL) THEN
        UPDATE componentes_para_mantenimientos SET horas_de_uso = horas_de_uso + new.horas WHERE modelo_id = new.id AND modelo_type = 'App\\Models\\ComponentePorImplemento' AND orden_de_trabajo_id IS NULL;
    ELSE
        INSERT INTO componentes_para_mantenimientos(modelo_id,modelo_type,horas_de_uso,created_at,updated_at) VALUES (new.id,'App\\Models\\ComponentePorImplemento', new.horas, CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP());
    END IF;
    OPEN cursor_piezas;
        bucle_piezas:LOOP
            FETCH cursor_piezas INTO pieza_id;
            SELECT fm.tiempo_de_vida into tiempo_de_vida_pieza FROM frecuencia_mantenimientos fm WHERE fm.articulo_id = pieza_id;
            IF pieza_final = 1 THEN
                leave bucle_piezas;
            END IF;
            IF EXISTS(SELECT * FROM pieza_por_componentes WHERE pieza = pieza_id AND componente_por_implemento_id = new.id AND estado <> "CAMBIADO") THEN
                UPDATE pieza_por_componentes
                SET horas = horas + new.horas,
                estado = (CASE WHEN (horas + cantidad_de_horas >= tiempo_de_vida_pieza) THEN 2 ELSE 1 END) -- AÑADE EL ESTADO DE PARA CAMBIO A LA PIEZA
                WHERE pieza = pieza_id AND componente_por_implemento_id = new.id AND estado <> 'CAMBIADO';
            ELSE
                INSERT INTO pieza_por_componentes (pieza,componente_por_implemento_id,horas,created_at,updated_at) VALUES (pieza_id,new.id,new.horas, CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP());
            END IF;
        END LOOP bucle_piezas;
    CLOSE cursor_piezas;
END $$
