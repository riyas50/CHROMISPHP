<?php
    
    include('dbconnect.php');
    function refreshRecords() {

        
            echo '<div class="panel panel-default">';  
            echo '<table class="table table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>INVOICE</th>';
            echo '<th>CUSTOMER</th>';
            echo '<th>INVOICE AMOUNT</th>';
            echo '<th>INVOICE DATE</th>';
            echo '<th>PAY METHOD</th>';
            echo '</tr>';
            echo '</thead>';

            $conn = dbConn();
        //========================================================================================================
        //below code generated with workbench plugin for php under tools > utilities
        $query = "select * FROM view_all_invoices";


        if ($stmt = $conn->prepare($query)) {
            $stmt->execute();
            $stmt->bind_result($TICKETID, $NAME, $INVAMOUNT, $INVDATE, $PAYMETHOD);
            $GRAND_TOTAL = 0;
            while ($stmt->fetch()) {
                //printf("%s, %s, %s, %s, %s, %s, %s, %s\n", $CODE, $REFERENCE, $NAME, $PRICESELL, $PRICEBUY, $NAME1, $UNITS, $NAME3);
                        echo '<tbody>';
                        echo "<tr><td>". $TICKETID ."</td>";
                        echo "<td>". $NAME ."</td>";
                        echo "<td align=\"left\">". number_format($INVAMOUNT,2,'.','') ."</td>";
                        echo "<td>". $INVDATE ."</td>";
                        echo "<td>". $PAYMETHOD ."</td>";
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

function filterRecords($CUSTNAME,$INVNO) 
    {
            echo '<div class="panel panel-default">';  
            echo '<table class="table table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>INVOICE</th>';
            echo '<th>CUSTOMER</th>';
            echo '<th>INVOICE AMOUNT</th>';
            echo '<th>INVOICE DATE</th>';
            echo '<th>PAY METHOD</th>';
            echo '</tr>';
            echo '</thead>';

            $conn = dbConn();
        //========================================================================================================
        //below code generated with workbench plugin for php under tools > utilities
                $query = "select * FROM view_all_invoices where name like '%$CUSTNAME%' AND TICKETID like '%$INVNO%'";


                if ($stmt = $conn->prepare($query)) {
                $stmt->execute();
                $stmt->bind_result($TICKETID, $NAME, $INVAMOUNT, $INVDATE, $PAYMETHOD);

                echo '<tbody>';
                $noRecord=false;
                $GRAND_TOTAL = 0;
                while ($stmt->fetch()) {
                    //printf("%s, %s, %s, %s, %s, %s, %s, %s\n", $CODE, $REFERENCE, $NAME, $PRICESELL, $PRICEBUY, $NAME1, $UNITS, $NAME3);
                    $noRecord = true;
                    echo '<tbody>';
                    echo "<tr><td><a href=\"#\">". $TICKETID ."</td>";
                    echo "<td>". $NAME ."</td>";
                    echo "<td align=\"left\">". number_format($INVAMOUNT,2,'.','') ."</td>";
                    echo "<td>". $INVDATE ."</td>";
                    echo "<td>". $PAYMETHOD ."</td>";
                    echo "</tr>";
                    echo '</tbody';
                    $GRAND_TOTAL+=$INVAMOUNT;
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