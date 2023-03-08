DELIMITER $$
CREATE TRIGGER editar_horas AFTER UPDATE ON reporte_de_tractors FOR EACH ROW
BEGIN
	DECLARE implemento INT;
    DECLARE implemento_final INT DEFAULT 0;
    DECLARE tractor INT;
    DECLARE horas DECIMAL(8,2);
    DECLARE cursor_implementos CURSOR FOR SELECT implemento_id FROM implemento_programacions WHERE programacion_de_tractor_id = new.programacion_de_tractor_id;
    DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET implemento_final = 1;
    SELECT tractor_id INTO tractor FROM programacion_de_tractors WHERE id = new.programacion_de_tractor_id LIMIT 1;
    IF tractor IS NOT NULL THEN
        UPDATE tractors SET horometro = new.horometro_inicial WHERE id = tractor;
        SET horas = 0;
    ELSE
        SET horas = new.horometro_final - old.horometro_final;
    END IF;
END $$
