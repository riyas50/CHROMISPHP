CREATE 
	DEFINER = 'root'@'localhost'
VIEW grandchromis.view_all_cash_customers
AS
SELECT DISTINCT
  `t`.`TICKETID` AS `TICKETID`,
  'Cash Customer' AS `NAME`,
  SUM((`tl`.`UNITS` * `tl`.`PRICE`)) AS `INVAMOUNT`,
  `r`.`DATENEW` AS `INVDATE`,
  `p`.`PAYMENT` AS `PAYMETHOD`
FROM (((`tickets` `t`
  JOIN `ticketlines` `tl`
    ON ((`tl`.`TICKET` = `t`.`ID`)))
  JOIN `receipts` `r`
    ON ((`r`.`ID` = `tl`.`TICKET`)))
  JOIN `payments` `p`
    ON ((`p`.`RECEIPT` = `t`.`ID`)))
WHERE ((`t`.`TICKETTYPE` = 0)
AND ISNULL(`t`.`CUSTOMER`))
GROUP BY `t`.`TICKETID`
ORDER BY `INVDATE` DESC, `t`.`TICKETID`;