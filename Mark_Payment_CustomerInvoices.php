<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    
    <?php
        include('general.php');
        putLinks();
    ?>

    <link rel="stylesheet" href="./css/my.css">
  </head>
  <body>
    <header class="site__header island">
    <div class="wrap">
    <span id="animationSandbox" style="display: block;"  class="tada animated">
    <h1 class="site__title mega text-center">Customer Payments Tracker</h1>
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


<form action="Mark_Payment_CustomerInvoices.php" method="post" enctype="multipart/form-data">
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


  
  
<?php
    //include('dbconnect.php');
    include('Mark_Payment_CustomerInvoices_query.php');

        //session_start();
        $_SESSION["thispaystsquery"] = "";
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
        //echo $_SESSION['thispaystsquery'];
    }

if (isset($_POST['Search']))
    {
        filterRecords($_POST['customer'],$_POST['invoice']);
        //echo $_SESSION['thispaystsquery'];
    }

?>

<?php
    //include('general.php');
    putScripts();
?>
    <script>
        $(document).ready(function(){
            $('.openTicket').on('click',function(){
                var dataURL = $(this).attr('data-href');
                $('.modal-title').text('INVOICE# ' + $(this).attr('data-title'))
                $('.modal-body').load(dataURL,function(){
                    $('#modal-id').modal({show:true});
                });
            });
            
            //$("a[id^='a']").on('click','#deleteUrl', function() {...});


            //$("a[id^='a']").click(function() {
            $(document).on('click', "a[id^='a']", function() {
            //$("a[id^='a']").live("click", function() {
                var thisurl = $(this).attr('data-href');
                //var thisTicketSpn = 'span[id=s' + $(this).attr('id').substring(1);
                var thisTicket = 'div[id=div' + $(this).attr('id').substring(1);
                var thisdue = 'div[id=due' + $(this).attr('id').substring(1);
                var thispaid = 'div[id=paid' + $(this).attr('id').substring(1);
                var thisduetot = 'div[id=duetot'; //+ $(this).attr('id').substring(1);
                var thispaidtot = 'div[id=paidtot'; //+ $(this).attr('id').substring(1);
                //alert(thisTicket);
                //alert('success!');
                //alert(thisurl);

                $.ajax({
                    type: "POST",
                    url:thisurl,
                    data: {},
                    success: function (response) {

                        var res = $.parseJSON(response);

                        //alert(res.due);
                        //alert(res.duetot);
                        //alert(res.paid);
                        //alert(res.paidtot);
                        
                        $(thisTicket).html(res.paystatus);
                        $(thisdue).html(res.due);
                        $(thispaid).html(res.paid);
                        $(thisduetot).html(res.duetot);
                        $(thispaidtot).html(res.paidtot);
                        
                    },
                    error: function(jqxhr, status, exception) {
                        alert('Exception:', exception); 
                    }
                });

/*                 $.ajax({
                    
                }); */

            });
        });
    </script>
<?php
    stickfooter();
?>

<!--
-->
 
</body>
</html>