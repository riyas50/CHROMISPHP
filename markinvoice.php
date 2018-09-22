<?php

include('dbconnect.php');

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

 echo getNewPaymentStatus($thisTicketID);


 function getNewPaymentStatus($thisTicket) {

    $conn = dbConn();

    $statusQuery = "select TicketID from cust_pay_status where TicketID=$thisTicket";

    $result = "<a id=\"a$thisTicket\" name=\"a$thisTicket\" href=\"javascript:void(0);\" data-href=\"markinvoice.php?ticketid=$thisTicket&status=1\" title=\"Click to mark INV#$thisTicket as Paid\"><span class=\"label label-danger\">Not Paid</span></a>";

    //$result = "<span class=\"label label-danger\">Not Paid</span>";

    if ($stmt = $conn->prepare($statusQuery)) {

        $stmt->execute();
        $stmt->bind_result($tmpTicketID);
        while ($stmt->fetch()) {
            //$result = "<span class=\"label label-success\">Paid</span>";
            $result = "<a id=\"a$thisTicket\" name=\"a$thisTicket\" href=\"javascript:void(0);\" data-href=\"markinvoice.php?ticketid=$thisTicket&status=0\" title=\"Click to mark INV#$thisTicket as NOT Paid\"><span class=\"label label-success\">Paid</span></a>";
        }
        $stmt->close();
    }

    return $result;
}
 ?>