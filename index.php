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
    <header class="site__header island">
      <div class="wrap">
        <span id="animationSandbox" style="display: block;"  class="tada animated">
          <h2 class="site__title mega text-center">CHROMIS BACKOFFICE</h2>
        </span>
      </div>
    </header>
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