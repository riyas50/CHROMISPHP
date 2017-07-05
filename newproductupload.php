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
   <h1 class="site__title mega text-center">New Product Upload</h1>
   </span>
  </div>
  </header>

<form action="newproductupload.php" method="post" enctype="multipart/form-data">
 <div class="row">
 <div class="form-group">
 
 <div class="col-lg-3"></div>
 
 <div class="col-lg-6 text-right">
    <a class="glyphicon glyphicon-home" style="font-size:30px;color:orange" href="/chromisphp/"></a> 
    
    <div class="input-group">
    
        <!--<div class="input-group-addon">Barcode</div>-->
        <input type="file" class="form-control" name="filedialog" id="inlineFormInputGroup" placeholder="choose csv file" required>

    </div> <!--input group-->

<br />
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