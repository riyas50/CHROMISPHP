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
   <h1 class="site__title mega text-center">Category Master</h1>
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
    <div class="input-group-addon">Category</div>
    <input type="text" class="form-control" name="category" id="inlineFormInputGroup" placeholder="Category" required>
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


    refreshRecords();
function refreshRecords() {
    
        echo '<tr>';
        echo '<th class="label visible-lg-inline-block label-info text-center" width="100%">Category Description</th>';
        echo '</tr>';
        echo '</thead>';

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

         $category = $_POST['category'];

        $sql = "REPLACE INTO categories (ID,NAME) VALUES (CONVERT(UUID(),CHAR),'". $category ."')";
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
     $remCategory = $_POST['category'];

      $sql = "DELETE FROM categories WHERE NAME = '". $remCategory ."'";
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

	<?php
    //include('general.php');
    putScripts();
    stickfooter();
?>
<!--
-->  </body>
</html>