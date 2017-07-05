﻿INSERT INTO STOCKDIARY (ID, DATENEW, REASON, LOCATION, PRODUCT, UNITS, PRICE, APPUSER ) 
    SELECT C.ID, C.UPLOADTIME, IF( C.TEXTVALUE > 0, -7, -8 ), 
		C.LOCATION, C.PRODUCTID, C.TEXTVALUE, 0.0, C.USERNAME  
    FROM STOCKCHANGES C
    WHERE C.FIELD = 'QTY_INSTOCK' AND C.CHANGES_PROCESSED = 0 AND NOT C.CHANGETYPE = 1;

INSERT INTO STOCKDIARY (ID, DATENEW, REASON, LOCATION, PRODUCT, UNITS, PRICE, APPUSER ) 
    SELECT C.ID, C.UPLOADTIME, IF( S.UNITS + C.TEXTVALUE > 0, -7, -8 ), 
		C.LOCATION, C.PRODUCTID, S.UNITS + C.TEXTVALUE, 0.0, C.USERNAME 
    FROM STOCKCHANGES C LEFT JOIN STOCKCURRENT S 
        ON C.LOCATION = S.LOCATION AND C.PRODUCTID = S.PRODUCT
    WHERE C.FIELD = 'QTY_INSTOCK' AND  C.CHANGES_PROCESSED = 0 AND C.CHANGETYPE = 1;

UPDATE STOCKCURRENT S, STOCKCHANGES C SET S.UNITS = S.UNITS + C.TEXTVALUE 
   WHERE C.FIELD = 'QTY_INSTOCK' AND S.PRODUCT = C.PRODUCTID AND S.LOCATION = C.LOCATION
         AND C.CHANGES_PROCESSED = 0 AND C.CHANGETYPE = 1;
 
UPDATE STOCKCURRENT S, STOCKCHANGES C SET S.UNITS = C.TEXTVALUE 
   WHERE C.FIELD = 'QTY_INSTOCK' AND S.PRODUCT = C.PRODUCTID AND S.LOCATION = C.LOCATION
         AND C.CHANGES_PROCESSED = 0 AND NOT C.CHANGETYPE = 1;