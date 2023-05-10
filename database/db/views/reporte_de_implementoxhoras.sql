CREATE VIEW vista_reporte_de_implementosxhoras AS
select `pt`.`sede_id` AS `sede_id`,`s`.`sede` AS `sede`,
`pt`.`fecha` AS `fecha`,sum(`rt`.`horometro_final` - `rt`.`horometro_inicial`) AS `Horas_Usado`,
`mi`.`id` AS `modelo_implemento_id`,`pt`.`supervisor` AS `supervisor`,
group_concat(`mi`.`modelo_de_implemento`,' N°',`i`.`numero`,' Horas: ', (`rt`.`horometro_final` - `rt`.`horometro_inicial`) SEPARATOR ',') AS `implementos`
from `reporte_de_tractors` `rt`
join `programacion_de_tractors` `pt` on `pt`.`id` = `rt`.`programacion_de_tractor_id`
join `sedes` `s` on `s`.`id` = `pt`.`sede_id`
join `lotes` `l` on `l`.`id` = `pt`.`lote_id`
join `fundos` `f` on `f`.`id` = `l`.`fundo_id`
join `users` `u` on `u`.`id` = `pt`.`tractorista`
left join `tractors` `t` on `t`.`id` = `pt`.`tractor_id`
left join `modelo_de_tractors` `mt` on `mt`.`id` = `t`.`modelo_de_tractor_id`
join `implemento_programacions` `ip` on `ip`.`programacion_de_tractor_id` = `pt`.`id`
join `implementos` `i` on `i`.`id` = `ip`.`implemento_id`
join `modelo_del_implementos` `mi` on `mi`.`id` = `i`.`modelo_del_implemento_id`
group by `mi`.`id`,`pt`.`fecha`
order by `pt`.`fecha` desc;
