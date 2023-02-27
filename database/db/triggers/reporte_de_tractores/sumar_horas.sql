DELIMITER $$
CREATE TRIGGER aumentar_horas AFTER INSERT ON reporte_de_tractors FOR EACH ROW
BEGIN
	DECLARE implemento INT;
    DECLARE implemento_final INT DEFAULT 0;
    DECLARE tractor INT;
    DECLARE horas DECIMAL(8,2);
    DECLARE cursor_implementos CURSOR FOR SELECT implemento_id FROM implemento_programacions WHERE programacion_de_tractor_id = new.programacion_de_tractor_id;
    DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET implemento_final = 1;
    SELECT tractor_id INTO tractor FROM programacion_de_tractors WHERE id = new.programacion_de_tractor_id LIMIT 1;
    SET horas = new.horometro_final - new.horometro_inicial;
    IF tractor IS NOT NULL THEN
        UPDATE tractors SET horometro = new.horometro_final WHERE id = tractor;
    END IF;
    OPEN cursor_implementos;
        bucle_implementos:LOOP
            FETCH cursor_implementos INTO implemento;
            IF implemento_final = 1 THEN
        	    leave bucle_implementos;
            END IF;
            UPDATE implementos SET horas_de_uso = horas_de_uso + horas*(0.85) WHERE id = implemento;
        END LOOP bucle_implementos;
    CLOSE cursor_implementos;
END $$
