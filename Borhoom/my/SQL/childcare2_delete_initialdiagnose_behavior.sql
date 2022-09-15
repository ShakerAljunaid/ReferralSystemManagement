CREATE DEFINER = 'root'@'localhost'
PROCEDURE childcare2.delete_initialdiagnose_behavior(IN in_diagnose_id INT, `Services2Delete` VARCHAR(50))
BEGIN
  SET @d =CONCAT("DELETE FROM initialdiagnose_behavior WHERE Intial_diagnose_id= ",in_diagnose_id," and Behavior_id in (",Services2Delete,")" );

  PREPARE stmt FROM @d;
  EXECUTE stmt;

END