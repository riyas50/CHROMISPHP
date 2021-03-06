﻿-- drop the object first

DROP PROCEDURE IF EXISTS SALESPROFITMONTHLY;
-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

--
-- Set default database
--
-- USE chromispos;

DELIMITER $$

--
-- Create procedure "SALESPROFITMONTHLY"
--
CREATE DEFINER = 'root'@'localhost'
PROCEDURE SALESPROFITMONTHLY(IN in_DATE1 VARCHAR(10),IN in_DATE2 VARCHAR(10))
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
 INNER JOIN receipts ON receipts.ID = ticketlines.TICKET 
  AND DATE_FORMAT(receipts.DATENEW,"%Y-%m") BETWEEN DATE_FORMAT(STR_TO_DATE(in_DATE1, '%d/%m/%Y'),"%Y-%m") 
  AND DATE_FORMAT(STR_TO_DATE(in_DATE2, '%d/%m/%Y'),"%Y-%m")
 INNER JOIN products ON products.ID = TICKETLINES.PRODUCT
  INNER JOIN tickets on TICKETLINES.TICKET = tickets.ID and tickets.TICKETTYPE=0
GROUP BY YEAR(receipts.DATENEW),MONTH(receipts.DATENEW)
ORDER BY YEAR(receipts.DATENEW),MONTH(receipts.DATENEW);
ELSEIF ((in_DATE1 IS NOT NULL OR in_DATE1 != '') AND (in_DATE2 IS NULL OR in_DATE2 = '')) THEN
-- Specific Date
SELECT
  DATE_FORMAT(RECEIPTS.DATENEW, "%M/%Y") AS TDATE,
  SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY) AS COST_VALUE,
  SUM(TICKETLINES.UNITS * PRODUCTS.PRICESELL) AS EXPECTED_SALES_VALUE,
  SUM(TICKETLINES.PRICE * TICKETLINES.UNITS) AS ACTUAL_SALES_VALUE,
  (SUM(TICKETLINES.UNITS * PRODUCTS.PRICESELL) - SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY)) AS EXPECTED_PROFIT,
  (SUM(TICKETLINES.PRICE * TICKETLINES.UNITS) - SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY)) AS ACTUAL_PROFIT
FROM TICKETLINES TICKETLINES
 INNER JOIN receipts ON receipts.ID = ticketlines.TICKET 
  AND DATE_FORMAT(receipts.DATENEW,"%Y-%m") = DATE_FORMAT(STR_TO_DATE(in_DATE1, '%d/%m/%Y'),"%Y-%m") 
 INNER JOIN products ON products.ID = TICKETLINES.PRODUCT
  INNER JOIN tickets on TICKETLINES.TICKET = tickets.ID and tickets.TICKETTYPE=0
GROUP BY YEAR(receipts.DATENEW),MONTH(receipts.DATENEW)
ORDER BY YEAR(receipts.DATENEW),MONTH(receipts.DATENEW);
ELSEIF ((in_DATE1 IS NULL OR in_DATE1 = '') AND (in_DATE2 IS NULL OR in_DATE2 = '')) THEN
-- No Date (Till Date)
SELECT
  DATE_FORMAT(RECEIPTS.DATENEW, "%M/%Y") AS TDATE,
  SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY) AS COST_VALUE,
  SUM(TICKETLINES.UNITS * PRODUCTS.PRICESELL) AS EXPECTED_SALES_VALUE,
  SUM(TICKETLINES.PRICE * TICKETLINES.UNITS) AS ACTUAL_SALES_VALUE,
  (SUM(TICKETLINES.UNITS * PRODUCTS.PRICESELL) - SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY)) AS EXPECTED_PROFIT,
  (SUM(TICKETLINES.PRICE * TICKETLINES.UNITS) - SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY)) AS ACTUAL_PROFIT
FROM TICKETLINES TICKETLINES
 INNER JOIN receipts ON receipts.ID = ticketlines.TICKET 
 INNER JOIN products ON products.ID = TICKETLINES.PRODUCT
  INNER JOIN tickets on TICKETLINES.TICKET = tickets.ID and tickets.TICKETTYPE=0
GROUP BY YEAR(receipts.DATENEW),MONTH(receipts.DATENEW)
ORDER BY YEAR(receipts.DATENEW),MONTH(receipts.DATENEW);
END IF;
END
$$

DELIMITER ;