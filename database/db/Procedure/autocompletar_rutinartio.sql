DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `autocompletar_rutinario`(IN `programacion_id` INT, IN `responsable` INT)
BEGIN
DECLARE tarea INT;
DECLARE operario INT;
DECLARE tarea_final INT DEFAULT 0;
DECLARE cursor_tareas CURSOR FOR SELECT t.id FROM tareas t INNER JOIN componente_por_modelos cm ON cm.articulo_id = t.articulo_id INNER JOIN implementos i ON i.modelo_del_implemento_id = cm.modelo_id INNER JOIN programacion_de_tractors p ON p.implemento_id = i.id WHERE p.id = programacion_id;
DECLARE CONTINUE HANDLER FOR NOT FOUND SET tarea_final = 1;
OPEN cursor_tareas;
	bucle_tareas:LOOP
        FETCH cursor_tareas INTO tarea;
        IF NOT EXISTS (SELECT * FROM rutinarios WHERE programacion_de_tractor_id = programacion_id AND tarea_id = tarea) THEN
            SELECT responsable INTO operario FROM programacion_de_tractors WHERE id = programacion_id;
            INSERT INTO rutinarios (programacion_de_tractor_id,tarea_id,operario,validado_por,created_at,updated_at) VALUES (programacion_id,tarea,responsable,CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP());
        END IF;
		IF tarea_final = 1 THEN
        	leave bucle_tareas;
        END IF;
    END LOOP bucle_tareas;
CLOSE cursor_tareas;
END $$
