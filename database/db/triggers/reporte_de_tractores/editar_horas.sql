DELIMITER //
CREATE TRIGGER editar_horas AFTER UPDATE ON reporte_de_tractors FOR EACH ROW
BEGIN
	DECLARE implemento INT;
    DECLARE tractor INT;
    DECLARE horas DECIMAL(8,2);
    SELECT implemento_id,tractor_id INTO implemento,tractor FROM programacion_de_tractors WHERE id = new.programacion_de_tractor_id LIMIT 1;
    SET horas = new.horometro_final - old.horometro_final;
	UPDATE tractors SET horometro = horometro + horas WHERE id = tractor;
    UPDATE implementos SET horas_de_uso = horas_de_uso + horas*(0.85) WHERE id = implemento;
END //
