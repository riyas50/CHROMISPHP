<?php
set_time_limit(300); //300 seconds, 5 minutes
include('dbconnect.php');
$itemname = "";


function profitTillDate()
    {
        prepareOutputTableHeader();
                
        $conn = dbConn();

        //$query = "SELECT PRODUCTS.REFERENCE,         PRODUCTS.NAME,         PRODUCTS.PRICEBUY,         PRODUCTS.PRICESELL,         SUM(TICKETLINES.UNITS) AS SOLD_UNITS,         SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY) AS COST_VALUE,         SUM(TICKETLINES.UNITS * PRODUCTS.PRICESELL) AS EXPECTED_SALES_VALUE,         SUM(TICKETLINES.PRICE * TICKETLINES.UNITS) AS ACTUAL_SALES_VALUE,           SUM(TICKETLINES.UNITS * PRODUCTS.PRICESELL)         - SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY)            AS EXPECTED_PROFIT,         SUM(TICKETLINES.PRICE * TICKETLINES.UNITS) - SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY)            AS ACTUAL_PROFIT    FROM (TICKETLINES TICKETLINES         INNER JOIN RECEIPTS RECEIPTS             ON (TICKETLINES.TICKET = RECEIPTS.ID))         LEFT OUTER JOIN PRODUCTS PRODUCTS            ON (TICKETLINES.PRODUCT = PRODUCTS.ID)      GROUP BY TICKETLINES.PRODUCT      ORDER BY PRODUCTS.REFERENCE ASC";
        //$query = "SELECT PRODUCTS.REFERENCE,         PRODUCTS.NAME,         PRODUCTS.PRICEBUY,         PRODUCTS.PRICESELL,         SUM(TICKETLINES.UNITS) AS SOLD_UNITS,         SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY) AS COST_VALUE,         SUM(TICKETLINES.UNITS * PRODUCTS.PRICESELL) AS EXPECTED_SALES_VALUE,         SUM(TICKETLINES.PRICE * TICKETLINES.UNITS) AS ACTUAL_SALES_VALUE,           SUM(TICKETLINES.UNITS * PRODUCTS.PRICESELL)         - SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY)            AS EXPECTED_PROFIT,         SUM(TICKETLINES.PRICE * TICKETLINES.UNITS) - SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY)            AS ACTUAL_PROFIT    FROM (TICKETLINES TICKETLINES         INNER JOIN RECEIPTS RECEIPTS             ON (TICKETLINES.TICKET = RECEIPTS.ID))         LEFT OUTER JOIN PRODUCTS PRODUCTS            ON (TICKETLINES.PRODUCT = PRODUCTS.ID)      GROUP BY TICKETLINES.PRODUCT      ORDER BY PRODUCTS.NAME ASC";
        //$query = "SELECT DATE_FORMAT(STOCKDIARY.DATENEW, \"%M/%Y\") AS TDATE, SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY) AS COST_VALUE,   SUM(TICKETLINES.UNITS * PRODUCTS.PRICESELL) AS EXPECTED_SALES_VALUE,   SUM(TICKETLINES.PRICE * TICKETLINES.UNITS) AS ACTUAL_SALES_VALUE,   SUM(TICKETLINES.UNITS * PRODUCTS.PRICESELL)   - SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY) AS EXPECTED_PROFIT,   SUM(TICKETLINES.PRICE * TICKETLINES.UNITS) - SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY) AS ACTUAL_PROFIT FROM (TICKETLINES TICKETLINES   INNER JOIN RECEIPTS RECEIPTS     ON (TICKETLINES.TICKET = RECEIPTS.ID)   INNER JOIN PRODUCTS PRODUCTS     ON (TICKETLINES.PRODUCT = PRODUCTS.ID)   INNER JOIN STOCKDIARY STOCKDIARY     ON (STOCKDIARY.PRODUCT = PRODUCTS.ID)     AND STOCKDIARY.DATENEW = RECEIPTS.DATENEW) GROUP BY DATE_FORMAT(STOCKDIARY.DATENEW,\"%M/%Y\") ORDER BY TDATE, PRODUCTS.NAME ASC";        
        $query = "SELECT * FROM view_profit_till_date_monthly;";        

        if ($stmt = $conn->prepare($query)) 
        {
            $stmt->execute();
            $stmt->bind_result($TDATE, $COST_VALUE, $EXPECTED_SALES_VALUE, $ACTUAL_SALES_VALUE, $EXPECTED_PROFIT, $ACTUAL_PROFIT);
            
            $GRAND_TOTAL_EXPECTED_SALES=0;
            $GRAND_TOTAL_EXPECTED_PROFIT=0;
            $GRAND_TOTAL_SALES=0;
            $GRAND_TOTAL_COST=0;
            $GRAND_TOTAL_PROFIT=0;

            while ($stmt->fetch()) 
            {
                    //printf("%s, %s, %s, %s, %s, %s, %s, %s, %s, %s\n", $REFERENCE, $NAME, $PRICEBUY, $PRICESELL, $SOLD_UNITS, $COST_VALUE, $EXPECTED_SALES_VALUE, $ACTUAL_SALES_VALUE, $EXPECTED_PROFIT, $ACTUAL_PROFIT);
                    echo "<tr>";
                    echo "<td>$REFERENCE</td>";
                    echo "<td>$NAME</td>";
                    echo "<td align=\"right\">" . number_format($PRICEBUY,2,'.',',') . "</td>";
                    echo "<td align=\"right\">" . number_format($PRICESELL,2,'.',',') . "</td>";
                    echo "<td align=\"center\">" . $SOLD_UNITS . "</td>";
                    echo "<td align=\"right\">" . number_format($COST_VALUE,2,'.',',') . "</td>";
                    //echo "<td align=\"right\">" . number_format($EXPECTED_SALES_VALUE,2,'.','') . "</td>";
                    echo "<td align=\"right\">" . number_format($ACTUAL_SALES_VALUE,2,'.',',') . "</td>";
                    //echo "<td align=\"right\">" . number_format($EXPECTED_PROFIT,2,'.','') . "</td>";
                    //$EXPECTED_PROFIT-=25;
                    if ($ACTUAL_PROFIT<0)
                        {
                            echo "<td align=\"right\" bgcolor=\"#f4511e\">" . number_format($ACTUAL_PROFIT,2,'.',',') . "</td>";
                        }
                    else
                        {
                            echo "<td align=\"right\">" . number_format($ACTUAL_PROFIT,2,'.',',') . "</td>";
                        }

                        $MARGIN_RATIO = (($ACTUAL_PROFIT / $ACTUAL_SALES_VALUE) * 100); // % OF MARGIN CALCULATION

                        if ($MARGIN_RATIO<0)
                            {
                                echo "<td align=\"right\" bgcolor=\"#f4511e\"><text class=\"text-danger\"><span class=\"glyphicon glyphicon-arrow-down\" aria-hidden=\"true\"></span></text>"
                                . number_format($MARGIN_RATIO,2,'.','') . "%</td>";
                            }
                        else
                            {
                                echo "<td align=\"right\"><text class=\"text-success\"><span class=\"glyphicon glyphicon-arrow-up\" aria-hidden=\"true\"></span></text>"
                                . number_format($MARGIN_RATIO,2,'.','') . "%</td>";
                            }                        
                    
                    echo "</tr>";
                    $GRAND_TOTAL_EXPECTED_SALES+=$EXPECTED_SALES_VALUE;
                    $GRAND_TOTAL_EXPECTED_PROFIT+=$EXPECTED_PROFIT;
                    $GRAND_TOTAL_COST+=$COST_VALUE;
                    $GRAND_TOTAL_SALES+=$ACTUAL_SALES_VALUE;
                    $GRAND_TOTAL_PROFIT+=$ACTUAL_PROFIT;
            }
            $stmt->close();
        }
        
        $GRAND_TOTAL_EXPECTED_SALES = number_format($GRAND_TOTAL_EXPECTED_SALES,2,'.',',');
        $GRAND_TOTAL_EXPECTED_PROFIT = number_format($GRAND_TOTAL_EXPECTED_PROFIT,2,'.',',');
        $GRAND_TOTAL_COST = number_format($GRAND_TOTAL_COST,2,'.',',');
        $GRAND_TOTAL_SALES = number_format($GRAND_TOTAL_SALES,2,'.',',');
        $GRAND_TOTAL_PROFIT = number_format($GRAND_TOTAL_PROFIT,2,'.',',');
        //The below echo for grand total line.
        echo "<tr>";
        echo "<td align=\"right\"></td>"; //$REFERENCE
        echo "<td align=\"right\"></td>"; //$NAME 
        echo "<td align=\"right\"></td>"; //$PRICEBUY
        echo "<td align=\"right\"></td>"; //$PRICESELL
        echo "<td align=\"center\"></td>"; //$SOLD_UNITS
        echo "<td align=\"right\" bgcolor=\"#32cb00\"><font color=\"white\"><b>" . number_format($GRAND_TOTAL_COST,2) . "</b></font></td>"; //$COST_VALUE
        //echo "<td align=\"right\" bgcolor=\"#fbc02d\"><font color=\"white\"><b>" . $GRAND_TOTAL_EXPECTED_SALES</b></font></td>"; //$EXPECTED_SALES_VALUE
        echo "<td align=\"right\" bgcolor=\"#32cb00\"><font color=\"white\"><b>" . number_format($GRAND_TOTAL_SALES,2) . "</b></font></td>"; //$ACTUAL_SALES_VALUE
        //echo "<td align=\"right\" bgcolor=\"#fbc02d\"><font color=\"white\"><b>" . $GRAND_TOTAL_EXPECTED_PROFIT</b></font></td>"; //$EXPECTED_PROFIT
        echo "<td align=\"right\" bgcolor=\"#32cb00\"><font color=\"white\"><b>" . number_format($GRAND_TOTAL_PROFIT,2) . "</b></font></td>"; //$ACTUAL_PROFIT
        echo "</tr>";
        //$GRAND_TOTAL_COST+=$COST_VALUE;
        //$GRAND_TOTAL_SALES+=$ACTUAL_SALES_VALUE;
        //$GRAND_TOTAL_PROFIT+=$ACTUAL_PROFIT;

        finalizeOutputTable();
        mysqli_close($conn);
        $conn=null;
        $sql="";
    }   
function profitDateFilter($thisDate1,$thisDate2)
    {
        prepareOutputTableDateHeader();
                
        $conn = dbConn();

        //$query = "SELECT PRODUCTS.REFERENCE,         PRODUCTS.NAME,         PRODUCTS.PRICEBUY,         PRODUCTS.PRICESELL,         SUM(TICKETLINES.UNITS) AS SOLD_UNITS,         SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY) AS COST_VALUE,         SUM(TICKETLINES.UNITS * PRODUCTS.PRICESELL) AS EXPECTED_SALES_VALUE,         SUM(TICKETLINES.PRICE * TICKETLINES.UNITS) AS ACTUAL_SALES_VALUE,           SUM(TICKETLINES.UNITS * PRODUCTS.PRICESELL)         - SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY)            AS EXPECTED_PROFIT,         SUM(TICKETLINES.PRICE * TICKETLINES.UNITS) - SUM(TICKETLINES.UNITS * PRODUCTS.PRICEBUY)            AS ACTUAL_PROFIT    FROM (TICKETLINES TICKETLINES         INNER JOIN RECEIPTS RECEIPTS             ON (TICKETLINES.TICKET = RECEIPTS.ID))         LEFT OUTER JOIN PRODUCTS PRODUCTS            ON (TICKETLINES.PRODUCT = PRODUCTS.ID)      GROUP BY TICKETLINES.PRODUCT      ORDER BY PRODUCTS.REFERENCE ASC";
        if ($thisDate1 == '' && $thisDate2 == ''){
            $query = "call SALESPROFITMONTHLY(NULL,NULL)";}
        if ($thisDate1 != '' && $thisDate2 == ''){
            $query = "call SALESPROFITMONTHLY('" . $thisDate1 . "',NULL)";}
        if ($thisDate1 != '' && $thisDate2 != ''){
        $query = "call SALESPROFITMONTHLY('" . $thisDate1 . "','" . $thisDate2 . "')";}


        if ($stmt = $conn->prepare($query)) 
        {
            $stmt->execute();
            $stmt->bind_result($TDATE, $COST_VALUE, $EXPECTED_SALES_VALUE, $ACTUAL_SALES_VALUE, $EXPECTED_PROFIT, $ACTUAL_PROFIT);
            
            $GRAND_TOTAL_EXPECTED_SALES=0;
            $GRAND_TOTAL_EXPECTED_PROFIT=0;
            $GRAND_TOTAL_SALES=0;
            $GRAND_TOTAL_COST=0;
            $GRAND_TOTAL_PROFIT=0;

            while ($stmt->fetch()) 
            {
                    echo "<tr>";
                    echo "<td>$TDATE</td>";
                    echo "<td align=\"right\">" . number_format($COST_VALUE,2,'.',',') . "</td>";
                    //echo "<td align=\"right\">" . number_format($EXPECTED_SALES_VALUE,2,'.','') . "</td>";
                    echo "<td align=\"right\">" . number_format($ACTUAL_SALES_VALUE,2,'.',',') . "</td>";
                    //echo "<td align=\"right\">" . number_format($EXPECTED_PROFIT,2,'.','') . "</td>";
                    //$ACTUAL_PROFIT = -1;
                    if ($ACTUAL_PROFIT<0)
                        {
                            echo "<td align=\"right\" bgcolor=\"#f4511e\">" . number_format($ACTUAL_PROFIT,2,'.',',') . "</td>";
                        }
                    else
                        {
                            echo "<td align=\"right\">" . number_format($ACTUAL_PROFIT,2,'.',',') . "</td>";
                        }
                    
                    $MARGIN_RATIO = (($ACTUAL_PROFIT / $ACTUAL_SALES_VALUE) * 100); // % OF MARGIN CALCULATION

                    if ($MARGIN_RATIO<0)
                        {
                            echo "<td align=\"right\" bgcolor=\"#f4511e\"><text class=\"text-danger\"><span class=\"glyphicon glyphicon-arrow-down\" aria-hidden=\"true\"></span></text>" 
                            . number_format($MARGIN_RATIO,2,'.','') . "%</td>";
                        }
                    else
                        {
                            echo "<td align=\"right\"><text class=\"text-success\"><span class=\"glyphicon glyphicon-arrow-up\" aria-hidden=\"true\"></span></text>" . number_format($MARGIN_RATIO,2,'.','') 
                            . "%</td>";
                        }
                    
                    echo "</tr>";
                    $GRAND_TOTAL_EXPECTED_SALES+=$EXPECTED_SALES_VALUE;
                    $GRAND_TOTAL_EXPECTED_PROFIT+=$EXPECTED_PROFIT;
                    $GRAND_TOTAL_COST+=$COST_VALUE;
                    $GRAND_TOTAL_SALES+=$ACTUAL_SALES_VALUE;
                    $GRAND_TOTAL_PROFIT+=$ACTUAL_PROFIT;
            }
            $stmt->close();
        }
        
        $GRAND_TOTAL_EXPECTED_SALES = number_format($GRAND_TOTAL_EXPECTED_SALES,2,'.','');
        $GRAND_TOTAL_EXPECTED_PROFIT = number_format($GRAND_TOTAL_EXPECTED_PROFIT,2,'.','');
        $GRAND_TOTAL_COST = number_format($GRAND_TOTAL_COST,2,'.','');
        $GRAND_TOTAL_SALES = number_format($GRAND_TOTAL_SALES,2,'.','');
        $GRAND_TOTAL_PROFIT = number_format($GRAND_TOTAL_PROFIT,2,'.','');
        //The below echo for grand total line.
        echo "<tr>";
        //echo "<td align=\"right\"></td>"; //$REFERENCE
        //echo "<td align=\"right\"></td>"; //$NAME 
        echo "<td align=\"right\"></td>"; //$TDATE 
        //echo "<td align=\"right\"></td>"; //$TTIME 
        //echo "<td align=\"right\"></td>"; //$PRICEBUY
        //echo "<td align=\"right\"></td>"; //$PRICESELL
        //echo "<td align=\"center\"></td>"; //$SOLD_UNITS
        echo "<td align=\"right\" bgcolor=\"#32cb00\"><font color=\"white\"><b>" . number_format($GRAND_TOTAL_COST,2) . "</b></font></td>"; //$COST_VALUE
        //echo "<td align=\"right\" bgcolor=\"#fbc02d\"><font color=\"white\"><b>$GRAND_TOTAL_EXPECTED_SALES</b></font></td>"; //$EXPECTED_SALES_VALUE
        echo "<td align=\"right\" bgcolor=\"#32cb00\"><font color=\"white\"><b>" . number_format($GRAND_TOTAL_SALES,2) . "</b></font></td>"; //$ACTUAL_SALES_VALUE
        //echo "<td align=\"right\" bgcolor=\"#fbc02d\"><font color=\"white\"><b>$GRAND_TOTAL_EXPECTED_PROFIT</b></font></td>"; //$EXPECTED_PROFIT
        echo "<td align=\"right\" bgcolor=\"#32cb00\"><font color=\"white\"><b>" . number_format($GRAND_TOTAL_PROFIT,2) . "</b></font></td>"; //$ACTUAL_PROFIT
        echo "</tr>";
        //$GRAND_TOTAL_COST+=$COST_VALUE;
        //$GRAND_TOTAL_SALES+=$ACTUAL_SALES_VALUE;
        //$GRAND_TOTAL_PROFIT+=$ACTUAL_PROFIT;

        finalizeOutputTable();
        mysqli_close($conn);
        $conn=null;
        $sql="";
    }   

function prepareOutputTableHeader()
    {
                echo "<div class=\"table-responsive\">";  
                echo '<table class="table table-striped table-bordered" style="width:100%;">';
                echo '<thead>';
                echo '<tr>';
                echo '<th align=\"left\">DATE</th>';                
                echo '<th class="text-right">COST VALUE</th>';
                //echo '<th class="text-right">EXPECTED <br /> SALES VALUE</th>';
                echo '<th class="text-right">ACTUAL SALES VALUE</th>';
                //echo '<th class="text-right">EXPECTED <br /> PROFIT</th>';
                echo '<th class="text-right">ACTUAL PROFIT</th>';
                echo '<th class="text-right">MARGIN RATIO</th>';
                echo '</tr>';
                echo '</thead>';
    }
function prepareOutputTableDateHeader()
    {                
                echo "<div class=\"table-responsive\">";  
                echo '<table class="table table-striped table-bordered" style="width:100%;">';
                echo '<thead>';
                echo '<tr>';
                echo '<th align=\"left\">DATE</th>';
                echo '<th class="text-right">COST VALUE</th>';
                //echo '<th class="text-right">EXPECTED <br /> SALES VALUE</th>';
                echo '<th class="text-right">ACTUAL SALES VALUE</th>';
                //echo '<th class="text-right">EXPECTED <br /> PROFIT</th>';
                echo '<th class="text-right">ACTUAL PROFIT</th>';
                echo '<th class="text-right">MARGIN RATIO</th>';
                echo '</tr>';
                echo '</thead>';
    }
function finalizeOutputTable()
    {
        echo '<tr></tr>';
        echo '</tbody';
        echo '</table>';
        //echo '</center>';
        //echo '</div>'; //col-lg-10
        //echo '<div class="col-lg-2></div>';
        //echo '</div>'; //row
    }
?>