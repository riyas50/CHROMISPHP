<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
        include('general.php');
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
        <a class="navbar-brand tada animated" href="#">CHROMIS BACKOFFICE</a>
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
                    <li><a href="#">Distribution</a></li>
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
                    <li><a href="./Report_ProductSalesProfitMonthly.php">Monthly Profit</a></li>
                    <li><a href="./Report_CustomerInvoices.php">Customer Invoices</a></li>
                    <li><a href="./Report_CustomerItems.php">Customer Items</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="./Report_CashReceipts.php">Cash Receipts Search</a></li>
                    <li><a href="./Report_CashReceiptsItems.php">Cash Receipts Product Search</a></li>
                </ul>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>



  
<!--     <header class="site__header island">
      <div class="wrap">
        <span id="animationSandbox" style="display: block;"  class="tada animated">
          <h2 class="site__title mega text-center">CHROMIS BACKOFFICE</h2>
        </span>
      </div>
    </header> -->


<br />
<br />
  <div class="container">

      <div id="tableManager" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Country Name</h2>
                    </div>

                    <div class="modal-body">
                        <input type="text" class="form-control" placeholder="Country Name..." id="countryName"><br>
                        <textarea class="form-control" id="shortDesc" placeholder="Short Country Description"></textarea><br>
                        <textarea class="form-control" id="longDesc" placeholder="Long Country Description"></textarea><br>
                    </div>

                    <div class="modal-footer">
                        <input type="button" onclick="manageData('addNew')" value="Save" class="btn btn-success">
                    </div>
                </div>
            </div>
        </div>

    <div class="panel table-bordered">
      <div class="panel-heading bg-success">
          <h4 style="color:red;">Products</h4>
      </div>
      <div class="panel-body">
   <a class="btn btn-info" href="/chromisphp/productsearch.php"> Search</a>
  <a class="btn btn-danger" href="#">New Product</a>
  <a class="btn btn-success" href="/chromisphp/productpurchase.php">Purchase</a>
  <a class="btn btn-warning" href="/chromisphp/marginsearch.php">Distribution</a>
  </div>
  </div>
    <div class="Panel table-bordered">
      <div class="panel-heading bg-info">
          <h4 style="color:red;">Masters</h4>
      </div>
      <div class="panel-body">
        <a class="btn btn-success" href="/chromisphp/Locations.php">Locations</a>
        <a class="btn btn-danger" href="/chromisphp/Categories.php">Categories</a>
      </div>
    </div>
    <br />
    <div class="Panel table-bordered">
      <div class="panel-heading bg-danger">
          <h4 style="color:red;">Uploads</h4>
      </div>
      <div class="panel-body">
        <a class="btn btn-info" href="/chromisphp/newproductupload.php">All Purchases</a>
        <a class="btn btn-warning" href="/chromisphp/csvupload.php">Quantity from csv</a>
  </div>
  </div>
  <br />
    <div class="Panel table-bordered">
      <div class="panel-heading bg-warning">
          <h4 style="color:red;">Reports</h4>
      </div>
      <div class="panel-body">
        <a class="btn btn-info" href="/chromisphp/Report_ProductSalesProfit.php">Product Sales: Itemwise Profit Report</a>
        <a class="btn btn-warning" href="/chromisphp/Report_ProductSalesProfitMonthly.php">Product Sales: Monthly Profit Report</a>
        <br />
        <br />
        <a class="btn btn-success" href="/chromisphp/Report_CustomerInvoices.php">Customer Invoices</a>
        <a class="btn btn-danger" href="/chromisphp/Report_CustomerItems.php">Customer Items</a>
        <br />
        <br />
        <a class="btn btn-success" href="./Report_CashReceipts.php">Cash Receipts Search</a>
        <a class="btn btn-danger" href="./Report_CashReceiptsItems.php">Cash Receipts Product Search</a>
  </div>
  </div>
</div>

	<?php
    //include('general.php');
    putScripts();
    stickfooter();
?>

<!--
-->  </body>
</html>