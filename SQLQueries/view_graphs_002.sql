-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

--
-- Set default database
--
USE chromispos;

--
-- Create view `view_yearly_sales_all_cash`
--
CREATE 
	DEFINER = 'root'@'localhost'
VIEW view_yearly_sales_all_cash
AS
SELECT
  SUM(`b`.`INVAMOUNT`) AS `INVAMOUNTAB`,
  YEAR(`b`.`INVDATE`) AS `INVDATEAB`
FROM `view_all_invoices` `b`
GROUP BY `b`.`INVAMOUNT`,
         YEAR(`b`.`INVDATE`);

--
-- Create view `view_yearly_sales_all_customers`
--
CREATE 
	DEFINER = 'root'@'localhost'
VIEW view_yearly_sales_all_customers
AS
SELECT
  SUM(`a`.`INVAMOUNT`) AS `INVAMOUNTAB`,
  YEAR(`a`.`INVDATE`) AS `INVDATEAB`
FROM `view_all_cash_customers` `a`
GROUP BY `a`.`INVAMOUNT`,
         YEAR(`a`.`INVDATE`);

--
-- Create view `view_yearly_sales_all`
--
CREATE 
	DEFINER = 'root'@'localhost'
VIEW view_yearly_sales_all
AS
SELECT
  `view_yearly_sales_all_customers`.`INVAMOUNTAB` AS `INVAMOUNTAB`,
  `view_yearly_sales_all_customers`.`INVDATEAB` AS `INVDATEAB`
FROM `view_yearly_sales_all_customers` UNION ALL SELECT
  `view_yearly_sales_all_cash`.`INVAMOUNTAB` AS `INVAMOUNTAB`,
  `view_yearly_sales_all_cash`.`INVDATEAB` AS `INVDATEAB`
FROM `view_yearly_sales_all_cash`;

--
-- Create view `view_monthly_sales_all_customers`
--
CREATE 
	DEFINER = 'root'@'localhost'
VIEW view_monthly_sales_all_customers
AS
SELECT
  SUM(`a`.`INVAMOUNT`) AS `INVAMOUNTAB`,
  `a`.`INVDATE` AS `INVDATEAB`
FROM `view_all_cash_customers` `a`
GROUP BY `a`.`INVAMOUNT`,
         YEAR(`a`.`INVDATE`),
         MONTH(`a`.`INVDATE`)
ORDER BY `INVDATEAB`;

--
-- Create view `view_current_month_cust_sales`
--
CREATE 
	DEFINER = 'root'@'localhost'
VIEW view_current_month_cust_sales
AS
SELECT
  SUM(`view_monthly_sales_all_customers`.`INVAMOUNTAB`) AS `INVAMOUNT`,
  DATE_FORMAT(`view_monthly_sales_all_customers`.`INVDATEAB`, '%M-%Y') AS `INVDATE`
FROM `view_monthly_sales_all_customers`
WHERE (MONTH(`view_monthly_sales_all_customers`.`INVDATEAB`) = MONTH(NOW()))
GROUP BY YEAR(`view_monthly_sales_all_customers`.`INVDATEAB`),
         MONTH(`view_monthly_sales_all_customers`.`INVDATEAB`);

--
-- Create view `view_monthly_sales_all_cash`
--
CREATE 
	DEFINER = 'root'@'localhost'
VIEW view_monthly_sales_all_cash
AS
SELECT
  SUM(`b`.`INVAMOUNT`) AS `INVAMOUNTAB`,
  `b`.`INVDATE` AS `INVDATEAB`
FROM `view_all_invoices` `b`
GROUP BY `b`.`INVAMOUNT`,
         YEAR(`b`.`INVDATE`),
         MONTH(`b`.`INVDATE`)
ORDER BY `INVDATEAB`;

--
-- Create view `view_monthly_sales_all`
--
CREATE 
	DEFINER = 'root'@'localhost'
VIEW view_monthly_sales_all
AS
SELECT
  SUM(`view_monthly_sales_all_customers`.`INVAMOUNTAB`) AS `INVAMOUNT`,
  DATE_FORMAT(`view_monthly_sales_all_customers`.`INVDATEAB`, '%M-%Y') AS `INVDATE`
FROM `view_monthly_sales_all_customers`
GROUP BY YEAR(`view_monthly_sales_all_customers`.`INVDATEAB`),
         MONTH(`view_monthly_sales_all_customers`.`INVDATEAB`) UNION ALL SELECT
  SUM(`view_monthly_sales_all_cash`.`INVAMOUNTAB`) AS `INVAMOUNT`,
  DATE_FORMAT(`view_monthly_sales_all_cash`.`INVDATEAB`, '%M-%Y') AS `INVDATE`
FROM `view_monthly_sales_all_cash`
GROUP BY YEAR(`view_monthly_sales_all_cash`.`INVDATEAB`),
         MONTH(`view_monthly_sales_all_cash`.`INVDATEAB`);

--
-- Create view `view_current_month_cash_sales`
--
CREATE 
	DEFINER = 'root'@'localhost'
VIEW view_current_month_cash_sales
AS
SELECT
  SUM(`view_monthly_sales_all_cash`.`INVAMOUNTAB`) AS `INVAMOUNT`,
  DATE_FORMAT(`view_monthly_sales_all_cash`.`INVDATEAB`, '%M-%Y') AS `INVDATE`
FROM `view_monthly_sales_all_cash`
WHERE (MONTH(`view_monthly_sales_all_cash`.`INVDATEAB`) = MONTH(NOW()))
GROUP BY YEAR(`view_monthly_sales_all_cash`.`INVDATEAB`),
         MONTH(`view_monthly_sales_all_cash`.`INVDATEAB`);

--
-- Create view `view_yearly_total_sales`
--
CREATE 
	DEFINER = 'root'@'localhost'
VIEW view_yearly_total_sales
AS
SELECT
  SUM((`ticketlines`.`PRICE` * `ticketlines`.`UNITS`)) AS `ACTUAL_SALES_VALUE`,
  YEAR(`receipts`.`DATENEW`) AS `oYear`
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
GROUP BY YEAR(`receipts`.`DATENEW`)
ORDER BY YEAR(`receipts`.`DATENEW`);

--
-- Create view `view_yearly_total_profit`
--
CREATE 
	DEFINER = 'root'@'localhost'
VIEW view_yearly_total_profit
AS
SELECT
  (SUM((`ticketlines`.`PRICE` * `ticketlines`.`UNITS`)) - SUM((`ticketlines`.`UNITS` * `products`.`PRICEBUY`))) AS `ACTUAL_PROFIT`,
  YEAR(`receipts`.`DATENEW`) AS `oYear`
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
GROUP BY YEAR(`receipts`.`DATENEW`)
ORDER BY YEAR(`receipts`.`DATENEW`);