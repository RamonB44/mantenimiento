CREATE TRIGGER `agregar_rutinarios` AFTER INSERT ON `programacion_de_tractors` FOR EACH ROW
BEGIN
    DECLARE tarea INT;
    DECLARE tarea_final INT DEFAULT 0;
    DECLARE cursor_tareas CURSOR FOR SELECT t.id FROM tareas t INNER JOIN componente_por_implementos i ON i.articulo_id = t.articulo_id WHERE i.implemento_id = new.implemento_id;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET tarea_final = 1;
    IF EXISTS (SELECT * FROM tareas t INNER JOIN componente_por_implementos i ON i.articulo_id = t.articulo_id WHERE i.implemento_id = new.implemento_id) THEN
        OPEN cursor_tareas;
            bucle_tareas:LOOP
                IF tarea_final = 1 THEN
                    leave bucle_tareas;
                END IF;
                    FETCH cursor_tareas INTO tarea;
                    IF NOT EXISTS (SELECT * FROM rutinarios WHERE programacion_de_tractor_id = new.id AND tarea_id = tarea) THEN
                        INSERT INTO rutinarios (programacion_de_tractor_id,tarea_id,created_at,updated_at) VALUES (new.id,tarea,CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP());
                    END IF;
            END LOOP bucle_tareas;
        CLOSE cursor_tareas;
    END IF;
END
