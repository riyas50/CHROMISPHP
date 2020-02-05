<!DOCTYPE html>
<html lang="en">
<head>
<?php
session_start();
set_time_limit(300); //300 seconds, 5 minutes
include('general.php');
include('StoreSalesSummaryCode.php');
putLinks();
?>
<title>Chromis PHP - Daily Store Sales Summary</title>
</head>
<body>
<header class="site__header island">
<div class="wrap">
<span id="animationSandbox" style="display: block;"  class="tada animated">
<h1 class="site__title mega text-center">Daily - Store Sales Summary (X Report)</h1>
</span>
</div>
</header>

<form action="StoreSalesSummary.php" method="post" enctype="multipart/form-data">
<div class="row">
<div class="form-group">
<div class="col-lg-4"></div>
<div class="col-lg-4 text-right">
<a class="glyphicon glyphicon-home" style="font-size:30px;color:orange" href="/chromisphp/"></a> 
<div class="input-group">
<div class="input-group-addon">Date</div>
<input type="text" class="form-control" name="category" id="inlineFormInputGroup" placeholder="Transaction Date" required>
</div>
<br />  
<!-- <button type="submit" class="btn btn-success" id="btnSave" name="Save">Save</button>
<button type="submit" class="btn btn-warning" id="btnRemove" name="Remove">Remove</button>
<button type="submit" class="btn btn-info" id="btnRefresh" name="Refresh" formnovalidate>Refresh</button> -->
</div>
<div class="col-lg-4"></div>
</div>
</div>
</form>
<br />
<div class="row">
<div class="col-lg-4"></div>
<div class="col-lg-4">
<div class="col-lg-4"></div>
</div>
</div>
<!--  -->
<?php $tickets = GetStoreSalesSummary();?> 
<!--  -->
<div class="container">
  <div class="accordion-option">
    <h3 class="title">Receipts</h3>
    <!-- <a href="#" class="toggle-accordion active" accordion-id="#accordion"></a> -->
  </div>
  <!-- <div class="clearfix"></div> -->
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">
  <?php foreach ($tickets as $ticket => $value) { ?>
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne<?php echo $value['TicketNo']; ?>">
        <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo $value['TicketNo']; ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $value['TicketNo']; ?>">
        <table class="table table-responsive">
          <tr>
            <td><p class="text-left">Number# <?php echo $value['TicketNo'];?></p></td>
            <td><p class="text-right">Date: <?php echo $value['TicketDate'];?></p></td>
          </tr>
        </table>  
        </a>
      </h4>
      </div>
      <div id="collapseOne<?php echo $value['TicketNo']; ?>" class="panel-collapse collapse out" role="tabpanel" aria-labelledby="headingOne<?php echo $value['TicketNo']; ?>">
        <div class="panel-body">
    <table class="table">
      <thead>
        <tr>
          <th class="text-center">SrNo.</th>
          <th class="text-center">Qty</th>
          <th class="text-center">Rate</th>
          <th class="text-right">Total</th>
        </tr>
      </thead>
      <tbody>
      <?php for ($i=0; $i < count($value['TicketLineItem']); $i++) {?>
        <tr>
          <td class="text-center"><?php echo $value['TicketLineItem'][$i]['ItemIndex'];?></td>
          <td class="text-center"><?php echo $value['TicketLineItem'][$i]['Qty'];?></td>
          <td class="text-center"><?php echo $value['TicketLineItem'][$i]['Rate'];?></td>
          <td class="text-right"><?php echo $value['TicketLineItem'][$i]['TotalItemPrice'];?></td>
        </tr>
        <?php }?>
      </tbody>
    </table>
        </div>
      </div>
    </div>
    <?php }?>
  </div>
</div>
<!--  -->

<?php

// session_start();
if (strcasecmp($_SERVER['REQUEST_METHOD'], "POST") === 0) {
    $_SESSION['postdata'] = $_POST;
    header("Location: ".$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']);
    exit;
}
if (isset($_SESSION['postdata'])) {
    $_POST = $_SESSION['postdata'];
    unset($_SESSION['postdata']);
}


if (isset($_POST['Save'])) {
    //php code here
}

if (isset($_POST['Remove'])) {
    //php code here
}

?>

<?php
//include('general.php');
putScripts();
stickfooter();
?>
<!--
-->  </body>
</html>