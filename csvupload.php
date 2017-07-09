<html>
 <head>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Chromis PHP</title>
  <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
 </head>
 
 
 <body>
 
 <form  action="upload.php" method="post" enctype="multipart/form-data">
	<div class="container">
  <div class="jumbotron">
	<h2> Chromis Current Stock Update csv Upload </h2> <br />
  </div>
  </div>
    <div>
	<h3> Select csv to upload:</h3>
    <input class="btn btn-warning" type="file" name="fileToUpload" id="fileToUpload">
    <input class="btn btn-success" type="submit" value="Upload csv" name="upload">
	<input class="btn btn-info" type="submit" value="Preview CSV" name="preview">
	<input class="btn btn-danger" type="submit" value="Check mySql Connection" name="sqlcheck">
	</div>
</form>
<!--
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
        
 echo '<p>Hello World</p>'; 
 $csvFile = $_FILES["fileToUpload"]["name"];
 echo $csvFile;
 echo '<br />';
 echo '<br />';
 echo '<br />';
 echo '<br />';
echo '==================================================================================<br />';
  $csvFile = file('book1.csv');
    $data = [];
    foreach ($csvFile as $line) {
        $data[] = str_getcsv($line);
		print_r($data);
		echo '<br />';
    }?>  
 -->
 
 
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
 </body>
</html>