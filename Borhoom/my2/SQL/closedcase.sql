-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

--
-- Set default database
--
USE childcare2;

--
-- Create table `closedcase`
--
CREATE TABLE closedcase (
  ID INT(11) NOT NULL AUTO_INCREMENT,
  Case_id INT(11) NOT NULL,
  Close_status INT(11) NOT NULL DEFAULT 1,
  Reason TEXT NOT NULL,
  Reopen_reason TEXT DEFAULT NULL,
  Created_date DATE DEFAULT NULL,
  Created_user INT(11) DEFAULT NULL,
  Modified_date DATE DEFAULT NULL,
  Modified_user_id INT(11) DEFAULT NULL,
  PRIMARY KEY (ID)
)
ENGINE = INNODB,
AUTO_INCREMENT = 2,
AVG_ROW_LENGTH = 16384,
CHARACTER SET utf8,
COLLATE utf8_general_ci;