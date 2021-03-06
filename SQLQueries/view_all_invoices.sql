﻿-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

--
-- Set default database
--
USE grandchromis;

--
-- Create view "view_all_invoices"
--
CREATE 
	DEFINER = 'root'@'localhost'
VIEW view_all_invoices
AS
SELECT DISTINCT
  `t`.`TICKETID` AS `TICKETID`,
  `c`.`NAME` AS `NAME`,
  SUM((`tl`.`UNITS` * `tl`.`PRICE`)) AS `INVAMOUNT`,
  `r`.`DATENEW` AS `INVDATE`,
  `p`.`PAYMENT` AS `PAYMETHOD`
FROM ((((`tickets` `t`
  JOIN `customers` `c`
    ON ((`c`.`ID` = `t`.`CUSTOMER`)))
  JOIN `ticketlines` `tl`
    ON ((`tl`.`TICKET` = `t`.`ID`)))
  JOIN `receipts` `r`
    ON ((`r`.`ID` = `tl`.`TICKET`)))
  JOIN `payments` `p`
    ON ((`p`.`RECEIPT` = `t`.`ID`)))
WHERE (`t`.`TICKETTYPE` = 0)
GROUP BY `t`.`TICKETID`
ORDER BY `t`.`TICKETID`;