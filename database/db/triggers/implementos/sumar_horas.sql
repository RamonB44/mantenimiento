DELIMITER $$
CREATE TRIGGER `agregar_componentes_por_modelo` AFTER UPDATE ON `implementos` FOR EACH ROW
BEGIN
    DECLARE componente INT;
    DECLARE modelo_del_implemento INT;
    DECLARE componente_final INT DEFAULT 0;
    DECLARE cantidad_de_horas DECIMAL(8,2);
    DECLARE tiempo_de_vida_componente DECIMAL(8,2);
    DECLARE frecuencia_componente DECIMAL(8,2);
    DECLARE cursor_componentes CURSOR FOR SELECT articulo_id FROM componente_por_modelos cm INNER JOIN implementos i ON i.modelo_del_implemento_id = cm.modelo_id WHERE i.id = new.id;
    DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET componente_final = 1;
    IF new.horas_de_uso <> old.horas_de_uso THEN
    SET cantidad_de_horas = new.horas_de_uso - old.horas_de_uso;
    OPEN cursor_componentes;
        bucle_componentes:LOOP
            FETCH cursor_componentes INTO componente;
            SELECT fm.tiempo_de_vida,fm.frecuencia into tiempo_de_vida_componente,frecuencia_componente FROM frecuencia_mantenimientos fm WHERE fm.articulo_id = componente;
            IF componente_final = 1 THEN
                leave bucle_componentes;
            END IF;
            IF NOT EXISTS(SELECT * FROM componente_por_implementos WHERE articulo_id = componente AND implemento_id = new.id AND estado <> "CAMBIADO") THEN
                INSERT INTO componente_por_implementos (articulo_id,implemento_id,horas,created_at,updated_at) VALUES (componente,new.id,cantidad_de_horas,CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP());
            ELSE
                UPDATE componente_por_implementos
                SET horas = horas + cantidad_de_horas, updated_at = CURRENT_TIMESTAMP(),
                estado = (CASE WHEN (horas + cantidad_de_horas) >= tiempo_de_vida_componente or (horas + cantidad_de_horas) >= frecuencia_componente THEN 2 ELSE 1 END) -- AÑADE EL ESTADO DE PARA CAMBIO A LA PIEZA
                WHERE articulo_id = componente
                AND implemento_id = new.id
                AND estado <> "CAMBIADO";
            END IF;
        END LOOP bucle_componentes;
    CLOSE cursor_componentes;
    END IF;
END $$
