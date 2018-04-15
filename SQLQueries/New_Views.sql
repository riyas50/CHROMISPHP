-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

--
-- Set default database
--
USE grandchromis;

--
-- Create view `view_all_ticketlines`
--
CREATE 
	DEFINER = 'root'@'localhost'
VIEW view_all_ticketlines
AS
SELECT
  `t`.`TICKETID` AS `TICKETID`,
  `p`.`NAME` AS `PRODUCT`,
  `tl`.`LINE` AS `LINEITEM`,
  `tl`.`UNITS` AS `QTY`,
  `tl`.`PRICE` AS `UNITPRICE`,
  (`tl`.`UNITS` * `tl`.`PRICE`) AS `TOTAL`
FROM ((`tickets` `t`
  JOIN `ticketlines` `tl`
    ON ((`tl`.`TICKET` = `t`.`ID`)))
  JOIN `products` `p`
    ON ((`p`.`ID` = `tl`.`PRODUCT`)))
WHERE (`t`.`TICKETTYPE` = 0);

--
-- Create view `view_all_invoices`
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

--
-- Create view `view_customer_item_search`
--
CREATE 
	DEFINER = 'root'@'localhost'
VIEW view_customer_item_search
AS
SELECT
  `vai`.`TICKETID` AS `TICKETID`,
  `vai`.`NAME` AS `NAME`,
  `vat`.`PRODUCT` AS `PRODUCT`,
  `vat`.`QTY` AS `QTY`,
  `vat`.`UNITPRICE` AS `UNITPRICE`,
  `vat`.`TOTAL` AS `TOTAL`,
  `vai`.`INVDATE` AS `INVDATE`,
  `vai`.`INVAMOUNT` AS `INVAMOUNT`
FROM (`view_all_invoices` `vai`
  JOIN `view_all_ticketlines` `vat`
    ON ((`vat`.`TICKETID` = `vai`.`TICKETID`)))
ORDER BY `vai`.`INVDATE` DESC, `vai`.`NAME`, `vat`.`PRODUCT`;

--
-- Create view `view_all_products`
--
CREATE 
	DEFINER = 'root'@'localhost'
VIEW view_all_products
AS
SELECT
  `p`.`ID` AS `ID`,
  `p`.`CODE` AS `CODE`,
  `p`.`NAME` AS `NAME`
FROM `products` `p`
ORDER BY `p`.`NAME`;

--
-- Create view `view_allcustomers`
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