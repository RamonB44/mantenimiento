CREATE TRIGGER `agregar_componentes_por_modelo` AFTER INSERT ON `componente_por_modelos` FOR EACH ROW
BEGIN
    DECLARE implemento INT;
    DECLARE implemento_final INT DEFAULT 0;
    DECLARE cursor_implementos CURSOR FOR SELECT id FROM implementos WHERE modelo_del_implemento_id = new.modelo_id;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET implemento_final = 1;
    IF EXISTS (SELECT * FROM implementos WHERE modelo_del_implemento_id = new.modelo_id) THEN
        OPEN cursor_implementos;
            bucle_implementos:LOOP
                IF implemento_final = 1 THEN
                    leave bucle_implementos;
                END IF;
                    FETCH cursor_implementos INTO implemento;
                    IF NOT EXISTS(SELECT * FROM componente_por_implementos WHERE articulo_id = new.articulo_id AND  implemento_id = implemento) THEN
                        INSERT INTO componente_por_implementos (articulo_id,implemento_id,created_at,updated_at) VALUES (new.articulo_id,implemento,CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP());
                    END IF;
            END LOOP bucle_implementos;
        CLOSE cursor_implementos;
    END IF;
END
