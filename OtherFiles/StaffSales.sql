select * from view_all_products ORDER BY CODE;
select * from view_all_items_price_list ORDER BY PCODE;
select * from staffsalelines; -- WHERE ROWID = 'dc80c84c-159e-11ea-9712-dc0ea1a2d923';
select * from staffsaletickets;
select * from staffsaleheader;

-- select (MAX(TICKETNO) + 1) AS NEXTTICKET from staffsaletickets;

-- INSERT INTO staffsaletickets VALUES (CONVERT(UUID(),CHAR),0);

-- CALL STAFFSALENEXTTICKET();
-- CALL STAFFSALEUPDATETICKET();
-- update staffsaletickets set TICKETNO = 0;

--   CALL STAFFSALENEWLINE(1,'1234','SOME ITEM',10.40,5,0,0,CURRENT_DATE(),CURRENT_TIME(),'06122019000004',7);
  select * from staffsalelines;
  select * from staffsaleheader;
-- DELETE FROM staffsaleheader;
-- CALL STAFFSALEHEADERUPDATE(11, '0712201900011', '07/12/2019' , '10:54:17');

-- DELETE FROM staffsalelines;
-- INSERT INTO staffsalelines VALUES (CONVERT(UUID(),CHAR),1,'2344','ITEM NAME',100.00,2,(PRICESELL*PQTY),0,CURRENT_DATE(),CURRENT_TIME(),'03012201900001',1);


-- SELECT CURRENT_DATE();

-- CALL STAFFSALENEWLINE(@TICKETNO, @PCODE, @PNAME, @PRICESELL, @PQTY, @PTOTAL, @PVOID, @SALEDATE, @SALETIME, @TICKETTXT, @SEQ);