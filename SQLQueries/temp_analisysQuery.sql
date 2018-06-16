SELECT
  YEAR(`receipts`.`datenew`) as oYear,
  -- `products`.`REFERENCE` AS `REFERENCE`,
  -- `products`.`NAME` AS `NAME`,
  -- `products`.`PRICEBUY` AS `PRICEBUY`,
  -- `products`.`PRICESELL` AS `PRICESELL`,
  -- SUM(`ticketlines`.`UNITS`) AS `SOLD_UNITS`,
  -- SUM((`ticketlines`.`UNITS` * `products`.`PRICEBUY`)) AS `COST_VALUE`,
  -- SUM((`ticketlines`.`UNITS` * `products`.`PRICESELL`)) AS `EXPECTED_SALES_VALUE`,
  -- SUM((`ticketlines`.`PRICE` * `ticketlines`.`UNITS`)) AS `ACTUAL_SALES_VALUE`
  -- (SUM((`ticketlines`.`UNITS` * `products`.`PRICESELL`)) - SUM((`ticketlines`.`UNITS` * `products`.`PRICEBUY`))) AS `EXPECTED_PROFIT`,
  (SUM((`ticketlines`.`PRICE` * `ticketlines`.`UNITS`)) - SUM((`ticketlines`.`UNITS` * `products`.`PRICEBUY`))) AS `ACTUAL_PROFIT`
FROM (((`ticketlines`
  JOIN `products`
    ON ((`products`.`ID` = `ticketlines`.`PRODUCT`)))
  JOIN `receipts`
    ON ((`receipts`.`ID` = `ticketlines`.`TICKET`)))
  JOIN `tickets`
    ON (((`tickets`.`ID` = `ticketlines`.`TICKET`)
    AND (`tickets`.`TICKETTYPE` = 0))))
WHERE `ticketlines`.`TICKET` IN (SELECT
    `receipts`.`ID`
  FROM `receipts`)
GROUP BY YEAR(`receipts`.`DATENEW`) -- `ticketlines`.`PRODUCT`
ORDER BY YEAR(`receipts`.`DATENEW`)