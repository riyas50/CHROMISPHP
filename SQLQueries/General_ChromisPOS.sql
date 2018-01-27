use chromispos;
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
-- select * from stockdiary;
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
  
 */
/*
select * from ticketlines;
select * from stockdiary;
select * from receipts;
  */