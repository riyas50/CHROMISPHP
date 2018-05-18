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
    <h1 class="site__title mega text-center">Cash Receipts Items Search</h1>
    </span>
    </div>
  </header>


<!-- Modal Window Starts Here.... -->
<!-- <a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Trigger modal</a>
<br>
<a href="javascript:void(0);" data-href="ticketdetails.php?ticketid=2" class="openTicket">About Us</a> -->

<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>
<!-- Modal Window ends here.... -->


<form action="Report_CashReceiptsItems.php" method="post" enctype="multipart/form-data">
 <div class="row">
 <div class="form-group">
 <div class="col-lg-4"></div>
 <div class="col-lg-4 text-right">
          <a class="glyphicon glyphicon-home" style="font-size:30px;color:orange" href="/chromisphp/"></a> 
 <div class="input-group">
    <div class="input-group-addon">SEARCH</div>
    <!-- <input type="text" class="form-control" name="customer" id="inlineFormInputGroup" placeholder="Customer...">
    <input type="hidden" id="CustID" name="CustID" value="" class="form-control">
    <div id="display" class="list-group"></div> -->
    <input type="text" class="form-control" name="items" id="productInput" placeholder="product...">
    <input type="hidden" id="ProdID" name="ProdID" value="" class="form-control">
    <div id="product" class="list-group"></div>
    </div>
    <br />  
     <button type="submit" class="btn btn-success" id="btnSearch" name="Search">Search</button>
     <button type="submit" class="btn btn-warning" id="btnClear" name="Clear">Clear</button>
     <!-- <button type="submit" class="btn btn-info" id="btnReload" name="Reload">Reload</button> -->
 </div>
 <div class="col-lg-4"></div>
 </div>
 </div>
 </form>
<br />
<div class="row">
<div class="col-lg-4"></div>
<div class="col-lg-12">


  
  
<?php
    //include('dbconnect.php');
    include('Report_CashReceiptItems_query.php');

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
        filterRecords($_POST['items']);
        //displayMessage($GLOBALS['CustID']);
    }

?>

<?php
    //include('general.php');
    putScripts();
?>
<script type="text/javascript" src="js/ajax.js"></script>
<?php
    stickfooter();
?>

<!--
-->
 
</body>
</html>