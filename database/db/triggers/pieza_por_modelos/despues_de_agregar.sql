CREATE TRIGGER `agregar_piezas_por_modelo` AFTER INSERT ON `pieza_por_modelos` FOR EACH ROW
BEGIN
    DECLARE componente INT;
    DECLARE componente_final INT DEFAULT 0;
    DECLARE cursor_componentes CURSOR FOR SELECT id FROM componente_por_implementos WHERE articulo_id = new.articulo_id;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET componente_final = 1;
    IF EXISTS (SELECT * FROM componente_por_implementos WHERE articulo_id = new.articulo_id) THEN
        OPEN cursor_componentes;
            bucle_componentes:LOOP
                IF componente_final = 1 THEN
                    leave bucle_componentes;
                END IF;
                    FETCH cursor_componentes INTO componente;
                    IF NOT EXISTS (SELECT * FROM pieza_por_componentes WHERE pieza = new.pieza AND componente_por_implemento_id = componente) THEN
                        INSERT INTO pieza_por_componentes (pieza,componente_por_implemento_id) VALUES (new.pieza,componente);
                    END IF;
            END LOOP bucle_componentes;
        CLOSE cursor_componentes;
    END IF;
END
