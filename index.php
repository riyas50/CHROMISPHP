<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
        include('general.php');
        putScripts();
        putLinks();
    ?>
    <title>CHROMIS BACKOFFICE</title>
  </head>
  <body>
  

<nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand tada animated" href="./index.php">CHROMIS BACKOFFICE</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav navbar-left">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Products <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="/chromisphp/productsearch.php">Search</a></li>
                    <li><a href="#">New Product</a></li>
                    <li><a href="/chromisphp/productpurchase.php">Purchase</a></li>
                    <li><a href="./marginsearch.php">Distribution</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Masters <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="./Locations.php">Locations</a></li>
                    <li><a href="./categories.php">Categories</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Uploads <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="./newproductupload.php">All Purchases</a></li>
                    <li><a href="./csvupload.php">Quantity from CSV</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="./Report_ProductSalesProfit.php">Itemwise Profit</a></li>
                    <li><a href="./Report_ProductSalesProfitMonthly.php">Monthly Profit - All</a></li>
                    <li><a href="./Report_StationerySalesProfitMonthly.php">Monthly Profit - Stationery</a></li>
                    <li><a href="./Report_InternetSalesProfitMonthly.php">Monthly Profit - Internet</a></li>
                    <li><a href="./Report_CustomerInvoices.php">Customer Invoices</a></li>
                    <li><a href="./Report_CustomerItems.php">Customer Items</a></li>
                    <li><a href="./Report_CustomerItems_price.php">Customer Items Last/Max Billed</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="./Report_CashReceipts.php">Cash Receipts Search</a></li>
                    <li><a href="./Report_CashReceiptsItems.php">Cash Receipts Product Search</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Actions <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="./Mark_Payment_Customerinvoices.php">Customer Payment Tracker</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Analytics <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="./dashboard.php" target="_blank">Dashboard</a></li>
                    <li><a href="#">Reserved</a></li>
                    <li><a href="#">Reserved</a></li>
                    <li><a href="#">Reserved</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Reserved</a></li>
                    <li><a href="#">Reserved</a></li>
                </ul>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>

<div class="container-fluid">

</div> <!-- container -->





<?php
    stickfooter();
?>
</body>
</html>