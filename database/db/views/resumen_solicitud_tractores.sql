CREATE VIEW resumen_de_solicitud_tractores AS
select `pt`.`sede_id` AS `sede_id`,`pt`.`fecha` AS `fecha`,`t`.`modelo_de_tractor_id` AS `modelo_de_tractor_id`,`mt`.`modelo_de_tractor` AS `modelo_de_tractor`,`pt`.`solicitante` AS `solicitante_id`,`u`.`name` AS `solicitante`, t.cultivo_id,
pt.supervisor
from ((((((`programacion_de_tractors` `pt`
           join `tractors` `t` on(`pt`.`tractor_id` = `t`.`id`))
          join cultivos cu on t.cultivo_id = cu.id
          join `modelo_de_tractors` `mt` on(`t`.`modelo_de_tractor_id` = `mt`.`id`))
         join `lotes` `l` on(`l`.`id` = `pt`.`lote_id`))
        join `fundos` `f` on(`f`.`id` = `l`.`fundo_id`))
       join `labors` `la` on(`la`.`id` = `pt`.`labor_id`))
      join `users` `u` on(`u`.`id` = `pt`.`solicitante`))
where `pt`.`tractor_id` is not null
group by `pt`.`sede_id`,`pt`.`fecha`,`pt`.`solicitante`,`pt`.`tractor_id`;
