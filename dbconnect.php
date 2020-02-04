<?php
function dbConn() {
        $servername = "localhost";
        $username = "root";
        $password = "access";
        //$dbname = "chromispos"; 
        $dbname = "grand_live_db"; //local restore of Grand live database
        //$dbname = "grandchromis"; //local - 5.6.26	MySQL Community Server (GPL)	x86	Win32

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $conn;
}
?>