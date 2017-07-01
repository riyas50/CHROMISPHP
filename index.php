<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
        include('general.php');
        putLinks();
    ?>
    <<title>Home</title>
  </head>
  <body>

  
  
    <header class="site__header island">
  <div class="wrap">
   <span id="animationSandbox" style="display: block;"  class="tada animated">
   <h2 class="site__title mega text-center">CHROMISPHP MENU</h2>
     </span>
  </div>
  </header>
<br />
<br />
  <div class="container">
    <div class="well">
  <a class="btn btn-success" href="/chromisphp/Locations.php">Locations</a>
  <a class="btn btn-danger" href="/chromisphp/Categories.php">Categories</a>
  <a class="btn btn-info" href="/chromisphp/productsearch.php">Products Search</a>
  <a class="btn btn-warning" href="/chromisphp/csvupload.php">Quantity from csv</a>
  <a class="btn btn-danger" href="#">Product upload</a>
  </div>
</div>

	<?php
    //include('general.php');
    putScripts();
    stickfooter();
?>

<!--
-->  </body>
</html>