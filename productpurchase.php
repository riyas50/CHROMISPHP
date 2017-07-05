<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
        include('general.php');
        putLinks();
    ?>
   <title>Chromis PHP - Categories</title>
  </head>
  <body>

  
  
<header class="site__header island">
  <div class="wrap">
   <span id="animationSandbox" style="display: block;"  class="tada animated">
   <h1 class="site__title mega text-center">Product Purchase</h1>
   </span>
  </div>
  </header>

<form action="productpurchase.php" method="post" enctype="multipart/form-data">
 <div class="row">
 <div class="form-group">
 <div class="col-lg-4"></div>
 <div class="col-lg-4 text-right">
    <a class="glyphicon glyphicon-home" style="font-size:30px;color:orange" href="/chromisphp/"></a> 
     <div class="input-group">
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
    <div class="input-group-addon glyphicon glyphicon-record"></div>
    <input type="text" class="form-control" name="category" id="inlineFormInputGroup" placeholder="Location">
    </div>
    <div class="input-group">
    <div class="input-group-addon glyphicon glyphicon-barcode"></div>
    <input type="text" class="form-control" name="category" id="inlineFormInputGroup" placeholder="Barcode" required>
    </div>
    <div class="input-group">
    <div class="input-group-addon glyphicon glyphicon-equalizer"></div>
    <input type="text" class="form-control" name="category" id="inlineFormInputGroup" placeholder="Quantity" required>
    </div>
    <div class="input-group">
    <div class="input-group-addon glyphicon glyphicon-euro"></div>
    <input type="text" class="form-control" name="category" id="inlineFormInputGroup" placeholder="Price" required>
    </div>
    <br />  
     <button type="submit" class="btn btn-success" id="btnSave" name="Save">Save</button>
     <button type="submit" class="btn btn-warning" id="btnRemove" name="Remove">Remove</button>
     <button type="submit" class="btn btn-info" id="btnRefresh" name="Refresh" formnovalidate>Refresh</button>
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

<?php 
    if (isset($_POST['Save']))
    {
        //php code here
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