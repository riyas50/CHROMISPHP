CREATE 
	DEFINER = 'root'@'localhost'
VIEW grandchromis.view_cash_receipt_item_search
AS
SELECT
  `vaci`.`TICKETID` AS `TICKETID`,
  `vaci`.`NAME` AS `NAME`,
  `vat`.`PRODUCT` AS `PRODUCT`,
  `vat`.`QTY` AS `QTY`,
  `vat`.`UNITPRICE` AS `UNITPRICE`,
  `vat`.`TOTAL` AS `TOTAL`,
  `vaci`.`INVDATE` AS `INVDATE`,
  `vaci`.`INVAMOUNT` AS `INVAMOUNT`
FROM (`view_all_cash_customers` `vaci`
  JOIN `view_all_ticketlines` `vat`
    ON ((`vat`.`TICKETID` = `vaci`.`TICKETID`)))
ORDER BY `vaci`.`INVDATE` DESC, `vaci`.`NAME`, `vat`.`PRODUCT`;