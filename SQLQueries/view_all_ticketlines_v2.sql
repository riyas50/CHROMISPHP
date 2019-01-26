-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

--
-- Set default database
--
USE grandchromis;

DROP VIEW view_all_ticketlines_v2;

--
-- Create view "view_all_ticketlines_v2"
--
CREATE 
	DEFINER = 'root'@'localhost'
VIEW view_all_ticketlines_v2 
  AS
SELECT
  t.TICKETID AS TICKETID,
  p.CODE AS PCODE,
  p.NAME AS PRODUCT,
  tl.LINE + 1 AS LINEITEM,
  tl.UNITS AS QTY,
  tl.PRICE AS UNITPRICE,
  tl.UNITS * tl.PRICE AS TOTAL
FROM tickets t
  INNER JOIN ticketlines tl
    ON tl.TICKET = t.ID
  INNER JOIN products p
    ON p.ID = tl.PRODUCT
WHERE t.TICKETTYPE = 0