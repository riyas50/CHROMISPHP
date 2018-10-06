<?php
//session_start();

include_once('dbconnect.php');

//$thispaystsquery ="";

//echo getPaidandDueTotals();

function getPaidandDueTotals(){
    $conn = dbConn();
    //========================================================================================================
    //below code generated with workbench plugin for php under tools > utilities
    
    $query = $_SESSION["thispaystsquery"];
                        
    $paystatus = 0;

    $GRAND_TOTAL = 0;
    $DUE_TOTAL = 0;
    $PAID_TOTAL = 0;

    if ($stmt = $conn->prepare($query)) {
        $stmt->execute();
        $stmt->bind_result($TICKETID, $NAME, $INVAMOUNT, $INVDATE, $PAYMETHOD);

        $noRecord=false;

            
        while ($stmt->fetch()) {
            $paystatus = getPaymentStatus($TICKETID);
            $noRecord = true;

            if ($paystatus == 0) {
                $DUE_TOTAL+=$INVAMOUNT;
            } else {
                $PAID_TOTAL+=$INVAMOUNT;
            }
        }
        $stmt->close();
    }

    return $DUE_TOTAL;
}


function test(){
    return 1234;
}

function getPaymentStatus($thisTicket){
    $con = dbConn();

    $statusQuery = "select TicketID from cust_pay_status where TicketID=$thisTicket";

    $status = 0;

    //$result = "<span class=\"label label-danger\">Not Paid</span>";

    if ($stmt = $con->prepare($statusQuery)) {
        $stmt->execute();
        $stmt->bind_result($tmpTicketID);
        while ($stmt->fetch()) {
            //$result = "<span class=\"label label-success\">Paid</span>";
            $status = 1;
        }
        $stmt->close();
    }


    return $status;
}
