-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

--
-- Set default database
--
USE grandchromis;

DROP VIEW view_all_ticketlines;

--
-- Create view "view_all_ticketlines"
--
CREATE 
	DEFINER = 'root'@'localhost'
VIEW view_all_ticketlines
AS
SELECT
  `t`.`TICKETID` AS `TICKETID`,
  `p`.`NAME` AS `PRODUCT`,
  `tl`.`LINE`+1 AS `LINEITEM`,
  `tl`.`UNITS` AS `QTY`,
  `tl`.`PRICE` AS `UNITPRICE`,
  (`tl`.`UNITS` * `tl`.`PRICE`) AS `TOTAL`
FROM ((`tickets` `t`
  JOIN `ticketlines` `tl`
    ON ((`tl`.`TICKET` = `t`.`ID`)))
  JOIN `products` `p`
    ON ((`p`.`ID` = `tl`.`PRODUCT`)))
WHERE (`t`.`TICKETTYPE` = 0);