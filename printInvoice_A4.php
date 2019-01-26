<?php

include('dbconnect.php');

//printA4();

function printA4()
{
    if (!empty($_GET['ticketid'])) {
        $conn = dbConn();

        $query = "select * from view_all_ticketlines where ticketid = {$_GET['ticketid']}";
    
    
        if ($stmt = $conn->prepare($query)) {
            $stmt->execute();
            $stmt->bind_result($TICKETID, $PRODUCT, $LINEITEM, $QTY, $UNITPRICE, $TOTAL);
        
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
                <td class=\"text-center\">" . number_format($UNITPRICE, 2, '.', '') . "</td>
                <td class=\"text-right\">" . number_format($TOTAL, 2, '.', '') . "</td>
            </tr>";
                $GRAND_TOTAL+=$TOTAL;
            }
            $stmt->close();

            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td align=\"right\" bgcolor=\"#32cb00\"><font color=\"white\"><b>". number_format($GRAND_TOTAL, 2, '.', '') ."</b></font></td>";
            echo "</tbody></table>";
        }
    }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Print Invoice</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
	<link rel='stylesheet' type='text/css' href="./css/style.css" />
    <link rel='stylesheet' type='text/css' href="./css/print.css" media="print" />
    <script src="./js/jquery.min.js"></script>
    <!-- <script src="./js/example.js"></script> -->

</head>

<body>

	<div id="page-wrap">

		<textarea id="header">INVOICE</textarea>
		
		<div id="identity">
		
            <textarea id="address">
Thozhilali Multipurpose 
co operative building, 
Paliyam Road, 
Chendamangalam Junction,  
North Paravur, 
Kerala 683513</textarea>

            <div id="logo">
              <img id="grandlogo" src="./images/grandlogohalf.png" alt="logo" />
            </div>
		
		</div>
		
		<div style="clear:both"></div>
		
		<div id="customer">

            <textarea id="customer-title"><?php echo $_GET['cust']; ?></textarea>

            <table id="meta">
                <tr>
                    <td class="meta-head">Invoice #</td>
                    <td><textarea><?php echo $_GET['ticketid'];?></textarea></td>
                </tr>
                <tr>

                    <td class="meta-head">Date</td>
                    <td><textarea id="date"><?php echo $_GET['invdt'];?></textarea></td>
                </tr>
                <tr>
                    <td class="meta-head">Amount Due</td>
                    <td><div class="due">₹ <?php echo number_format($_GET['tot'],2,'.',''); ?></div></td>
                </tr>

            </table>
		
		</div>
		
		<table id="items">
		
		  <tr>
		      <th>SR#</th>
		      <th>Item</th>
		      <th>Description</th>
		      <th>Unit Cost</th>
		      <th>Quantity</th>
		      <th>Price</th>
		  </tr>
		  
		  <tr class="item-row">
              <td class="qtycnt">1</td>
		      <td class="item-name">Web Updates</div></td>
		      <td class="description">Monthly web updates for http://widgetcorp.com (Nov. 1 - Nov. 30, 2009)</td>
		      <td class="amtcnt">₹ 650.00</td>
		      <td class="qtycnt">1</td>
		      <td class="amtrgt"><span class="price">₹ 650.00</span></td>
		  </tr>
		  		  
		  
		  <tr>
              <td class="blank"></td>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Subtotal</td>
		      <td class="total-value amtrgt"><div id="subtotal">₹ <?php echo number_format($_GET['tot'],2,'.',''); ?></div></td>
		  </tr>
		  <tr>
              <td class="blank"></td>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Total</td>
		      <td class="total-value amtrgt"><div id="total">₹ <?php echo number_format($_GET['tot'],2,'.',''); ?></div></td>
		  </tr>
<!-- 		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Amount Paid</td>

		      <td class="total-value"><textarea id="paid">₹ 0.00</textarea></td>
		  </tr> -->
		  <tr>
              <td class="blank"></td>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line balance">Balance Due</td>
		      <td class="total-value balance amtrgt"><div class="due">₹ <?php echo number_format($_GET['tot'],2,'.',''); ?></div></td>
		  </tr>
		
		</table>
		
		<div id="terms">
		  <h5></h5>
		  phone: 24425128 <br>
		  Thozhilali Multipurpose co operative building | Paliyam Road | Chendamangalam Junction | North Paravur | Kerala | 683513
          <h5></h5>
        </div>
	
	</div>
	
</body>

</html>