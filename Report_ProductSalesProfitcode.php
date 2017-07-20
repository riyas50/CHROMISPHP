<?php
include('dbconnect.php');
$itemname = "";


function profitTillDate()
    {
        prepareOutputTableHeader();
                
        $conn = dbConn();

        $query = "SELECT PRODUCTS.REFERENCE,         PRODUCTS.NAME,         PRODUCTS.PRICEBUY,         PRODUCTS.PRICESELL,         SUM(TICKETLINES.UNITS) AS SOLD_UNITS,         SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY) AS COST_VALUE,         SUM(TICKETLINES.UNITS * PRODUCTS.PRICESELL) AS EXPECTED_SALES_VALUE,         SUM(TICKETLINES.PRICE * TICKETLINES.UNITS) AS ACTUAL_SALES_VALUE,           SUM(TICKETLINES.UNITS * PRODUCTS.PRICESELL)         - SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY)            AS EXPECTED_PROFIT,         SUM(TICKETLINES.PRICE * TICKETLINES.UNITS) - SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY)            AS ACTUAL_PROFIT    FROM (TICKETLINES TICKETLINES         INNER JOIN RECEIPTS RECEIPTS             ON (TICKETLINES.TICKET = RECEIPTS.ID))         LEFT OUTER JOIN PRODUCTS PRODUCTS            ON (TICKETLINES.PRODUCT = PRODUCTS.ID)      GROUP BY TICKETLINES.PRODUCT      ORDER BY PRODUCTS.REFERENCE ASC";


        if ($stmt = $conn->prepare($query)) 
        {
            $stmt->execute();
            $stmt->bind_result($REFERENCE, $NAME, $PRICEBUY, $PRICESELL, $SOLD_UNITS, $COST_VALUE, $EXPECTED_SALES_VALUE, $ACTUAL_SALES_VALUE, $EXPECTED_PROFIT, $ACTUAL_PROFIT);
            while ($stmt->fetch()) 
            {
                    //printf("%s, %s, %s, %s, %s, %s, %s, %s, %s, %s\n", $REFERENCE, $NAME, $PRICEBUY, $PRICESELL, $SOLD_UNITS, $COST_VALUE, $EXPECTED_SALES_VALUE, $ACTUAL_SALES_VALUE, $EXPECTED_PROFIT, $ACTUAL_PROFIT);
                    echo "<tr>";
                    echo "<td>$REFERENCE</td>";
                    echo "<td>$NAME</td>";
                    echo "<td>$PRICEBUY</td>";
                    echo "<td>$PRICESELL</td>";
                    echo "<td>$SOLD_UNITS</td>";
                    echo "<td>$COST_VALUE</td>";
                    echo "<td>$EXPECTED_SALES_VALUE</td>";
                    echo "<td>$ACTUAL_SALES_VALUE</td>";
                    echo "<td>$EXPECTED_PROFIT</td>";
                    echo "<td>$ACTUAL_PROFIT</td>";
                    echo "</tr>";
            }
            $stmt->close();
        }

        finalizeOutputTable();
        mysqli_close($conn);
        $conn=null;
        $sql="";
    }   

function prepareOutputTableHeader()
{
            //echo "<div class="panel panel-default">';  
            //echo '<div class="row">';
            //echo '<div class="col-lg-2></div>';
            //echo '<div class="col-lg-8>';
            
            echo '<div class="table-responsive">';  
            echo '<center>';
            echo '<table class="table table-striped" style="width:100%;">';
            echo '<thead">';
            echo '<tr>';
            echo '<th>BARCODE</th>';
            echo '<th>ITEM</th>';
            echo '<th>RPICE BUY</th>';
            echo '<th>PRICE SELL</th>';
            echo '<th>SOLD QTY</th>';
            echo '<th>COST VALUE</th>';
            echo '<th>EXPECTED SALES VALUE</th>';
            echo '<th>ACTUAL SALES VALUE</th>';
            echo '<th>EXPECTED PROFIT</th>';
            echo '<th>ACTUAL PROFIT</th>';
            echo '</tr>';
            echo '</thead>';
}
function finalizeOutputTable()
{
    echo '<tr></tr>';
    echo '</tbody';
    echo '</table>';
    echo '</center>';
    //echo '</div>'; //col-lg-10
    //echo '<div class="col-lg-2></div>';
    //echo '</div>'; //row
}
?>