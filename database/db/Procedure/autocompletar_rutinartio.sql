DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `autocompletar_rutinario`(IN `rutinario` INT)
BEGIN
DECLARE tarea INT;
DECLARE tarea_final INT DEFAULT 0;
DECLARE cursor_tareas CURSOR FOR SELECT t.id FROM tareas t INNER JOIN componente_por_modelos cm ON cm.articulo_id = t.articulo_id INNER JOIN implementos i ON i.modelo_del_implemento_id = cm.modelo_id INNER JOIN implemento_programacions p ON p.implemento_id = i.id WHERE p.id = rutinario;
DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET tarea_final = 1;
OPEN cursor_tareas;
	bucle_tareas:LOOP
        FETCH cursor_tareas INTO tarea;
		IF tarea_final = 1 THEN
        	leave bucle_tareas;
        END IF;
        IF NOT EXISTS (SELECT * FROM rutinarios WHERE implemento_programacion_id = rutinario AND tarea_id = tarea) THEN
            INSERT INTO rutinarios (implemento_programacion_id,tarea_id,created_at,updated_at) VALUES (rutinario,tarea,CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP());
        END IF;
    END LOOP bucle_tareas;
CLOSE cursor_tareas;
END $$
