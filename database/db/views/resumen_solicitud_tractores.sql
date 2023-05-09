CREATE VIEW resumen_de_solicitud_tractoresv2 AS
select `pt`.`sede_id` AS `sede_id`,`pt`.`fecha` AS `fecha`,`t`.`modelo_de_tractor_id` AS `modelo_de_tractor_id`,`mt`.`modelo_de_tractor` AS `modelo_de_tractor`,`pt`.`solicitante` AS `solicitante_id`,`u`.`name` AS `solicitante`
from ((((((`db_mante`.`programacion_de_tractors` `pt` join `db_mante`.`tractors` `t` on(`pt`.`tractor_id` = `t`.`id`)) join `db_mante`.`modelo_de_tractors` `mt` on(`t`.`modelo_de_tractor_id` = `mt`.`id`)) join `db_mante`.`lotes` `l` on(`l`.`id` = `pt`.`lote_id`)) join `db_mante`.`fundos` `f` on(`f`.`id` = `l`.`fundo_id`)) join `db_mante`.`labors` `la` on(`la`.`id` = `pt`.`labor_id`)) join `db_mante`.`users` `u` on(`u`.`id` = `pt`.`solicitante`))
where `pt`.`tractor_id` is not null
group by `pt`.`sede_id`,`pt`.`fecha`,`pt`.`solicitante`,`pt`.`tractor_id`
