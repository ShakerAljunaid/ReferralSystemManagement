USE childcare2;

DROP VIEW retriveusers CASCADE;

CREATE 
	DEFINER = 'root'@'localhost'
VIEW retriveusers
AS
SELECT
  `user`.`ID` AS `ID`,
  `person`.`ID` AS `PID`,
  `person`.`First_name` AS `First_name`,
  `person`.`Last_name` AS `Last_name`,
  `person`.`Gender` AS `Gender`,
  (CASE WHEN (`person`.`Gender` = 1) THEN 'ذكر' ELSE 'انثى' END) AS `Gender_name`,
  `person`.`Phone_no` AS `Phone_no`,
  `user`.`Email` AS `Email`,
  `user`.`Password` AS `Password`,
  `user`.`User_type_id` AS `User_type_id`,
  tlist.Title AS User_type_title,
  `user`.`Position_id` AS `Position_id`,
  plist.Title AS Position_title,
  `user`.`Active` AS `Active`,
  (CASE WHEN (`user`.`Active` = 1) THEN 'نعم' ELSE 'لا' END) AS `Active_name`
FROM (((`user`
  JOIN `person`
    ON ((`user`.Person_id = `person`.`ID`)))
JOIN manylist tlist
    ON ((`user`.User_type_id = tlist.`ID`)))
JOIN manylist plist
    ON ((`user`.Position_id = plist.`ID`)));