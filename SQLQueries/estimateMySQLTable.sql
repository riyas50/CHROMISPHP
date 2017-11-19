﻿CREATE TABLE chromispos.estimate (
  CODE VARCHAR(255) NOT NULL,
  PRICESELL DOUBLE DEFAULT 0,
  QUANTITY SMALLINT(6) DEFAULT 0,
  PRIMARY KEY (CODE),
  UNIQUE INDEX UK_estimate_CODE (CODE)
)
ENGINE = INNODB
AVG_ROW_LENGTH = 8192
CHARACTER SET latin1
COLLATE latin1_general_ci;