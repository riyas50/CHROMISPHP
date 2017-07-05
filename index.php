<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
        include('general.php');
        putLinks();
    ?>
    <title>Home</title>
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
    <div class="panel table-bordered">
      <div class="panel-heading bg-success">
          <h4 style="color:red;">Products</h4>
      </div>
      <div class="panel-body">
   <a class="btn btn-info" href="/chromisphp/productsearch.php"> Search</a>
  <a class="btn btn-danger" href="/chromisphp/newproductupload.php">New Product</a>
  <a class="btn btn-success" href="/chromisphp/productpurchase.php">Purchase</a>
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
        <a class="btn btn-warning" href="/chromisphp/csvupload.php">Quantity from csv</a>
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