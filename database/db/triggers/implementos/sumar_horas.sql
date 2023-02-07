DELIMITER //
CREATE TRIGGER `agregar_componentes_por_modelo` AFTER UPDATE ON `implementos` FOR EACH ROW
BEGIN
    DECLARE componente INT;
    DECLARE modelo_del_implemento INT;
    DECLARE componente_final INT DEFAULT 0;
    DECLARE cantidad_de_horas DECIMAL(8,2);
    DECLARE cursor_componentes CURSOR FOR SELECT articulo_id FROM componente_por_modelos WHERE modelo_id = modelo_del_implemento;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET componente_final = 1;
    SET cantidad_de_horas = new.horas_de_uso - old.horas_de_uso;
    SELECT modelo_del_implemento_id INTO modelo_del_implemento FROM `implementos` WHERE id = new.id;
    OPEN cursor_componentes;
        bucle_componentes:LOOP
            IF componente_final = 1 THEN
                leave bucle_componentes;
            END IF;
                FETCH cursor_componentes INTO componente;
                IF NOT EXISTS(SELECT * FROM componente_por_implementos WHERE articulo_id = componente AND implemento_id = new.id AND estado <> "CAMBIADO") THEN
                    INSERT INTO componente_por_implementos (articulo_id,implemento_id,horas,created_at,updated_at) VALUES (componente,new.id,cantidad_de_horas,CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP());
                ELSE
                    UPDATE componente_por_implementos SET horas = horas + cantidad_de_horas, updated_at = CURRENT_TIMESTAMP() WHERE articulo_id = componente AND implemento_id = new.id AND estado <> "CAMBIADO";
                END IF;
        END LOOP bucle_componentes;
    CLOSE cursor_componentes;
END //
