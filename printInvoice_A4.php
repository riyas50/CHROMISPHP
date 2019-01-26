<?php

include('dbconnect.php');
//include('invoicedetails.php');

//printA4();

function printA4()
{
    if(!empty($_GET['ticketid'])){
        $conn = dbConn();
    
        $query = "select * from view_all_ticketlines_v2 where ticketid = {$_GET['ticketid']}";
        
        
        if ($stmt = $conn->prepare($query)) {
            $stmt->execute();
            $stmt->bind_result($TICKETID, $PCODE, $PRODUCT,$LINEITEM,$QTY,$UNITPRICE,$TOTAL);
    
            while ($stmt->fetch()) {
                $unit = number_format($UNITPRICE,2,'.','');
                $linetot = number_format($TOTAL,2,'.','');
                echo "
                <tr class=\"item-row\">
                <td class=\"qtycnt\">$LINEITEM</td>
                <td class=\"item-name\">$PCODE</div></td>
                <td class=\"description\">$PRODUCT</td>
                <td class=\"amtcnt\">₹ $unit</td>
                <td class=\"qtycnt\">$QTY</td>
                <td class=\"amtrgt\"><span class=\"price\">₹ $linetot</span></td>
            </tr>";
            }
            $stmt->close();
        }
    }

}

function getIndianCurrency($number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => 'zero', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    //$paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    $paise = $words[$decimal] . ' Paise';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise . " Only";
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
    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet"> -->
<!--     <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Allerta+Stencil" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet"> -->
    <script src="./js/jquery.min.js"></script>
    <!-- <script src="./js/example.js"></script> -->

</head>

<body>

	<div id="page-wrap">

		<h3 class="text-capitalize text-center entheading">GRAND STATIONERY</h3>
		<h6 class="text-center">
            <em>learn smart... work smart...</em>
        </h6>
        <h4 class="text-center">Retail & Wholesale</h4>
        <h5 class="text-center"><span class="glyphicon glyphicon-map-marker text-warning"></span> Chendamangalam Junction | North Paravur | <span class="glyphicon glyphicon-phone-alt text-warning"></span> 8592 84 00 46 | <span class="glyphicon glyphicon-envelope text-warning"></span> sales@grandstationery.in</h5>
        <hr>
        <h3 class="text-capitalize text-center">INVOICE</h3>
        

<!-- 		<div id="identity">
		
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
		
		</div> -->
		
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
                    <td class="meta-head">LPO#</td>
                    <td><textarea>NA</textarea></td>
                </tr>
<!--                 <tr>
                    <td class="meta-head">LPO#</td>
                    <td><div class="due">₹ <?php echo number_format($_GET['tot'],2,'.',''); ?></div></td>
                </tr> -->

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
		  
          <?php printA4(); ?>
	
<!-- 		  <tr>
              <td class="blank"></td>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Subtotal</td>
		      <td class="total-value amtrgt"><div id="subtotal">₹ <?php //echo number_format($_GET['tot'],2,'.',''); ?></div></td>
		  </tr> -->
		  <tr>
              <td class="blank"></td>
		      <td colspan="2" class="blank"></td>
		      <!-- <td colspan="3" class="text-capitalize amt2word"><?php //echo getIndianCurrency((float)$_GET['tot']); ?></td> -->
		      <td colspan="2" class="total-line">Total</td>
		      <td class="total-value amtrgt"><div id="total">₹ <?php echo number_format($_GET['tot'],2,'.',''); ?></div></td>
		  </tr>
<!-- 		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Amount Paid</td>

		      <td class="total-value"><textarea id="paid">₹ 0.00</textarea></td>
		  </tr> -->
<!-- 		  <tr>
              <td class="blank"></td>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line balance">Balance Due</td>
		      <td class="total-value balance amtrgt"><div class="due">₹ <?php //echo number_format($_GET['tot'],2,'.',''); ?></div></td>
		  </tr> -->
		
		</table>
		<br>
        <div class="row">
            
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <br>
                <p class="text text-left">Customer Signature</p>                
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <br>
                <p class="text text-right">For Grand Stationery</p>
            </div>
            <hr>
        </div>
<!-- 		<div id="terms">
		  <h5></h5>
		  phone: 24425128 <br>
		  Thozhilali Multipurpose co operative building | Paliyam Road | Chendamangalam Junction | North Paravur | Kerala | 683513
          <h5></h5>
        </div> -->
	
	</div>
	
</body>

</html>