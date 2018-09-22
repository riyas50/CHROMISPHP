-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

--
-- Set default database
--
USE grandchromis;

--
-- Create table `cust_pay_status`
--
CREATE TABLE cust_pay_status (
  TicketID INT(11) NOT NULL,
  RecorID BIGINT(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (RecorID)
)
ENGINE = INNODB,
AUTO_INCREMENT = 200,
CHARACTER SET latin1,
COLLATE latin1_swedish_ci;

--
-- Create index `TicketID` on table `cust_pay_status`
--
ALTER TABLE cust_pay_status 
  ADD UNIQUE INDEX TicketID(TicketID);