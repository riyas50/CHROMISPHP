-- yearly
select sum(INVAMOUNTAB),AB.INVDATEAB INVDATEAB from (
  (select sum(invamount) AS INVAMOUNTAB ,year(INVDATE) AS INVDATEAB from view_all_cash_customers A group by A.INVAMOUNT,year(A.INVDATE)) 
  UNION ALL
  (select sum(INVAMOUNT) AS INVAMOUNTAB,YEAR(INVDATE) AS INVDATEAB from view_all_invoices B GROUP BY B.INVAMOUNT,YEAR(B.INVDATE))
  ) AB
  GROUP BY INVDATEAB;

-- monthly
select date_format(AB.INVDATEAB,'%M-%Y') INVDATEAB, sum(INVAMOUNTAB) INVAMOUNT from (
  (select sum(invamount) AS INVAMOUNTAB ,INVDATE AS INVDATEAB from view_all_cash_customers A group by A.INVAMOUNT,year(A.INVDATE),month(a.invdate)) 
  UNION ALL
  (select sum(INVAMOUNT) AS INVAMOUNTAB,INVDATE AS INVDATEAB from view_all_invoices B GROUP BY B.INVAMOUNT,YEAR(B.INVDATE),month(b.invdate))
  ) AB
  GROUP BY year(INVDATEAB),month(invdateab);


-- current month cash sales yearly
select SUM(INVAMOUNTAB) INVAMOUNT,DATE_FORMAT(INVDATEAB,'%M-%Y') INVDATE 
  from view_monthly_sales_all_cash 
WHERE MONTH(INVDATEAB) = 8 -- MONTH(now())
GROUP BY YEAR(INVDATEAB),MONTH(INVDATEAB);

-- current month customer sales yearly
  select SUM(INVAMOUNTAB) INVAMOUNT,DATE_FORMAT(INVDATEAB,'%M-%Y') INVDATE 
  from view_monthly_sales_all_customers
  WHERE MONTH(INVDATEAB) = 2 -- MONTH(now())
GROUP BY YEAR(INVDATEAB),MONTH(INVDATEAB);

