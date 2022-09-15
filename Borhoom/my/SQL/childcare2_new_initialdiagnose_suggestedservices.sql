CREATE DEFINER = 'root'@'localhost'
PROCEDURE childcare2.new_initialdiagnose_suggestedservices(IN in_diagnose_id INT, IN in_service_id INT)
BEGIN
  set @found=0;
  select ID into @found from initialdiagnose_suggestedservices  where Intial_diagnose_id=in_diagnose_id and Service_id=in_service_id;
  if(@found <1) then
    INSERT INTO initialdiagnose_suggestedservices
    (
      Intial_diagnose_id
     ,Service_id
    )
    VALUES
    (
      in_diagnose_id -- Intial_diagnose_id - INT(11)
     ,in_service_id -- Service_id - INT(11)
    );
  END IF;
END