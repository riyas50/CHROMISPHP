select *,'MAX-BILLED' `STATUS`
  from view_customer_item_search
  WHERE NAME LIKE '%Sree Krishna Pooja Stores%' AND PRODUCT LIKE '%Print Out B/W%' AND UNITPRICE = 
    (select MAX(UNITPRICE) 
  from view_customer_item_search
  WHERE NAME LIKE '%Sree Krishna Pooja Stores%' AND PRODUCT LIKE '%Print Out B/W%')
  LIMIT 1
UNION 
  select *,'MIN-BILLED' `STATUS`
  from view_customer_item_search
  WHERE NAME LIKE '%Sree Krishna Pooja Stores%' AND PRODUCT LIKE '%Print Out B/W%' AND UNITPRICE = 
    (select MIN(UNITPRICE) 
  from view_customer_item_search
  WHERE NAME LIKE '%Sree Krishna Pooja Stores%' AND PRODUCT LIKE '%Print Out B/W%')
  LIMIT 1
UNION
select *,'LAST-BILLED' `STATUS`
  from view_customer_item_search
  WHERE NAME LIKE '%Sree Krishna Pooja Stores%' AND PRODUCT LIKE '%Print Out B/W%' AND INVDATE = 
    (select MAX(INVDATE) 
  from view_customer_item_search
  WHERE NAME LIKE '%Sree Krishna Pooja Stores%' AND PRODUCT LIKE '%Print Out B/W%')
  

--    select * from view_customer_item_search;

