CREATE DEFINER = 'root'@'localhost'
PROCEDURE childcare2.delete_initialdiagnose_suggestedservices(IN in_diagnose_id INT(11), `Services2Delete` VARCHAR(50))
BEGIN
   SET @d =CONCAT("DELETE FROM initialdiagnose_suggestedservices WHERE Intial_diagnose_id= ",in_diagnose_id," and Service_id in (",Services2Delete,")" );

  PREPARE stmt FROM @d;
 EXECUTE stmt;

END