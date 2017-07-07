<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
        include('general.php');
        include('dbconnect.php');
        putLinks();
    ?>
   <title>Purchase - Chromis BackOffice</title>
  </head>
  <body>

<header class="site__header island">
  <div class="wrap">
   <span id="animationSandbox" style="display: block;"  class="tada animated">
   <h1 class="site__title mega text-center">Product Purchase</h1>
   </span>
  </div>
  </header>

<form action="productpurchase.php" method="post" enctype="multipart/form-data" >
 <div class="row">
 <div class="form-group">
 <div class="col-lg-4"></div>
 <div class="col-lg-4 text-right">

    <div class="form-group">

    <a class="glyphicon glyphicon-home" style="font-size:30px;color:orange" href="/chromisphp/"></a> 
     <div class="input-group hidden">
    <div class="input-group-addon"><a class="glyphicon glyphicon-calendar" ></a></div>
    <!--<input type="text" class="form-control" name="category" id="inlineFormInputGroup" placeholder="2017-07-05 19:10:10" required>-->
    <!---->   
    <div class="input-append date form_datetime">
        <input size="16" type="text" value="" readonly class="form-control" placeholder="Choose Date...">       
        <span class="add-on text-right"><i class="icon-th"></i></span>
    </div>
    <!---->
</div>      
  <div class="input-group">  
    <div class="input-group-addon glyphicon glyphicon-record hidden"></div>
    <input type="text" class="form-control hidden" 
    name="category" id="inlineFormInputGroup" placeholder="Location" 
    type="number">
    </div>
    <div class="input-group">
    <div class="input-group-addon glyphicon glyphicon-barcode"></div>
    <input type="number" class="form-control" name="barcode" id="inlineFormInputGroup" 
    type="number"
    placeholder="Barcode... Ex: 12345698" required>
    </div>
    <div class="input-group">
    <div class="input-group-addon glyphicon glyphicon-equalizer"></div>
    <input type="number" class="form-control" name="quantity" 
    
    id="inlineFormInputGroup" placeholder="Quantity... Ex: 10" >
    </div>
    <div class="input-group">
    <div class="input-group-addon glyphicon glyphicon-euro"></div>
    <input type="text" class="form-control" name="buyPrice" 
    pattern="^\d{1,5}\.\d{2}$"
    id="inlineFormInputGroup" placeholder="Cost/Piece... Ex:10.50" >
    </div>
    <br />  
     <button type="submit" class="btn btn-success" id="btnSave" name="Save" >Save</button>
     <button type="submit" class="btn btn-warning hidden" id="btnRemove" name="Remove" >Remove</button>
     <button type="submit" class="btn btn-info hidden" id="btnRefresh" name="Refresh">Refresh</button>
 </div>
     
 </div>
 </div>
 <div class="col-lg-4"></div>
 
 </div>
 </form>
<br />
<div class="row">
<div class="col-lg-4"></div>
<div class="col-lg-4">
<div class="col-lg-4"></div>
</div>
</div>

<?php 
    if (isset($_POST['Save']))
    {
         $conn = dbConn();

         //$location = $_POST['Location'];

        

        $sql = "CALL PRODPURCHASE (now(),1,0,'" . $_POST['barcode'] . "'," . $_POST['quantity'] . 
        "," . $_POST['buyPrice'] . ",'Navas')";
         
        //echo $sql;
        
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo '<div class="label label-success">' . 'Record updated!' . '</div>';
            //echo "<meta http-equiv='refresh' content='0'>";
        }
        else
        {
            echo '<div class="label label-danger">' . 'failed to save!' . '</div>';
        }
        mysqli_close($conn);
        $conn=null;
        $sql="";
    }

if (isset($_POST['Remove']))
    {
        //php code here
    }

?>

	<?php
    //include('general.php'); 
    putScripts();
    putDatePickerScript();
    stickfooter();
?>



<!--
-->  </body>
</html>