-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

--
-- Set default database
--
USE childcare2;

DELIMITER $$

--
-- Create procedure `edit_closedcase`
--
CREATE DEFINER = 'root'@'localhost'
PROCEDURE edit_closedcase(IN cd_id INT, IN cd_case_id INT, IN cd_close_status INT, IN cd_reason TEXT CHARSET UTF8, IN cd_user_id INT)
BEGIN
  IF cd_id = 0 THEN
  BEGIN
INSERT INTO closedcase (Case_id
, Close_status
, Reason
, Created_date
, Created_user)
  VALUES (cd_case_id -- Case_id - INT(11) NOT NULL
  , cd_close_status -- Close_status - INT(11) NOT NULL
  , cd_reason -- Reason - TEXT NOT NULL
  , NOW() -- Created_date - DATE
  , cd_user_id -- Created_user - INT(11)
  );
UPDATE childcase
SET Case_final_decision_id = 431 -- Case_final_decision_id - INT(11)
WHERE ID = cd_case_id -- ID - INT(11) NOT NULL
;
END;
ELSE
  BEGIN
    IF cd_close_status = 1 THEN
    BEGIN
UPDATE closedcase
SET Close_status = cd_close_status -- Close_status - INT(11) NOT NULL
    ,
    Reason = cd_reason -- Reason - TEXT NOT NULL
    ,
    Modified_date = NOW() -- Modified_date - DATE
    ,
    Modified_user_id = cd_user_id -- Modified_user_id - INT(11)
WHERE ID = cd_id -- ID - INT(11) NOT NULL
;
UPDATE childcase
SET Case_final_decision_id = 431 -- Case_final_decision_id - INT(11)
WHERE ID = cd_case_id -- ID - INT(11) NOT NULL
;
END;
ELSE
    BEGIN
UPDATE closedcase
SET Close_status = cd_close_status -- Close_status - INT(11) NOT NULL
    ,
    Reopen_reason = cd_reason -- Reopen_reason - TEXT
    ,
    Modified_date = NOW() -- Modified_date - DATE
    ,
    Modified_user_id = cd_user_id -- Modified_user_id - INT(11)
WHERE ID = cd_id -- ID - INT(11) NOT NULL
;
UPDATE childcase
SET Case_final_decision_id = 398 -- Case_final_decision_id - INT(11)
WHERE ID = cd_case_id -- ID - INT(11) NOT NULL
;
END;
END IF;
END;

END IF;
END
$$

DELIMITER ;