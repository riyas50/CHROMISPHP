<?php
set_time_limit(300); //300 seconds, 5 minutes
$target_dir = "/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
if(isset($_POST["upload"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "Sorry File is an image - " . $check["mime"] . ".";
        $uploadOk = 0;
    } else {
        echo '<h4><span class="label label-success">Your file seems valid!</span></h4>';
        $uploadOk = 1;
    }
}

//csv preview button post back
if(isset($_POST["preview"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "Sorry File is an image - " . $check["mime"] . ".";
        $uploadOk = 0;
    } else {
        echo '<h4><span class="label label-success">Your file seems valid!</span></h4>';
        $uploadOk = 1;
    }
}

if(isset($_POST["sqlcheck"])) {
	
	$abc = uploadcsvdata();
	echo $abc;
	//exit();
	
	
	$servername = "localhost";
	$username = "root";
	$password = '$$almoe$$';

	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	// echo "Connected successfully";
    exit(0);
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "csv") {
    echo "Sorry, only csv file is allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
// From here upload or preview functions are called 
if ($uploadOk == 0) {
	echo '<br />';
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
	if(isset($_POST["upload"])) {
	// echo '<span class="label label-primary">implement upload</span>';
	uploaddata();
	exit(0);
	}
	else {
	previewcsv();}
}

//uploaddata() to start processing upload
//from inside this function uploadcsvdata is called
function uploaddata(){
		
		// echo 'inside upload data <br />';
		
	  $csvFile = file($_FILES["fileToUpload"]["tmp_name"],FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
	  // print_r($csvFile);	  
	  // echo '<br />';

    $data = [];
	
    foreach ($csvFile as $line) {
        $data[] = str_getcsv($line);
		
		//field description
		//reference	barcode	buyprice	sellprice	name	category	qty	
		//	1			2		3			4		5			6		7
		
		for($r=0;$r<(count($line));$r++){
				// echo $data[(count($data)-1)][2];
				// echo "\t";
				// echo $data[(count($data)-1)][7];
				// echo '<br />';
				$barcode =(string)$data[(count($data)-1)][2];
				$units = $data[(count($data)-1)][7];
				if (is_numeric($data[(count($data)-1)][7])){
				$output = uploadcsvdata($barcode,$units);
				echo $output;}
				
			}
		echo '<br />';
		}
}		

//csv preview function
function previewcsv(){    
	
	//if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    //    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    //} else {
    //    echo "Sorry, there was an error uploading your file.";
    //}
	  echo '<br />';
	  echo '<br />';
	  echo '<br />';
	  echo '<br />';
	  echo '<br />';
	  echo '<br />';
	  echo '<br />';
	  
	  $csvFile = file($_FILES["fileToUpload"]["tmp_name"],FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
	  //print_r($csvFile);
	  
	  echo '<br />';

    $data = [];
	
    foreach ($csvFile as $line) {
        $data[] = str_getcsv($line);
		// print_r($line);
		// echo "<br />";
		// echo "<br />";
		// print_r($data);
		// echo "<br />";
		// echo "=========================================================================";
		// echo "<br />";
		
		//field description
		//reference	barcode	buyprice	sellprice	name	category	qty	
		//	1			2		3			4		5			6		7
		for($r=0;$r<(count($line));$r++){
				echo $data[(count($data)-1)][2];
				echo "\t";
				echo $data[(count($data)-1)][7];
			echo "<br />";
			echo "<br />";
			
			}
		//print_r($data);
		echo '<br />';}
}

//csv update qty against barcode
 function uploadcsvdata($itemcode="abcd",$qty=0){
	
	// echo 'inside upload csv data function <br />';
 
	if($itemcode == "")
	{
		return 'No command to execute! Nothing was done! <br />';
		exit(0);
	}
	else{
	$servername = "localhost";
	$username = "root";
	$password = '$$almoe$$';
	$mydatabase = "chromispos";

	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	else{
		$select = mysqli_select_db($conn,$mydatabase) or die(mysql_error());
		}	
	
	//upload data to mysql data
	// Perform queries 
	//mysqli_query($con,"SELECT * FROM Persons");
	$thisquery="update stockcurrent inner join products on stockcurrent.PRODUCT = products.ID
			set stockcurrent.UNITS=" . $qty .
			" WHERE products.CODE='" . $itemcode . "';";
	
	echo $thisquery;
	// exit(0); //only for testing, should be removed while in production
	//return; //test only code
	
	echo "<br />";
	
	$result = mysqli_query($conn,$thisquery) or die(mysql_error());
	
	// mysqli_query($con,"update stockcurrent
	// inner join products on stockcurrent.PRODUCT = products.ID
	// set stockcurrent.UNITS=" . 5 .
	// "WHERE products.CODE='" . 1000000000023 . "';");

	//closing mysql connection
	mysqli_close($conn);
	$conn = null;
	$thisquery="";
	
	//testing connection output for return value
	return $result; //"Item " . " uploaded successfully <br />";
	
    //exit(0);
	}
}


?>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Chromis Current Stock Update csv Upload</title>
  <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
 <body>
 
	<?php
		echo '<span class="label label-primary">page body</span>';
	?>

 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
 </body>
</html>