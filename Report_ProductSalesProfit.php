<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
        include('general.php');
        //include('dbconnect.php');
        include('Report_ProductSalesProfitcode.php');
        putLinks();

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
    ?>
   <title>Report - Product Sales:Profit - Chromis BackOffice</title>
  </head>
  <body>

<header class="site__header island">
  <div class="wrap">
   <span id="animationSandbox" style="display: block;"  class="tada animated">
   <h1 class="site__title mega text-center">Report - Product Sales:Profit Till Date</h1>
   </span>
  </div>
  </header>

<form action="Report_ProductSalesProfit.php" method="post" enctype="multipart/form-data" >
 <div class="row">
 <div class="form-group">
    <div class="col-lg-4 text-right"></div>

    <div class="col-lg-4 text-right">
                    <a class="glyphicon glyphicon-home" style="font-size:30px;color:orange" href="/chromisphp/"></a> 
                    
                    <div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input1" data-link-format="<mm-dd-yyyy></mm-dd-yyyy>">
                        <input class="form-control" size="16" type="text" value="" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                      <input type="hidden" name="dtp_input1" id="dtp_input1" value="" />  
                <!--</div>-->
                <!---->
                    <div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                        <input class="form-control" size="16" type="text" value="" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                      <input type="hidden" name="dtp_input2" id="dtp_input2" value="" />  
                <!--</div>-->
                <!---->
<br />
     <button type="submit" class="btn btn-success" id="btnReport" name="btnReport" >Run Report</button>
     <button type="submit" class="btn btn-warning" id="btnClear" name="btnClear" >Clear</button>
    </div>      

    <br /> 
 </div>
     
    <div class="col-lg-4"></div>
 </div>
 </form>
<br />
        <?php 



        if (isset($_POST['btnReport']))
        {
            //displayMessage($_POST['dtp_input1']);
            // echo "<meta http-equiv='refresh' content='0'>";
            profitTillDate();
        }

        if (isset($_POST['btnClear']))
        {
            //php code here
        }

        ?>

   <!--     </div>
        <div class="col-lg-1"></div> 
    </div>-->

    <?php
        //include('general.php'); 
        putScripts();
        putDatePickerScript();
        stickfooter();
    ?>

</body>
</html>