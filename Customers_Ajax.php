<?php

//Including Database configuration file.

include('dbconnect.php');

//Getting value of "inlineFormInputGroup" variable from "script.js".

if (isset($_POST['inlineFormInputGroup'])) {

//call dbconn
$conn = dbConn();

//inlineFormInputGroup box value assigning to $Name variable.
$Name = $_POST['inlineFormInputGroup'];

//inlineFormInputGroup query.
$Query = "SELECT * FROM view_allcustomers WHERE Name LIKE '%$Name%' LIMIT 10";

//Query execution
$ExecQuery = MySQLi_query($conn, $Query);


//Creating unordered list to display result.
?>
<ul class="list-unstyled text-left text-info">

<?php
//Fetching result from database.

while ($Result = MySQLi_fetch_array($ExecQuery)) {

?>

<!-- Creating unordered list items.

  Calling javascript function named as "fill" found in "script.js" file.

  By passing fetched result as parameter. -->

<li id=<?php echo $Result[0]; ?> onclick='fill("<?php echo $Result[1];?>","<?php echo $Result[0]; ?>")'>

<a class="list-group-item">

<!-- Assigning inlineFormInputGrouped result in "inlineFormInputGroup box" in "inlineFormInputGroup.php" file. -->

 <?php echo $Result[1]; ?>

</li></a>

<!-- Below php code is just for closing parenthesis. Don't be confused. -->

<?php
}}
?>
</ul>


