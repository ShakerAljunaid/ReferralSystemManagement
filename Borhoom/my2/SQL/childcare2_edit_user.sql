CREATE DEFINER = 'root'@'localhost'
PROCEDURE childcare2.edit_user(IN `p_ID` INT(11), IN `u_First_name` VARCHAR(255) CHARSET utf8, IN `u_Last_name` VARCHAR(255) CHARSET utf8, IN `u_Gender` SMALLINT(6), IN `u_Phone_no` VARCHAR(255) CHARSET utf8, IN `u_Email` VARCHAR(50) CHARSET utf8, IN `u_Password` VARCHAR(255) CHARSET utf8, IN `u_User_type_id` INT(11), IN `u_Position_id` INT(11), IN u_Created_user INT(11))
BEGIN
if(p_ID=0) then 
insert into 
  person(First_name,Last_name,Phone_no,Gender,Created_user,Created_date)
  VALUEs(u_First_name,u_Last_name,u_Phone_no,u_Gender ,u_Created_user,now());

  select max(ID) into @UserId from person;

 insert into user 
  (Person_id,Email,User_type_id,Position_id,Active,Password)
  values(@UserId,u_Email,u_User_type_id,u_Position_id,1,u_Password);
else
BEGIN
  UPDATE person 
  SET
    First_name = u_First_name -- First_name - VARCHAR(255)
   ,Last_name = u_Last_name -- Last_name - VARCHAR(255)
   ,Gender = u_Gender -- Gender - SMALLINT(6)
   ,Phone_no = u_Phone_no -- Phone_no - VARCHAR(255)
  WHERE
    ID = p_ID -- ID - INT(11) NOT NULL
  ;
  UPDATE user 
  SET
    Email = u_Email -- Email - VARCHAR(50)
   ,Password = u_Password -- Password - VARCHAR(255)
   ,User_type_id = u_User_type_id -- User_type_id - INT(11)
   ,Position_id = u_Position_id -- Position_id - INT(11)
  WHERE
    Person_id = p_ID -- ID - INT(11) NOT NULL
  ;
END;
end if;
END