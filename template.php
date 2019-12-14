<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
        set_time_limit(300); //300 seconds, 5 minutes
        include('general.php');
        putLinks();
    ?>
   <title>Chromis PHP - Categories</title>
  </head>
  <body>

  
  
<header class="site__header island">
  <div class="wrap">
   <span id="animationSandbox" style="display: block;"  class="tada animated">
   <h1 class="site__title mega text-center">Page Template</h1>
   </span>
  </div>
  </header>

<form action="categories.php" method="post" enctype="multipart/form-data">
 <div class="row">
 <div class="form-group">
 <div class="col-lg-4"></div>
 <div class="col-lg-4 text-right">
          <a class="glyphicon glyphicon-home" style="font-size:30px;color:orange" href="/chromisphp/"></a> 
 <div class="input-group">
    <div class="input-group-addon">Template</div>
    <input type="text" class="form-control" name="category" id="inlineFormInputGroup" placeholder="Template" required>
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