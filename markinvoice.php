<?php

session_start();

include_once('dbconnect.php');
//include_once('paystsinclude.php');

$conn = dbconn();

$thisTicketID = $_GET['ticketid'];
$thisStatus = $_GET['status'];

$query = (1 == $thisStatus) ? 
    "INSERT INTO cust_pay_status (TicketID) VALUES ($thisTicketID) ON DUPLICATE KEY UPDATE TicketID = $thisTicketID;" : 
        "DELETE FROM cust_pay_status WHERE TicketID=$thisTicketID";

        if ($stmt = $conn->prepare($query)) {
            $stmt->execute();
            $stmt->close();
        }        

 //echo getNewPaymentStatus($thisTicketID);
 echo getNewPaymentStatus($thisTicketID);


 function getNewPaymentStatus($thisTicket) {

    $conn1 = dbConn();

    $result = array();

    $statusQuery = "select TicketID from cust_pay_status where TicketID=$thisTicket";

    $result['paystatus'] = "<a id=\"a$thisTicket\" name=\"a$thisTicket\" href=\"javascript:void(0);\" data-href=\"markinvoice.php?ticketid=$thisTicket&status=1\" title=\"Click to mark INV#$thisTicket as Paid\"><span class=\"label label-danger\">Not Paid</span></a>";

    //$result = "<span class=\"label label-danger\">Not Paid</span>";

    if ($stmt = $conn1->prepare($statusQuery)) {

        $stmt->execute();
        $stmt->bind_result($tmpTicketID);
        while ($stmt->fetch()) {
            //$result = "<span class=\"label label-success\">Paid</span>";
            $result['paystatus'] = "<a id=\"a$thisTicket\" name=\"a$thisTicket\" href=\"javascript:void(0);\" data-href=\"markinvoice.php?ticketid=$thisTicket&status=0\" title=\"Click to mark INV#$thisTicket as NOT Paid\"><span class=\"label label-success\">Paid</span></a>";
        }
        $stmt->close();
    }
    //$thisduetotpaidtot = array();
    $thisduepaid = getDuePaidInvoiceValue($thisTicket);
    $thisduetotpaidtot = getPaidandDueTotals($_SESSION['thispaystsquery']);    
    $result['due'] = number_format($thisduepaid['due'],2,'.','');
    $result['paid'] = number_format($thisduepaid['paid'],2,'.','');
    $result['duetot'] = "<font color=\"white\"><b>". number_format($thisduetotpaidtot['duetotal'],2,'.','') ."</b></font>";
    $result['paidtot'] = "<font color=\"white\"><b>". number_format($thisduetotpaidtot['paidtotal'],2,'.','') ."</b></font>";

    return json_encode($result);
}

function getDuePaidInvoiceValue($thisTicket){
    $conn4 = dbConn();
    $duepaidQuery = "select INVAMOUNT FROM view_all_invoices where TICKETID = $thisTicket";
    $DUE = 0;
    $PAID = 0;
    if ($stmt = $conn4->prepare($duepaidQuery)) {
        $stmt->execute();
        $stmt->bind_result($invioceValue);
        while ($stmt->fetch()) {
            $paystatus = getPaymentStatus($thisTicket);
            if ($paystatus == 0) {
                $DUE=$invioceValue;
            } else {
                $PAID=$invioceValue;
            }
        }
        $stmt->close();
    }
    $values[] = array();
    $values['due'] = $DUE;
    $values['paid'] = $PAID;
    return $values;    
}
 
function getPaymentStatus($thisTicket){
    $conn2 = dbConn();
    $statusQuery = "select TicketID from cust_pay_status where TicketID=$thisTicket";
    $status = 0;
    if ($stmt = $conn2->prepare($statusQuery)) {
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
 
function getPaidandDueTotals($thisQuery)
{
    $conn3 = dbConn();
    //========================================================================================================
    //below code generated with workbench plugin for php under tools > utilities
    
    $query = $thisQuery;

    //return $query;
    
                        
    $paystatus = 0;

    $output[] = array();

    $DUE_TOTAL = 0;
    $PAID_TOTAL = 0;

    if ($stmt = $conn3->prepare($query)) {
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
    
    $output['duetotal'] = $DUE_TOTAL;
    $output['paidtotal'] = $PAID_TOTAL;

    return $output;
}
 
 ?>