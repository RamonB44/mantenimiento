DELIMITER //
CREATE TRIGGER `aumentar_monto_ceco` AFTER UPDATE ON `detalle_monto_cecos` FOR EACH ROW 
IF(old.esta_asignado = false AND new.esta_asignado = true) THEN
    UPDATE centro_de_costos SET monto = monto + old.monto WHERE id = old.centro_de_costo_id;
END IF
//