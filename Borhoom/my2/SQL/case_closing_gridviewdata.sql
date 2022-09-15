-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

--
-- Set default database
--
USE childcare2;

--
-- Create view `case_closing_gridviewdata`
--
CREATE 
	DEFINER = 'root'@'localhost'
VIEW case_closing_gridviewdata
AS
SELECT
  `c`.`ID` AS `childId`,
  CONCAT(`cp`.`First_name`, ' ', `cp`.`Last_name`) AS `ChildFullName`,
  (CASE WHEN (`cp`.`Gender` = 1) THEN 'ذكر' ELSE 'انثى' END) AS `Gender`,
  CONCAT(`rp`.`First_name`, ' ', `rp`.`Last_name`) AS `CareGiverFullName`,
  `rp`.`Phone_no` AS `CareGiverPhoneNo`,
  CONCAT(`c`.`Living_governate`, '-', `c`.`Living_district`, '-', `c`.`Address`) AS `ChildAddress`,
  `cc`.`ID` AS `caseId`,
  (CASE WHEN ((`c`.`Mother_alive` = 1) AND
      (`c`.`Father_alive` = 1)) THEN 'Both Parents' WHEN ((`c`.`Mother_alive` = 1) AND
      (`c`.`Father_alive` = 0)) THEN 'Father Orpahn' WHEN ((`c`.`Mother_alive` = 0) AND
      (`c`.`Father_alive` = 1)) THEN 'Mother Orpahn' ELSE 'Orphan' END) AS `ParentState`,
  `cc`.`Specialist_id` AS `Specialist_id`,
  `cc`.`Case_final_decision_id` AS `Case_final_decision_id`,
  (CASE WHEN ISNULL(`cl`.`ID`) THEN 0 ELSE `cl`.`ID` END) AS `Close_id`,
  (CASE WHEN ISNULL(`cl`.`Close_status`) THEN 1 WHEN (`cl`.`Close_status` = 1) THEN 0 ELSE 1 END) AS `Close_status_opsite`,
  (CASE WHEN ISNULL(`cl`.`Close_status`) THEN 'نشطة' WHEN (`cl`.`Close_status` = 1) THEN 'مقلقة' ELSE 'معاد فتحها' END) AS `Close_status_title`,
  (CASE WHEN ISNULL(`cl`.`Close_status`) THEN `cc`.`Created_date` WHEN ((`cl`.`Close_status` = 1) AND
      ISNULL(`cl`.`Modified_date`)) THEN `cl`.`Created_date` ELSE `cl`.`Modified_date` END) AS `Status_date`,
  (CASE WHEN ISNULL(`cl`.`Close_status`) THEN `cc`.`Required_service` WHEN (`cl`.`Close_status` = 1) THEN `cl`.`Reason` ELSE `cl`.`Reopen_reason` END) AS `Status_reason`
FROM (((((`person` `cp`
  JOIN `child` `c`
    ON ((`c`.`Person_id` = `cp`.`ID`)))
  JOIN `caregiver` `cg`
    ON ((`c`.`Care_giver_id` = `cg`.`ID`)))
  JOIN `person` `rp`
    ON ((`rp`.`ID` = `cg`.`Person_id`)))
  JOIN `childcase` `cc`
    ON ((`cc`.`Child_id` = `c`.`ID`)))
  LEFT JOIN `closedcase` `cl`
    ON ((`cc`.`ID` = `cl`.`Case_id`)));