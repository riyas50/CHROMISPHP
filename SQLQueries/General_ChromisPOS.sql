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