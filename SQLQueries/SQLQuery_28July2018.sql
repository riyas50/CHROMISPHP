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

-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

--
-- Set default database
--
USE grandchromis;

DELIMITER $$

--
-- Create procedure `STATIONERYPROFITMONTHLY`
--
CREATE DEFINER = 'root'@'localhost'
PROCEDURE STATIONERYPROFITMONTHLY(IN in_DATE1 VARCHAR(10),IN in_DATE2 VARCHAR(10))
BEGIN
  IF ((in_DATE1 IS NOT NULL OR in_DATE1 <> '') AND (in_DATE2 IS NOT NULL OR in_DATE2 <> '')) THEN
-- Date Range
SELECT
  DATE_FORMAT(RECEIPTS.DATENEW, "%M/%Y") AS TDATE,
  SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY) AS COST_VALUE,
  SUM(TICKETLINES.UNITS * PRODUCTS.PRICESELL) AS EXPECTED_SALES_VALUE,
  SUM(TICKETLINES.PRICE * TICKETLINES.UNITS) AS ACTUAL_SALES_VALUE,
  (SUM(TICKETLINES.UNITS * PRODUCTS.PRICESELL) - SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY)) AS EXPECTED_PROFIT,
  (SUM(TICKETLINES.PRICE * TICKETLINES.UNITS) - SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY)) AS ACTUAL_PROFIT
FROM TICKETLINES TICKETLINES
  INNER JOIN receipts
    ON receipts.ID = ticketlines.TICKET
    AND DATE_FORMAT(receipts.DATENEW, "%Y-%m") BETWEEN DATE_FORMAT(STR_TO_DATE(in_DATE1, '%d/%m/%Y'), "%Y-%m")
    AND DATE_FORMAT(STR_TO_DATE(in_DATE2, '%d/%m/%Y'), "%Y-%m")
  INNER JOIN products
    ON products.ID = TICKETLINES.PRODUCT
    AND products.CATEGORY NOT IN (SELECT
        id
      FROM categories
      WHERE NAME = 'Internet Services')
  INNER JOIN tickets
    ON TICKETLINES.TICKET = tickets.ID
    AND tickets.TICKETTYPE = 0
GROUP BY YEAR(receipts.DATENEW),
         MONTH(receipts.DATENEW)
ORDER BY YEAR(receipts.DATENEW), MONTH(receipts.DATENEW);
ELSEIF ((in_DATE1 IS NOT NULL
  OR in_DATE1 != '')
  AND (in_DATE2 IS NULL
  OR in_DATE2 = '')) THEN
-- Specific Date
SELECT
  DATE_FORMAT(RECEIPTS.DATENEW, "%M/%Y") AS TDATE,
  SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY) AS COST_VALUE,
  SUM(TICKETLINES.UNITS * PRODUCTS.PRICESELL) AS EXPECTED_SALES_VALUE,
  SUM(TICKETLINES.PRICE * TICKETLINES.UNITS) AS ACTUAL_SALES_VALUE,
  (SUM(TICKETLINES.UNITS * PRODUCTS.PRICESELL) - SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY)) AS EXPECTED_PROFIT,
  (SUM(TICKETLINES.PRICE * TICKETLINES.UNITS) - SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY)) AS ACTUAL_PROFIT
FROM TICKETLINES TICKETLINES
  INNER JOIN receipts
    ON receipts.ID = ticketlines.TICKET
    AND DATE_FORMAT(receipts.DATENEW, "%Y-%m") = DATE_FORMAT(STR_TO_DATE(in_DATE1, '%d/%m/%Y'), "%Y-%m")
  INNER JOIN products
    ON products.ID = TICKETLINES.PRODUCT
    AND products.CATEGORY NOT IN (SELECT
        id
      FROM categories
      WHERE NAME = 'Internet Services')
  INNER JOIN tickets
    ON TICKETLINES.TICKET = tickets.ID
    AND tickets.TICKETTYPE = 0
GROUP BY YEAR(receipts.DATENEW),
         MONTH(receipts.DATENEW)
ORDER BY YEAR(receipts.DATENEW), MONTH(receipts.DATENEW);
ELSEIF ((in_DATE1 IS NULL
  OR in_DATE1 = '')
  AND (in_DATE2 IS NULL
  OR in_DATE2 = '')) THEN
-- No Date (Till Date)
SELECT
  DATE_FORMAT(RECEIPTS.DATENEW, "%M/%Y") AS TDATE,
  SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY) AS COST_VALUE,
  SUM(TICKETLINES.UNITS * PRODUCTS.PRICESELL) AS EXPECTED_SALES_VALUE,
  SUM(TICKETLINES.PRICE * TICKETLINES.UNITS) AS ACTUAL_SALES_VALUE,
  (SUM(TICKETLINES.UNITS * PRODUCTS.PRICESELL) - SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY)) AS EXPECTED_PROFIT,
  (SUM(TICKETLINES.PRICE * TICKETLINES.UNITS) - SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY)) AS ACTUAL_PROFIT
FROM TICKETLINES TICKETLINES
  INNER JOIN receipts
    ON receipts.ID = ticketlines.TICKET
  INNER JOIN products
    ON products.ID = TICKETLINES.PRODUCT
    AND products.CATEGORY NOT IN (SELECT
        id
      FROM categories
      WHERE NAME = 'Internet Services')
  INNER JOIN tickets
    ON TICKETLINES.TICKET = tickets.ID
    AND tickets.TICKETTYPE = 0
GROUP BY YEAR(receipts.DATENEW),
         MONTH(receipts.DATENEW)
ORDER BY YEAR(receipts.DATENEW), MONTH(receipts.DATENEW);
END IF;
END
$$

DELIMITER ;

-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

--
-- Set default database
--
USE grandchromis;

--
-- Create view `view_profit_monthly_internet`
--
CREATE 
	DEFINER = 'root'@'localhost'
VIEW view_profit_monthly_internet
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
    AND `products`.`CATEGORY` IN (SELECT
        `categories`.`ID`
      FROM `categories`
      WHERE (`categories`.`NAME` = 'Internet Services')))))
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

DELIMITER $$

--
-- Create procedure `INTERNETPROFITMONTHLY`
--
CREATE DEFINER = 'root'@'localhost'
PROCEDURE INTERNETPROFITMONTHLY(IN in_DATE1 VARCHAR(10),IN in_DATE2 VARCHAR(10))
BEGIN
  IF ((in_DATE1 IS NOT NULL OR in_DATE1 <> '') AND (in_DATE2 IS NOT NULL OR in_DATE2 <> '')) THEN
-- Date Range
SELECT
  DATE_FORMAT(RECEIPTS.DATENEW, "%M/%Y") AS TDATE,
  SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY) AS COST_VALUE,
  SUM(TICKETLINES.UNITS * PRODUCTS.PRICESELL) AS EXPECTED_SALES_VALUE,
  SUM(TICKETLINES.PRICE * TICKETLINES.UNITS) AS ACTUAL_SALES_VALUE,
  (SUM(TICKETLINES.UNITS * PRODUCTS.PRICESELL) - SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY)) AS EXPECTED_PROFIT,
  (SUM(TICKETLINES.PRICE * TICKETLINES.UNITS) - SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY)) AS ACTUAL_PROFIT
FROM TICKETLINES TICKETLINES
  INNER JOIN receipts
    ON receipts.ID = ticketlines.TICKET
    AND DATE_FORMAT(receipts.DATENEW, "%Y-%m") BETWEEN DATE_FORMAT(STR_TO_DATE(in_DATE1, '%d/%m/%Y'), "%Y-%m")
    AND DATE_FORMAT(STR_TO_DATE(in_DATE2, '%d/%m/%Y'), "%Y-%m")
  INNER JOIN products
    ON products.ID = TICKETLINES.PRODUCT
    AND products.CATEGORY IN (SELECT
        id
      FROM categories
      WHERE NAME = 'Internet Services')
  INNER JOIN tickets
    ON TICKETLINES.TICKET = tickets.ID
    AND tickets.TICKETTYPE = 0
GROUP BY YEAR(receipts.DATENEW),
         MONTH(receipts.DATENEW)
ORDER BY YEAR(receipts.DATENEW), MONTH(receipts.DATENEW);
ELSEIF ((in_DATE1 IS NOT NULL
  OR in_DATE1 != '')
  AND (in_DATE2 IS NULL
  OR in_DATE2 = '')) THEN
-- Specific Date
SELECT
  DATE_FORMAT(RECEIPTS.DATENEW, "%M/%Y") AS TDATE,
  SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY) AS COST_VALUE,
  SUM(TICKETLINES.UNITS * PRODUCTS.PRICESELL) AS EXPECTED_SALES_VALUE,
  SUM(TICKETLINES.PRICE * TICKETLINES.UNITS) AS ACTUAL_SALES_VALUE,
  (SUM(TICKETLINES.UNITS * PRODUCTS.PRICESELL) - SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY)) AS EXPECTED_PROFIT,
  (SUM(TICKETLINES.PRICE * TICKETLINES.UNITS) - SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY)) AS ACTUAL_PROFIT
FROM TICKETLINES TICKETLINES
  INNER JOIN receipts
    ON receipts.ID = ticketlines.TICKET
    AND DATE_FORMAT(receipts.DATENEW, "%Y-%m") = DATE_FORMAT(STR_TO_DATE(in_DATE1, '%d/%m/%Y'), "%Y-%m")
  INNER JOIN products
    ON products.ID = TICKETLINES.PRODUCT
    AND products.CATEGORY IN (SELECT
        id
      FROM categories
      WHERE NAME = 'Internet Services')
  INNER JOIN tickets
    ON TICKETLINES.TICKET = tickets.ID
    AND tickets.TICKETTYPE = 0
GROUP BY YEAR(receipts.DATENEW),
         MONTH(receipts.DATENEW)
ORDER BY YEAR(receipts.DATENEW), MONTH(receipts.DATENEW);
ELSEIF ((in_DATE1 IS NULL
  OR in_DATE1 = '')
  AND (in_DATE2 IS NULL
  OR in_DATE2 = '')) THEN
-- No Date (Till Date)
SELECT
  DATE_FORMAT(RECEIPTS.DATENEW, "%M/%Y") AS TDATE,
  SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY) AS COST_VALUE,
  SUM(TICKETLINES.UNITS * PRODUCTS.PRICESELL) AS EXPECTED_SALES_VALUE,
  SUM(TICKETLINES.PRICE * TICKETLINES.UNITS) AS ACTUAL_SALES_VALUE,
  (SUM(TICKETLINES.UNITS * PRODUCTS.PRICESELL) - SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY)) AS EXPECTED_PROFIT,
  (SUM(TICKETLINES.PRICE * TICKETLINES.UNITS) - SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY)) AS ACTUAL_PROFIT
FROM TICKETLINES TICKETLINES
  INNER JOIN receipts
    ON receipts.ID = ticketlines.TICKET
  INNER JOIN products
    ON products.ID = TICKETLINES.PRODUCT
    AND products.CATEGORY IN (SELECT
        id
      FROM categories
      WHERE NAME = 'Internet Services')
  INNER JOIN tickets
    ON TICKETLINES.TICKET = tickets.ID
    AND tickets.TICKETTYPE = 0
GROUP BY YEAR(receipts.DATENEW),
         MONTH(receipts.DATENEW)
ORDER BY YEAR(receipts.DATENEW), MONTH(receipts.DATENEW);
END IF;
END
$$

DELIMITER ;