-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

--
-- Set default database
--
USE grandchromis;

--
-- Create view "view_allcustomers"
--
CREATE 
	DEFINER = 'root'@'localhost'
VIEW view_allcustomers
AS
SELECT
  `customers`.`ID` AS `ID`,
  `customers`.`NAME` AS `NAME`,
  `customers`.`MAXDEBT` AS `MAXDEBT`,
  `customers`.`CURDEBT` AS `CURDEBT`
FROM `customers`
ORDER BY `customers`.`NAME`;