<?php
        include('dbconnect.php');
        include('general.php');
        putLinks();
    
    
    if (isset($_GET['delrec']))
            {
                $idCode = $_GET['delrec'];
                $conn = dbconn();
                $delQuery = "delete from estimate where CODE='" . $idCode . "'";
                //echo $idCode;
                //echo $delQuery;
                $result = mysqli_query($conn, $delQuery);
                $idcode="";
            }
            //header('Location: estimateremove.php?');
    ?>