﻿
DELIMITER $$

DROP PROCEDURE IF EXISTS PRODPURCHASE$$

CREATE PROCEDURE PRODPURCHASE(IN in_DATENEW TIMESTAMP, in_REASON INT(11), 
  in_LOCATION VARCHAR(255), in_BARCODE VARCHAR(255), in_UNITS DOUBLE, in_PRICE DOUBLE, in_APPUSER VARCHAR(255))
  BEGIN

    -- DECLARE @PID VARCHAR(255);
    SELECT ID INTO @PID FROM PRODUCTS WHERE CODE=in_BARCODE;
    
    INSERT INTO STOCKDIARY (ID, DATENEW, REASON, LOCATION, PRODUCT, UNITS, PRICE, APPUSER )
      VALUES( CONVERT(uuid(),CHAR),CURRENT_TIMESTAMP(),1,0,@PID,in_UNITS,in_PRICE,'Administrator');

      UPDATE stockcurrent sc 
      SET sc.UNITS = sc.UNITS + in_UNITS 
      WHERE SC.PRODUCT=@PID;
      
    
  END$$
DELIMITER ;

/*
SELECT * FROM STOCKCURRENT;
SELECT * FROM STOCKDIARY;
*/