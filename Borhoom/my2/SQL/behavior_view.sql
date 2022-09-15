-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

--
-- Set default database
--
USE childcare2;

--
-- Create view `behavior_view`
--
CREATE 
	DEFINER = 'root'@'localhost'
VIEW behavior_view
AS
SELECT
  `manylist`.`ID` AS `ID`,
  `manylist`.`Code2` AS `Code2`,
  `manylist`.`Title` AS `Title`,
  `manylist`.`List_type_id` AS `List_type_id`,
  `manylist`.`Parent_id` AS `Parent_id`,
  `manylist_1`.`Title` AS `Parent_title`
FROM (`manylist`
  JOIN `manylist` `manylist_1`
    ON ((`manylist`.`Parent_id` = `manylist_1`.`ID`)))
WHERE (`manylist`.`List_type_id` = 19);