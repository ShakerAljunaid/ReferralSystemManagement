CREATE DEFINER = 'root'@'localhost'
PROCEDURE childcare2.new_initialdiagnose_behavior(IN in_diagnose_id INT, IN in_behavior_id INT)
BEGIN
  set @found=0;
  select ID into @found from initialdiagnose_behavior  where Intial_diagnose_id=in_diagnose_id and Behavior_id=in_behavior_id;
  if(@found <1) then
    INSERT INTO initialdiagnose_behavior
    (
      Intial_diagnose_id
     ,Behavior_id
    )
    VALUES
    (
      in_diagnose_id -- Intial_diagnose_id - INT(11)
     ,in_behavior_id -- Service_id - INT(11)
    );
  END IF;
END