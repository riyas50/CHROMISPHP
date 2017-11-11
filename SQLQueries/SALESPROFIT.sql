﻿USE chromispos;
DELIMITER $$
DROP PROCEDURE IF EXISTS SALESPROFITDATE$$
CREATE DEFINER = 'root'@'localhost'
PROCEDURE SALESPROFITDATE(IN in_DATE1 VARCHAR(10),IN in_DATE2 VARCHAR(10))
BEGIN
  IF ((in_DATE1 IS NOT NULL OR in_DATE1 <> '') AND (in_DATE2 IS NOT NULL OR in_DATE2 <> '')) THEN 
  -- SELECT 'DATE 1 AND 2 ARE NOT EMPTY' AS RESULTS; 
  --          WHERE DATE(STOCKDIARY.DATENEW) BETWEEN in_DATE1 AND in_DATE2
        SELECT PRODUCTS.REFERENCE, 
             PRODUCTS.NAME,
             DATE_FORMAT(STOCKDIARY.DATENEW,"%d/%m/%Y") AS TDATE, 
             DATE_FORMAT(STOCKDIARY.DATENEW,"%h:%i:%s %p") AS TTIME,
             PRODUCTS.PRICEBUY, 
             PRODUCTS.PRICESELL, 
             (TICKETLINES.UNITS) AS SOLD_UNITS, 
             (TICKETLINES.UNITS * PRODUCTS.PRICEBUY) AS COST_VALUE, 
             (TICKETLINES.UNITS * PRODUCTS.PRICESELL) AS EXPECTED_SALES_VALUE, 
             (TICKETLINES.PRICE * TICKETLINES.UNITS) AS ACTUAL_SALES_VALUE, 
               (TICKETLINES.UNITS * PRODUCTS.PRICESELL) 
             - (TICKETLINES.UNITS * PRODUCTS.PRICEBUY) 
                AS EXPECTED_PROFIT, 
             (TICKETLINES.PRICE * TICKETLINES.UNITS) - (TICKETLINES.UNITS * PRODUCTS.PRICEBUY) 
                AS ACTUAL_PROFIT 
        FROM (TICKETLINES TICKETLINES 
             INNER JOIN RECEIPTS RECEIPTS 
                 ON (TICKETLINES.TICKET = RECEIPTS.ID)) 
             LEFT OUTER JOIN PRODUCTS PRODUCTS 
                ON (TICKETLINES.PRODUCT = PRODUCTS.ID) 
             RIGHT JOIN STOCKDIARY STOCKDIARY
                ON (STOCKDIARY.PRODUCT=PRODUCTS.ID)
          WHERE DATE(STOCKDIARY.DATENEW) BETWEEN in_DATE1 AND in_DATE2
          GROUP BY TICKETLINES.PRODUCT -- ,STOCKDIARY.DATENEW      
          ORDER BY TDATE,TTIME,PRODUCTS.NAME ASC; 
  ELSEIF ((in_DATE1 IS NOT NULL OR in_DATE1 != '') AND (in_DATE2 IS NULL OR in_DATE2 = '')) THEN 
  -- SELECT 'DATE 1 IS NOT EMPTY, DATE2 IS EMPTY' AS RESULTS;
    SELECT PRODUCTS.REFERENCE, 
           PRODUCTS.NAME,
           DATE_FORMAT(STOCKDIARY.DATENEW,"%d/%m/%Y") AS TDATE, 
           DATE_FORMAT(STOCKDIARY.DATENEW,"%h:%i:%s %p") AS TTIME,
           PRODUCTS.PRICEBUY, 
           PRODUCTS.PRICESELL, 
           (TICKETLINES.UNITS) AS SOLD_UNITS, 
           (TICKETLINES.UNITS * PRODUCTS.PRICEBUY) AS COST_VALUE, 
           (TICKETLINES.UNITS * PRODUCTS.PRICESELL) AS EXPECTED_SALES_VALUE, 
           (TICKETLINES.PRICE * TICKETLINES.UNITS) AS ACTUAL_SALES_VALUE, 
             (TICKETLINES.UNITS * PRODUCTS.PRICESELL) 
           - (TICKETLINES.UNITS * PRODUCTS.PRICEBUY) 
              AS EXPECTED_PROFIT, 
           (TICKETLINES.PRICE * TICKETLINES.UNITS) - (TICKETLINES.UNITS * PRODUCTS.PRICEBUY) 
              AS ACTUAL_PROFIT 
      FROM (TICKETLINES TICKETLINES 
           INNER JOIN RECEIPTS RECEIPTS 
               ON (TICKETLINES.TICKET = RECEIPTS.ID)) 
           LEFT OUTER JOIN PRODUCTS PRODUCTS 
              ON (TICKETLINES.PRODUCT = PRODUCTS.ID) 
           RIGHT JOIN STOCKDIARY STOCKDIARY
              ON (STOCKDIARY.PRODUCT=PRODUCTS.ID)
        -- WHERE STOCKDIARY.DATENEW >= '2017/07/14' AND STOCKDIARY.DATENEW < '2017/07/15'
           WHERE DATE(STOCKDIARY.DATENEW) = in_DATE1 
        GROUP BY TICKETLINES.PRODUCT -- ,STOCKDIARY.DATENEW  -- DATE_FORMAT(STOCKDIARY.DATENEW,"%d-%m-%Y") 
        ORDER BY TDATE,TTIME,PRODUCTS.NAME ASC; 
  ELSEIF ((in_DATE1 IS NULL OR in_DATE1 = '') AND (in_DATE2 IS NULL OR in_DATE2 = '')) THEN      
    SELECT PRODUCTS.REFERENCE, 
             PRODUCTS.NAME,
             DATE_FORMAT(STOCKDIARY.DATENEW,"%d/%m/%Y") AS TDATE, 
             DATE_FORMAT(STOCKDIARY.DATENEW,"%h:%i:%s %p") AS TTIME,
             PRODUCTS.PRICEBUY, 
             PRODUCTS.PRICESELL, 
             (TICKETLINES.UNITS) AS SOLD_UNITS, 
             (TICKETLINES.UNITS * PRODUCTS.PRICEBUY) AS COST_VALUE, 
             (TICKETLINES.UNITS * PRODUCTS.PRICESELL) AS EXPECTED_SALES_VALUE, 
             (TICKETLINES.PRICE * TICKETLINES.UNITS) AS ACTUAL_SALES_VALUE, 
               (TICKETLINES.UNITS * PRODUCTS.PRICESELL) 
             - (TICKETLINES.UNITS * PRODUCTS.PRICEBUY) 
                AS EXPECTED_PROFIT, 
             (TICKETLINES.PRICE * TICKETLINES.UNITS) - (TICKETLINES.UNITS * PRODUCTS.PRICEBUY) 
                AS ACTUAL_PROFIT 
        FROM (TICKETLINES TICKETLINES 
             INNER JOIN RECEIPTS RECEIPTS 
                 ON (TICKETLINES.TICKET = RECEIPTS.ID)) 
             LEFT OUTER JOIN PRODUCTS PRODUCTS 
                ON (TICKETLINES.PRODUCT = PRODUCTS.ID) 
             RIGHT JOIN STOCKDIARY STOCKDIARY
                ON (STOCKDIARY.PRODUCT=PRODUCTS.ID)
          GROUP BY TICKETLINES.PRODUCT -- ,STOCKDIARY.DATENEW      
          ORDER BY TDATE,TTIME,PRODUCTS.NAME ASC; 
  END IF;
END$$
DELIMITER ;

