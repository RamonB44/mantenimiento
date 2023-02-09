DELIMITER //
CREATE TRIGGER `editar_piezas_por_modelo` AFTER UPDATE ON `componente_por_implementos` FOR EACH ROW
BEGIN
    DECLARE pieza_id INT;
    DECLARE modelo_del_componente INT;
    DECLARE pieza_final INT DEFAULT 0;
    DECLARE cantidad_de_horas DECIMAL(8,2);
    DECLARE cursor_piezas CURSOR FOR SELECT pieza FROM pieza_por_modelos WHERE articulo_id = new.articulo_id;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET pieza_final = 1;
    SET cantidad_de_horas = new.horas - old.horas;
    OPEN cursor_piezas;
        bucle_piezas:LOOP
            IF pieza_final = 1 THEN
                leave bucle_piezas;
            END IF;
                FETCH cursor_piezas INTO pieza_id;
                IF pieza_id is not null THEN
                    IF NOT EXISTS(SELECT * FROM pieza_por_componentes WHERE pieza = pieza_id AND componente_por_implemento_id = new.id AND estado <> "CAMBIADO") THEN
                        INSERT INTO pieza_por_componentes (pieza,componente_por_implemento_id,horas,created_at,updated_at) VALUES (pieza_id,new.id,cantidad_de_horas,CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP());
                    ELSE
                        UPDATE pieza_por_componentes SET horas = horas + cantidad_de_horas, updated_at = CURRENT_TIMESTAMP() WHERE pieza = pieza_id AND componente_por_implemento_id = new.id AND estado <> "CAMBIADO";
                    END IF;
                END IF;
        END LOOP bucle_piezas;
    CLOSE cursor_piezas;
END //
