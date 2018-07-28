-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

--
-- Set default database
--
USE grandchromis;

--
-- Create view `view_profit_till_date_monthly`
--
CREATE 
	DEFINER = 'root'@'localhost'
VIEW view_profit_till_date_monthly
AS
SELECT
  DATE_FORMAT(`stockdiary`.`DATENEW`, '%M/%Y') AS `TDATE`,
  SUM((`ticketlines`.`UNITS` * `products`.`PRICEBUY`)) AS `COST_VALUE`,
  SUM((`ticketlines`.`UNITS` * `products`.`PRICESELL`)) AS `EXPECTED_SALES_VALUE`,
  SUM((`ticketlines`.`PRICE` * `ticketlines`.`UNITS`)) AS `ACTUAL_SALES_VALUE`,
  (SUM((`ticketlines`.`UNITS` * `products`.`PRICESELL`)) - SUM((`ticketlines`.`UNITS` * `products`.`PRICEBUY`))) AS `EXPECTED_PROFIT`,
  (SUM((`ticketlines`.`PRICE` * `ticketlines`.`UNITS`)) - SUM((`ticketlines`.`UNITS` * `products`.`PRICEBUY`))) AS `ACTUAL_PROFIT`
FROM (((`ticketlines`
  JOIN `receipts`
    ON ((`ticketlines`.`TICKET` = `receipts`.`ID`)))
  JOIN `products`
    ON ((`ticketlines`.`PRODUCT` = `products`.`ID`)))
  JOIN `stockdiary`
    ON (((`stockdiary`.`PRODUCT` = `products`.`ID`)
    AND (`stockdiary`.`DATENEW` = `receipts`.`DATENEW`))))
GROUP BY DATE_FORMAT(`stockdiary`.`DATENEW`, '%M/%Y')
ORDER BY `TDATE`, `products`.`NAME`;

-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

--
-- Set default database
--
USE grandchromis;

--
-- Create view `view_profit_monthly_stationery`
--
CREATE 
	DEFINER = 'root'@'localhost'
VIEW view_profit_monthly_stationery
AS
SELECT
  DATE_FORMAT(`stockdiary`.`DATENEW`, '%M/%Y') AS `TDATE`,
  SUM((`ticketlines`.`UNITS` * `products`.`PRICEBUY`)) AS `COST_VALUE`,
  SUM((`ticketlines`.`UNITS` * `products`.`PRICESELL`)) AS `EXPECTED_SALES_VALUE`,
  SUM((`ticketlines`.`PRICE` * `ticketlines`.`UNITS`)) AS `ACTUAL_SALES_VALUE`,
  (SUM((`ticketlines`.`UNITS` * `products`.`PRICESELL`)) - SUM((`ticketlines`.`UNITS` * `products`.`PRICEBUY`))) AS `EXPECTED_PROFIT`,
  (SUM((`ticketlines`.`PRICE` * `ticketlines`.`UNITS`)) - SUM((`ticketlines`.`UNITS` * `products`.`PRICEBUY`))) AS `ACTUAL_PROFIT`
FROM (((`ticketlines`
  JOIN `receipts`
    ON ((`ticketlines`.`TICKET` = `receipts`.`ID`)))
  JOIN `products`
    ON (((`ticketlines`.`PRODUCT` = `products`.`ID`)
    AND (NOT (`products`.`CATEGORY` IN (SELECT
        `categories`.`ID`
      FROM `categories`
      WHERE (`categories`.`NAME` = 'Internet Services')))))))
  JOIN `stockdiary`
    ON (((`stockdiary`.`PRODUCT` = `products`.`ID`)
    AND (`stockdiary`.`DATENEW` = `receipts`.`DATENEW`))))
GROUP BY DATE_FORMAT(`stockdiary`.`DATENEW`, '%M/%Y')
ORDER BY `TDATE`, `products`.`NAME`;