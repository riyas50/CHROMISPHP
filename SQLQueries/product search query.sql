SELECT
  products.CODE 'BARCODE',
  products.REFERENCE,
  products.NAME,
  products.PRICESELL,
  products.PRICEBUY,
  categories.NAME as 'CATEGORY',
  stockcurrent.UNITS AS 'CURRENT STOCK',
  taxes.NAME as 'TAX CATEGORY'
FROM stockcurrent
  INNER JOIN products
    ON stockcurrent.PRODUCT = products.ID
  INNER JOIN categories
    ON products.CATEGORY = categories.ID
  INNER JOIN taxes
    ON products.TAXCAT = taxes.ID
  WHERE products.code like '%'
  AND products.NAME like '%'
  AND categories.NAME like '%';