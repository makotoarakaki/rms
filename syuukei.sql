SELECT 
  `Supplier`.`id`, 
  `Supplier`.`business_day`, 
  `Supplier`.`main_item_id`, 
  `Supplier`.`main_item_name`, 
  `Supplier`.`item_id`, 
  `Supplier`.`item_name`, 
  sum(`Supplier`.`item_count`),
  sum(`Supplier`.`total`),
  `Profit`.`id`, 
  `Profit`.`business_day`, 
  `Profit`.`main_item_id`, 
  `Profit`.`main_item_name`, 
  `Profit`.`item_id`, 
  `Profit`.`item_name`, 
  sum(`Profit`.`item_count`),
  sum(`Profit`.`total`)
FROM `rms`.`supplier` AS `Supplier`, `rms`.`profit` AS `Profit` 
  WHERE (`Supplier`.`business_day` >= '2012-11-15 00:00:00' AND `Supplier`.`business_day` <= '2012-12-15 00:00:00')
  OR    (`Profit`.`business_day` >= '2012-11-15 00:00:00' AND `Profit`.`business_day` <= '2012-12-15 00:00:00')
  AND `Supplier`.`item_id` = `Profit`.`item_id`
GROUP BY `Supplier`.`item_count`, `Supplier`.`total`, `Profit`.`item_count`, `Profit`.`total`, `Supplier`.`item_id`
ORDER BY `Supplier`.`main_item_id`, `Supplier`.`item_id`, `Profit`.`main_item_id`, `Profit`.`item_id`
