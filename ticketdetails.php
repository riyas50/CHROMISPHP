<?php

include('dbconnect.php');

if(!empty($_GET['ticketid'])){
    $conn = dbConn();

    $query = "select * from view_all_ticketlines where ticketid = {$_GET['ticketid']}";
    
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->execute();
        $stmt->bind_result($TICKETID, $PRODUCT,$LINEITEM,$QTY,$UNITPRICE,$TOTAL);
        
        echo "
        <table class=\"table table-hover\">
            <thead>
                <tr>
                    <th class=\"text-center\">ITEM#</th>
                    <th>PRODUCT</th>
                    <th class=\"text-center\">QTY</th>
                    <th class=\"text-center\">UNIT PRICE</th>
                    <th class=\"text-right\">TOTAL</th>
                </tr>
            </thead>
            <tbody>";

        // echo "ITM#\tPRODUCT\tQTY\tUNITPRICE\tTOTAL\t";
        echo "<br>";
        $GRAND_TOTAL = 0;
        while ($stmt->fetch()) {
            echo "
            <tr>
                <td class=\"text-center\">$LINEITEM</td>
                <td>$PRODUCT</td>
                <td class=\"text-center\">$QTY</td>
                <td class=\"text-center\">" . number_format($UNITPRICE,2,'.','') . "</td>
                <td class=\"text-right\">" . number_format($TOTAL,2,'.','') . "</td>
            </tr>";
            $GRAND_TOTAL+=$TOTAL;
        }
        $stmt->close();

        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td align=\"right\" bgcolor=\"#32cb00\"><font color=\"white\"><b>". number_format($GRAND_TOTAL,2,'.','') ."</b></font></td>";
        echo "</tbody></table>";
    }
}

?>