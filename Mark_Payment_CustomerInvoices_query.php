<?php
    
    include('dbconnect.php');

    function getPaymentStatus($thisTicket) {

        $conn = dbConn();

        $statusQuery = "select TicketID from cust_pay_status where TicketID=$thisTicket";

        $result = "<div id=\"div" . $thisTicket . "\" name=\"div" . $thisTicket . "\" ><a id=\"a$thisTicket\" name=\"a$thisTicket\" href=\"javascript:void(0);\" data-href=\"markinvoice.php?ticketid=$thisTicket&status=1\" title=\"Click to mark INV#$thisTicket as Paid\"><span class=\"label label-danger\" id=\"s$thisTicket\" name=\"s$thisTicket\">Not Paid</span></a></div>";

        //$result = "<span class=\"label label-danger\">Not Paid</span>";

        if ($stmt = $conn->prepare($statusQuery)) {

            $stmt->execute();
            $stmt->bind_result($tmpTicketID);
            while ($stmt->fetch()) {
                //$result = "<span class=\"label label-success\">Paid</span>";
                $result = "<div id=\"div" . $thisTicket . "\" name=\"div" . $thisTicket . "\" ><a id=\"a$thisTicket\" name=\"a$thisTicket\" href=\"javascript:void(0);\" data-href=\"markinvoice.php?ticketid=$thisTicket&status=0\" title=\"Click to mark INV#$thisTicket as NOT Paid\"><span class=\"label label-success\" id=\"s$thisTicket\" name=\"s$thisTicket\">Paid</span></a></div>";
            }
            $stmt->close();
        }

        return $result;
    }


    function refreshRecords() {

        
            echo '<div class="panel panel-default">';  
            echo '<table class="table table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>INVOICE</th>';
            echo '<th>CUSTOMER</th>';
            echo '<th class="text-center">INVOICE AMOUNT</th>';
            echo '<th class="text-center">INVOICE DATE</th>';
            echo '<th class="text-center">PAY STATUS</th>';
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
                        echo "<tr><td><a href=\"javascript:void(0);\" data-href=\"ticketdetails.php?ticketid=$TICKETID\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Click for INV#$TICKETID details\" data-title=\"$TICKETID\" class=\"openTicket\">$TICKETID</a></td>";
                        echo "<td>". $NAME ."</td>";
                        echo "<td class=\"text-center\">". number_format($INVAMOUNT,2,'.','') ."</td>";
                        echo "<td class=\"text-center\">". $INVDATE ."</td>";
                        //echo "<td class=\"text-center\"><div id=div" . $TICKETID . "><a href=\"#\" title=\"Click to mark INV#$TICKETID as Paid\">". getPaymentStatus($TICKETID) . "</a></div></td>";
                        echo "<td class=\"text-center\">" . getPaymentStatus($TICKETID) . "</td>";
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
            echo '<th class="text-center">INVOICE AMOUNT</th>';
            echo '<th class="text-center">INVOICE DATE</th>';
            echo '<th class="text-center">PAY STATUS</th>';
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
                    echo "<tr><td><a id=\"aval$TICKETID\" href=\"javascript:void(0);\" data-href=\"ticketdetails.php?ticketid=$TICKETID\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Click for INV#$TICKETID details\" data-title=\"$TICKETID\" class=\"openTicket\">$TICKETID</a></td>";
                    echo "<td>". $NAME ."</td>";
                    echo "<td class=\"text-center\">". number_format($INVAMOUNT,2,'.','') ."</td>";
                    echo "<td class=\"text-center\">". $INVDATE ."</td>";
                    //echo "<td class=\"text-center\"><div id=\"div" . $TICKETID . "\" name=\"div" . $TICKETID . "\" ><a id=\"a$TICKETID\" name=\"a$TICKETID\" href=\"javascript:void(0);\" data-href=\"markinvoice.php?ticketid=$TICKETID\" title=\"Click to mark INV#$TICKETID as Paid\">". getPaymentStatus($TICKETID) . "</a></div></td>";
                    echo "<td class=\"text-center\">" . getPaymentStatus($TICKETID) . "</td>";
                    echo "</tr>";
                    echo '</tbody';
                    $GRAND_TOTAL+=$INVAMOUNT;
                }

                echo '<tbody>';
                echo "<tr><td></td>";
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