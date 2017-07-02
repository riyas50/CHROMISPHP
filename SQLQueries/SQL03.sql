-- mySQL or MariaDB Queries for Chromis POS analysis
select * from products;
select * from products_com;
  select * from stockcurrent order by UNITS;
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
delete from categories where name != 'Stationery';
delete from stockcurrent where units>0;
delete from products where code='10007';

 delete from stockcurrent;
delete from products;
  delete from categories;
  */
