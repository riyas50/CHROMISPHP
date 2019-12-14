<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
        set_time_limit(300); //300 seconds, 5 minutes
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
   <h1 class="site__title mega text-center">Report - Product Sales:Profit</h1>
   <h2 class="site__title mega text-center">Itemwise</h2>
   </span>
  </div>
  </header>

<form action="Report_ProductSalesProfit.php" method="post" enctype="multipart/form-data" >
 <div class="row">
 <div class="form-group">
    <div class="col-lg-4 text-right"></div>

    <div class="col-lg-4 text-right">
                    <a class="glyphicon glyphicon-home" style="font-size:30px;color:orange" href="/chromisphp/"></a> 
                    
                    <div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input1" data-link-format="dd/mm/yyyy">
                        <input class="form-control" size="16" type="text" value="" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                      <input type="hidden" name="dtp_input1" id="dtp_input1" value="" />  
                <!--</div>-->
                <!---->
                    <div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="dd/mm/yyyy">
                        <input class="form-control" size="16" type="text" value="" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                      <input type="hidden" name="dtp_input2" id="dtp_input2" value="" />  
                <!--</div>-->
                <!---->
                <div class="checkbox">
                    <label>
                        <input type="checkbox" id="chkAllSales" name="chkAllSales" value="All"> All Profit Till Date
                    </label>
                </div>
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
                if ((!empty($_POST['dtp_input1'])) && (!empty($_POST['dtp_input2'])))
                    {
                        $date1 = date($_POST['dtp_input1']);
                        $date2 = date($_POST['dtp_input2']);

                        //$date1 = 
                        if($date2 > $date1)
                            {
                                //displayMessage('Date 1: ' . $date1 . '\n' . 'Date 2: ' . $date2);
                                echo "<span class=\"label label-info\">Fiter Date: $date1 - $date2</span>";
                                profitDateFilter($date1,$date2);
                            }
                        else 
                            {
                                echo "<span class=\"label label-warning\">Invalid Filter</span>";
                                displayMessage('Invalid date selection');                                                  
                            }
                    }
                elseif ((!empty($_POST['dtp_input1'])) && (empty($_POST['dtp_input2']))) 
                    {
                        # code...
                        $date1 = date($_POST['dtp_input1']);                        
                        echo "<span class=\"label label-info\">Fiter Date: $date1</span>";                        
                        //displayMessage('Date 2 empty!');
                        profitDateFilter($date1,'');
                    }
                elseif ((empty($_POST['dtp_input1'])) && (!empty($_POST['dtp_input2']))) 
                    {
                        # code...
                        echo "<span class=\"label label-warning\">Invalid Filter</span>";
                        displayMessage('Invalid date selection');  
                    }
                else {
                    # code...
                    //displayMessage('empty!');
                    if((empty($_POST['chkAllSales'])))
                        {
                            //displayMessage($_POST['chkAllSales']);
                            echo "<span class=\"label label-info\">No Filter Applied</span>";
                            profitTillDate();

                        }
                    if((!empty($_POST['chkAllSales'])))
                        {
                            //displayMessage($_POST['chkAllSales']);
                            echo "<span class=\"label label-info\">Filter: Profit Till Date</span>";
                            profitDateFilter('','');
                        } 
                }

                //profitTillDate();
            }

        if (isset($_POST['btnClear']))
        {
            //php code here
            echo "<meta http-equiv='refresh' content='0'>";
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