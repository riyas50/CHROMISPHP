/*
-- use chromispos;
-- mySQL or MariaDB Queries for Chromis POS analysis
select * from products 
-- where REFERENCE='1008'
order by REFERENCE;
select * from products_com;
  select * from stockcurrent 
--   where PRODUCT='729307a1-301a-4e46-9618-02486be3b216'
  order by UNITS;
    select * from stockdiary ORDER BY DATENEW;
      select * from stockchanges;
        select * from stocklevel;
          select * from locations;
            select * from categories;

-- select * from taxcategories;
-- select * from taxes;
-- select * from taxlines;
-- select * from taxcustcategories;

select * from ticketlines;
select * from tickets;
select * from ticketsnum;
select * from ticketsnum_invoice;
select * from sharedtickets;
select * from ticketsnum_payment;
select * from ticketsnum_refund;
select * from stockdiary;
*/
/*
select count(units) from stockcurrent   
*/

/*
delete from products
delete from categories where name != 'Stationery';
delete from stockcurrent where units>0;
*/
/*
delete from products
 where reference='1008';
delete from categories where name != 'Stationery';
delete from stockcurrent where units>0;
*/


/*

delete  from ticketlines;
delete  from tickets;
delete  from ticketsnum;
delete  from ticketsnum_invoice;
delete  from sharedtickets;
delete from taxlines;
delete from payments;
delete from receipts;
delete  from ticketsnum_payment;
delete  from ticketsnum_refund;
delete from stockdiary;
delete from stockcurrent;
delete from products;
delete from categories;
*/
/*
call SALESPROFITDATE(NULL,NULL);
call SALESPROFITDATE('2017/07/14',NULL);
call SALESPROFITDATE('2017/07/14','2017/07/28');
*/

/*
select * from estimate;
insert into estimate VALUES ('62',136.00,5);
insert into estimate VALUES ('260',323.00,5);

SELECT e.CODE,p.NAME,e.PRICESELL,e.QUANTITY
  FROM estimate e
  INNER JOIN products p on p.CODE = e.CODE
*/

/*
SELECT PRODUCTS.REFERENCE,         PRODUCTS.NAME,         PRODUCTS.PRICEBUY,         PRODUCTS.PRICESELL,         SUM(TICKETLINES.UNITS) AS SOLD_UNITS,         SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY) AS COST_VALUE,         SUM(TICKETLINES.UNITS * PRODUCTS.PRICESELL) AS EXPECTED_SALES_VALUE,         SUM(TICKETLINES.PRICE * TICKETLINES.UNITS) AS ACTUAL_SALES_VALUE,           SUM(TICKETLINES.UNITS * PRODUCTS.PRICESELL)         - SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY)            AS EXPECTED_PROFIT,         SUM(TICKETLINES.PRICE * TICKETLINES.UNITS) - SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY)            AS ACTUAL_PROFIT    FROM (TICKETLINES TICKETLINES         INNER JOIN RECEIPTS RECEIPTS             ON (TICKETLINES.TICKET = RECEIPTS.ID))         LEFT OUTER JOIN PRODUCTS PRODUCTS            ON (TICKETLINES.PRODUCT = PRODUCTS.ID)      GROUP BY TICKETLINES.PRODUCT      ORDER BY PRODUCTS.REFERENCE ASC;
call SALESPROFITDATE(NULL,NULL); 
  
 /*
    cHROMIS TICKETTYPES IN TICKETS 
    public static final int RECEIPT_NORMAL = 0;
    public static final int RECEIPT_REFUND = 1;
    public static final int RECEIPT_PAYMENT = 2;
    public static final int RECEIPT_NOSALE = 3;
  */
/*
select * from tickets where tickets.id in (select receipts.id from receipts where DATE_FORMAT(RECEIPTS.DATENEW, "%d/%m/%Y")='01/02/2018') order by tickets.ID;
select * from ticketlines where ticketlines.ticket in (select receipts.id from receipts where DATE_FORMAT(RECEIPTS.DATENEW, "%d/%m/%Y")='01/02/2018') 
  and ticketlines.product='8709da74-5e71-4d8d-b91b-0cf299103222' order by ticketlines.ticket;
select * from stockdiary where STOCKDIARY.PRODUCT='8709da74-5e71-4d8d-b91b-0cf299103222' AND DATE_FORMAT(STOCKDIARY.DATENEW, "%d/%m/%Y")='01/02/2018';
select * from receipts where DATE_FORMAT(RECEIPTS.DATENEW, "%d/%m/%Y")='01/02/2018' order by receipts.id;
select * from products where code='500';
  */

  -- CALL UPLOADPROD('500' ,'500','Photostat',1.50,0.35,'Services','000',1);

  -- For Customer wise Invoice Report
  -- /*
  -- TICKETTYPE = 0 //NORMAL TICKET
    select DISTINCT(ID),CUSTOMER,TICKETID from tickets where TICKETTYPE = 0 and CUSTOMER IS NOT NULL ORDER BY TICKETID ASC;
      select * from tickets where TICKETTYPE = 0 AND CUSTOMER = "9069231f-b540-4bca-8875-73b07e711708" ORDER BY TICKETID ASC;
        select * from ticketlines where TICKET = "305329b2-14fe-4f4f-a85e-4d0f73ebd002";
          select * from customers where ID = "9069231f-b540-4bca-8875-73b07e711708";
            select * from payments   ORDER BY TOTAL DESC; -- where PAYMENT = "debt" WHERE TOTAL=1020
              select * from receipts;

  select distinct(TICKETID),C.NAME,SUM(TL.UNITS * TL.PRICE) INVAMOUNT,R.DATENEW INVDATE,P.PAYMENT PAYSTATUS 
    from tickets T
    INNER JOIN customers C on C.ID = T.CUSTOMER -- AND C.ID="9069231f-b540-4bca-8875-73b07e711708"
    INNER JOIN ticketlines TL on TL.TICKET = t.ID -- AND TL.TICKET = "305329b2-14fe-4f4f-a85e-4d0f73ebd002"
    INNER JOIN receipts R on R.ID = TL.TICKET
    INNER JOIN payments P ON P.RECEIPT = T.ID
    where T.TICKETTYPE = 0
    GROUP BY T.TICKETID
    ORDER BY t.TICKETID;

    -- select * from view_allcustomers;
  -- */