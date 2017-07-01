<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Chromis PHP - Locations</title>

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
   <h1 class="site__title mega text-center">Location Master</h1>
   </span>
  </div>
  </header>

<form action="locations.php" method="post" enctype="multipart/form-data">
 <div class="row">
 <div class="form-group">
 <div class="col-lg-4"></div>
 <div class="col-lg-4 text-right">
     <a class="glyphicon glyphicon-home" style="font-size:30px;color:orange" href="/chromisphp/"></a> 
 <div class="input-group">
    <div class="input-group-addon">Locations</div>
    <input type="text" class="form-control" name="Location" id="inlineFormInputGroup" placeholder="Location" required>
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

<div class="panel panel-default">
 
  <!-- Table -->
  <table class="table table-striped">
  <thead>
  
  
    <?php
    include('dbconnect.php');
    refreshRecords();
function refreshRecords() {
    
        echo '<tr>';
        echo '<th class="label visible-lg-inline-block label-info text-center" width="100%">Location Description</th>';
        echo '</tr>';
        echo '</thead>';

        $conn = dbConn();

        $sql = "SELECT NAME FROM locations";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                //echo "<tr><td>". $row["ID"] ."</td>" . "<td>". $row["NAME"] ."</td></tr>";
                echo "<tr><td>". $row["NAME"] ."</td></tr>";
            }
        } else {
            //echo "0 results";
            echo "<tr><td>". "No records found!" ."</td></tr>";
        }

        mysqli_close($conn);
        $conn=null;
        $sql="";
}
    ?>
    
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
        //--REPLACE INTO categories (ID,NAME) VALUES (CONVERT(UUID(),CHAR),'TEST03');
         $conn = dbConn();

         $location = $_POST['Location'];

        $sql = "REPLACE INTO locations (SITEGUID,NAME) VALUES (CONVERT(UUID(),CHAR),'". $location ."')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo '<div class="label label-success">' . 'Record updated!' . '</div>';
            echo "<meta http-equiv='refresh' content='0'>";
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
     echo '<div class="label label-warning">' . 'Remove pressed!' . '</div>';

     $conn =dbConn();
     $remLocation = $_POST['Location'];

      $sql = "DELETE FROM locations WHERE NAME = '". $remLocation ."'";
      echo '<div class="label label-info">' . 'Query:=' . $sql . '</div>'; 
        $result = mysqli_query($conn, $sql);

         if ($result) {
            echo '<div class="label label-danger">' . 'Record Removed!' . $result . '</div>';
            echo "<meta http-equiv='refresh' content='0'>";
        }
        else
        {
            echo '<div class="label label-danger">' . 'failed to Remove!' . '</div>';
            echo $result;
        }
        mysqli_close($conn);
        $conn=null;
        $sql="";
    }

?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/validator.js"></script>

<!--
-->  </body>
</html>