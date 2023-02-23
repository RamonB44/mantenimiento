DELIMITER $$
CREATE TRIGGER aumentar_horas AFTER INSERT ON reporte_de_tractors FOR EACH ROW
BEGIN
	DECLARE implemento INT;
    DECLARE tractor INT;
    DECLARE horas DECIMAL(8,2);
    SELECT implemento_id,tractor_id INTO implemento,tractor FROM programacion_de_tractors WHERE id = new.programacion_de_tractor_id LIMIT 1;
    SET horas = new.horometro_final - new.horometro_inicial;
	UPDATE tractors SET horometro = new.horometro_final WHERE id = tractor;
    UPDATE implementos SET horas_de_uso = horas_de_uso + horas*(0.85) WHERE id = implemento;
END $$
