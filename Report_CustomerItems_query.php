<?php
    set_time_limit(300); //300 seconds, 5 minutes
    include('dbconnect.php');
    
    function refreshRecords() {

        
            echo '<div class="panel panel-default">';  
            echo '<table class="table table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>INVOICE</th>';
            echo '<th>CUSTOMER</th>';
            echo '<th class="text-center">INVOICE AMOUNT</th>';
            echo '<th class="text-center">INVOICE DATE</th>';
            echo '<th class="text-center">PAY METHOD</th>';
            echo '</tr>';
            echo '</thead>';

            $conn = dbConn();
        //========================================================================================================
        //below code generated with workbench plugin for php under tools > utilities
        $query = "select * from view_customer_item_search where NAME LIKE \"%%\" AND PRODUCT LIKE \"%%\"; ";


        if ($stmt = $conn->prepare($query)) {
            $stmt->execute();
            $stmt->bind_result($TICKETID, $NAME, $INVAMOUNT, $INVDATE, $PAYMETHOD);
            $GRAND_TOTAL = 0;
            while ($stmt->fetch()) {
                //printf("%s, %s, %s, %s, %s, %s, %s, %s\n", $CODE, $REFERENCE, $NAME, $PRICESELL, $PRICEBUY, $NAME1, $UNITS, $NAME3);
                        echo '<tbody>';
                        echo "<tr><td><a href=\"javascript:void(0);\" data-href=\"ticketdetails.php?ticketid=$TICKETID\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Click for INV#$TICKETID details\" data-title=\"$TICKETID\" class=\"openTicket\">$TICKETID</a></td>";
                        echo "<td>". $NAME ."</td>";
                        echo "<td class=\"text-center\">". number_format($INVAMOUNT,2,'.','') ."</td>";
                        echo "<td class=\"text-center\">". $INVDATE ."</td>";
                        echo "<td class=\"text-center\">". $PAYMETHOD ."</td>";
                        echo "</tr>";
                        echo '</tbody';
                        $GRAND_TOTAL+=$INVAMOUNT;
            }
            $stmt->close();
        }
        echo '<tbody>';
        echo "<tr><td></td>";
        echo "<td></td>";
        //echo "<td align=\"right\" bgcolor=\"#32cb00\"><font color=\"white\"><b>$GRAND_TOTAL_COST</b></font></td>";
        echo "<td align=\"right\" bgcolor=\"#32cb00\"><font color=\"white\"><b>". number_format($GRAND_TOTAL,2,'.','') ."</b></font></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "</tr>";
        echo '</tbody';
        //========================================================================================================
             echo '</table>';
             echo '</div>';   
           
            mysqli_close($conn);
            $conn=null;
            $sql="";
        } 
        //function refreshrecords()

function filterRecords($CUSTNAME,$PRODUCT) 
    {
            echo '<div class="panel panel-default">';  
            echo '<table class="table table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>INVOICE</th>';
            echo '<th>CUSTOMER</th>';
            echo '<th>PRODUCT</th>';
            echo '<th>QTY</th>';
            echo '<th class="text-center">UNIT PRICE</th>';
            echo '<th class="text-center">ITEM TOTAL</th>';
            echo '<th class="text-center">INVOICE DATE</th>';
            echo '<th class="text-center">INV. TOTAL</th>';
            echo '</tr>';
            echo '</thead>';

            $conn = dbConn();
        //========================================================================================================
        //below code generated with workbench plugin for php under tools > utilities
        $query = "select * from view_customer_item_search where NAME LIKE \"%$CUSTNAME%\" AND PRODUCT LIKE \"%$PRODUCT%\"; ";


                if ($stmt = $conn->prepare($query)) {
                $stmt->execute();
                $stmt->bind_result($TICKETID,$CUSTOMER,$PRODUCT,$QTY,$UNITPRICE,$TOTAL,$INVDATE, $INVAMOUNT);

                echo '<tbody>';
                $noRecord=false;
                $GRAND_TOTAL = 0;
                while ($stmt->fetch()) {
                    $noRecord = true;
                    echo '<tbody>';
                    echo "<tr><td><a href=\"javascript:void(0);\" data-href=\"ticketdetails.php?ticketid=$TICKETID\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Click for INV#$TICKETID details\" data-title=\"$TICKETID\" class=\"openTicket\">$TICKETID</a></td>";
                    echo "<td>". $CUSTOMER ."</td>";
                    echo "<td>". $PRODUCT ."</td>";
                    echo "<td class=\"text-center\">". $QTY ."</td>";
                    echo "<td class=\"text-center\">". number_format($UNITPRICE,2,'.','') ."</td>";
                    echo "<td class=\"text-center\">". number_format($TOTAL,2,'.','') ."</td>";
                    echo "<td class=\"text-center\">". $INVDATE ."</td>";
                    echo "<td class=\"text-center\">". number_format($INVAMOUNT,2,'.','') ."</td>";
                    echo "</tr>";
                    echo '</tbody';
                    $GRAND_TOTAL+=$TOTAL;
                }

                echo '<tbody>';
                echo "<tr><td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                //echo "<td align=\"right\" bgcolor=\"#32cb00\"><font color=\"white\"><b>$GRAND_TOTAL_COST</b></font></td>";
                echo "<td  class=\"text-center\" bgcolor=\"#32cb00\"><font color=\"white\"><b>". number_format($GRAND_TOTAL,2,'.','') ."</b></font></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "</tr>";
                echo '</tbody';

                if ($noRecord == false)
                {
                    echo "<tr><td class='bg-info text-center' colspan='8'>No records found!</td></tr>";
                }
                    echo '</table>';
                    echo '</div>';   
                $stmt->close();
            }
    }
    
    function putEmptyRow()
    {
        echo '<div class="panel panel-default">';  
        echo '<table class="table table-striped">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>BARCODE</th>';
        echo '<th>REFERENCE</th>';
        echo '<th>ITEM</th>';
        echo '<th>PRICE</th>';
        echo '<th>COST</th>';
        echo '<th>CATEGORY</th>';
        echo '<th>STOCK</th>';
        echo '<th>TAX TYPE</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        echo "<tr><td class='bg-info text-center' colspan='8'></td></tr>";
        echo '</tbody';
        echo '</table>';
        echo '</div>';  
    }
?>