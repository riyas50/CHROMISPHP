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
                $conn->close();
                //exit();
                header('Location: estimate.php');
            }
            //header('Location: estimateremove.php?');

            if (isset($_GET['clear']))
            {
                if ($_GET['clear'] == "All")
                {
                    $conn = dbconn();
                    $delQuery = "delete from estimate";
                    //echo $idCode;
                    //echo $delQuery;
                    $result = mysqli_query($conn, $delQuery);
                    $idcode="";
                    $conn->close();
                    //exit();
                    header('Location: estimate.php');
                }
            }

    if (isset($_GET['addRec']) && isset($_GET['code']))
            {
                $code = $_GET['code'];
                $price = $_GET['addRec'];
                //echo $code . " " . $price;
                //exit();
                $conn = dbconn();
                $addQuery = "INSERT INTO estimate (CODE,PRICESELL,QUANTITY) VALUES ($code,$price,1) 
                ON DUPLICATE KEY UPDATE PRICESELL=$price,QUANTITY=1";
                $result = mysqli_query($conn, $addQuery);
                $conn->close();
                $code="";
                $price=0;
                //exit();
                header('Location: marginsearch.php');
            }

    if (isset($_GET['insertRec']) && isset($_GET['code']) && isset($_GET['qty']) )
            {
                $code = $_GET['code'];
                $price = $_GET['insertRec'];
                $qty = $_GET['qty'];
                //echo $code . " " . $price;
                //exit();
                $conn = dbconn();
                $addQuery = "INSERT INTO estimate (CODE,PRICESELL,QUANTITY) VALUES ($code,$price,$qty) 
                ON DUPLICATE KEY UPDATE PRICESELL=$price,QUANTITY=$qty";
                $result = mysqli_query($conn, $addQuery);
                $conn->close();
                $code="";
                $price=0;
                //exit();
                header('Location: marginsearch.php');
            }
    ?>