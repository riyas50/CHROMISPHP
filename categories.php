<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Animate.css -->
    <link href="css/animate.css" rel="stylesheet">
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

  
  
<header class="site__header island">
  <div class="wrap">
   <span id="animationSandbox" style="display: block;"  class="tada animated">
   <h1 class="site__title mega text-center">Category Master</h1>
   </span>
  </div>
  </header>

<form action="categories.php" method="post" enctype="multipart/form-data">
 <div class="row">
 <div class="form-group">
 <div class="col-lg-4"></div>
 <div class="col-lg-4 text-right">
 <div class="input-group">
    <div class="input-group-addon">Category</div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Category">
    </div>
    <br />  
     <button type="submit" class="btn btn-success" id="btnSave" name="Save">Save</button>
     <button type="submit" class="btn btn-danger" id="btnCancel" name="Cancel">Cancel</button>
 </div>
 <div class="col-lg-4"></div>
 </div>
 </div>
 </form>
<br />
<div class="row">
<div class="col-lg-4"></div>
<div class="col-lg-4">

<div class="panel panel-default">
  
  <!-- Default panel contents -->
 
  <!-- <div class="panel-heading">Existing Categories</div> -->

 <!-- Default panel contents
  <div class="panel-body">
    This is panel body
  </div>
 -->


  <!-- Table -->
  <table class="table table-striped">
  <thread>
    <?php

    include('dbconnect.php');
    
        echo '<td width=75%">Category Description</td>';

        $conn = dbConn();

        $sql = "SELECT ID,NAME FROM categories";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                //echo "<tr><td>". $row["ID"] ."</td>" . "<td>". $row["NAME"] ."</td></tr>";
                echo "<tr><td>". $row["NAME"] ."</td></tr>";
            }
        } else {
            echo "0 results";
        }

        mysqli_close($conn);

    

    ?>

    </thread>
  </table>
  </div>    
</div>
<div class="col-lg-4"></div>
</div>
</div>

<?php 
    if (isset($_POST['Save']))
    {
        echo '<div class="label label-warning">' . 'Save pressed!' . '</div>';
    }
?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
<!--
-->  </body>
</html>