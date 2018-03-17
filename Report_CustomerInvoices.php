<!DOCTYPE html>
<html lang="en">
  <head>
    
    <?php
        include('general.php');
        putLinks();
    ?>

  </head>
  <body>
    <header class="site__header island">
    <div class="wrap">
    <span id="animationSandbox" style="display: block;"  class="tada animated">
    <h1 class="site__title mega text-center">Invoice Search</h1>
    </span>
    </div>
  </header>

<form action="Report_CustomerInvoices.php" method="post" enctype="multipart/form-data">
 <div class="row">
 <div class="form-group">
 <div class="col-lg-4"></div>
 <div class="col-lg-4 text-right">
          <a class="glyphicon glyphicon-home" style="font-size:30px;color:orange" href="/chromisphp/"></a> 
 <div class="input-group">
    <div class="input-group-addon">SEARCH</div>
    <input type="text" class="form-control" name="customer" id="inlineFormInputGroup" placeholder="Customer...">
    <input type="text" class="form-control" name="invoice" id="inlineFormInputGroup" placeholder="Invoice#">
    </div>
    <br />  
     <button type="submit" class="btn btn-success" id="btnSearch" name="Search">Search</button>
     <button type="submit" class="btn btn-warning" id="btnClear" name="Clear">Clear</button>
     <button type="submit" class="btn btn-info" id="btnReload" name="Reload">Reload</button>
 </div>
 <div class="col-lg-4"></div>
 </div>
 </div>
 </form>
<br />
<div class="row">
<div class="col-lg-4"></div>
<div class="col-lg-12">

<!--<div class="panel panel-default">-->
 
  <!-- Table -->
  <!--<table class="table table-striped">-->
  <!--<thead>-->
  
  
<?php
    //include('dbconnect.php');
    include('Report_CustomerInvoices_query.php');

        session_start();
        if( strcasecmp($_SERVER['REQUEST_METHOD'],"POST") === 0) {
            $_SESSION['postdata'] = $_POST;
            header("Location: ".$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']);
            exit;
        }
        if( isset($_SESSION['postdata'])) {
            $_POST = $_SESSION['postdata'];
            unset($_SESSION['postdata']);
        }
            
    if (isset($_POST['']))
        {
            //echo 'empty post';
            refreshRecords();
            //putEmptyRow();
        }
?>
    
 
</div>
<div class="col-lg-4"></div>
</div>
</div>

<?php 

if (isset($_POST['Reload']))
    {
        refreshRecords();
    }

if (isset($_POST['Search']))
    {
        filterRecords($_POST['customer'],$_POST['invoice']);
    }

?>

<?php
    //include('general.php');
    putScripts();
    stickfooter();
?>

<!--
-->
 
</body>
</html>