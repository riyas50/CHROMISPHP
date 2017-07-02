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
   <h1 class="site__title mega text-center">Initial Product Upload</h1>
   </span>
  </div>
  </header>

<form action="productupload.php" method="post" enctype="multipart/form-data">
 <div class="row">
 <div class="form-group">
 
 <div class="col-lg-3"></div>
 
 <div class="col-lg-6 text-right">
    <a class="glyphicon glyphicon-home" style="font-size:30px;color:orange" href="/chromisphp/"></a> 
    <div class="input-group">
    
    <div class="input-group-addon">Barcode</div>
    <input type="text" class="form-control" name="barcode" id="inlineFormInputGroup" placeholder="barcode" required>

    <div class="input-group-addon">Reference</div>
    <input type="text" class="form-control" name="reference" id="inlineFormInputGroup" placeholder="reference" required>

    </div> <!--input group-->
<br />
    <div class="input-group">


    
    <div class="input-group-addon">Product Name</div>
    <input type="text" class="form-control" name="barcode" id="inlineFormInputGroup" placeholder="product name" required>
    
    <div class="input-group-addon">Reference</div>
    <input type="text" class="form-control" name="reference" id="inlineFormInputGroup" placeholder="reference" required>
    </div> <!--input group-->

    <br />  
     <button type="submit" class="btn btn-success" id="btnSave" name="Save">Save</button>
     <button type="submit" class="btn btn-warning" id="btnRemove" name="Remove">Remove</button>
     <button type="submit" class="btn btn-info" id="btnRefresh" name="Refresh" formnovalidate>Refresh</button>
 </div>

 <div class="col-lg-3"></div>

 </div> <!--form group-->
 </div> <!--close row--> 
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
    stickfooter();
?>
<!--
-->  </body>
</html>