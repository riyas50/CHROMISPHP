-- mySQL or MariaDB Queries for Chromis POS analysis
select * from products 
where REFERENCE='1008'
order by REFERENCE;
select * from products_com;
  select * from stockcurrent 
  where PRODUCT='729307a1-301a-4e46-9618-02486be3b216'
  order by UNITS;
    select * from stockdiary;
      select * from stockchanges;
        select * from stocklevel;
          select * from locations;
            select * from categories;

select * from taxcategories;
select * from taxes;
select * from taxlines;
select * from taxcustcategories;

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
