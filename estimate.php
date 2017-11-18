<!DOCTYPE html>
<html lang="en">
  <head>
  <?php
        require_once('dbconnect.php');
        include('general.php');
        putLinks();
    ?>
  </head>
  <body>
  <form action="/estimate.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-12">
                <?php
                $conn = dbConn();
                $Query = "SELECT e.CODE CODE,p.NAME NAME,e.PRICESELL PRICESELL,e.QUANTITY QUANTITY
                            FROM estimate e
                            INNER JOIN products p on p.CODE = e.CODE";
                if($records  = $conn->prepare($Query))
                {
                    $records->execute();
                    $records->bind_result($CODE,$NAME,$PRICESELL,$QUANTITY);
                    echo "<table class=\"table table-table-striped\">";
                    echo '<thead>';
                    echo '<tr>';
                    echo "<th>BARCODE</th>";
                    echo "<th>ITEM</th>";
                    echo "<th>PRICE</th>";
                    echo "<th class=\"text-center\">QTY</th>";
                    echo "<th class=\"text-center\">Total</th>";
                    //echo "<th class=\"text-center text-danger glyphicon glyphicon-remove\"></th>";
                    echo "<th class=\"text-center\"><a href=\"./estimateActions.php?clear=All\"><span class=\"glyphicon glyphicon-remove text-danger \"></span></a></th>";
                    echo "<tbody>";
                    while($records->fetch())
                    {
                        echo "<tr>";
                            echo "<td>";
                                echo $CODE;
                            echo "</td>";
                            echo "<td>";
                                echo $NAME;
                            echo "</td>";
                            echo "<td class=\"text-center\">";
                                echo number_format(floatval($PRICESELL),2);
                            echo "</td>";
                            echo "<td class=\"text-center\">";
                                echo $QUANTITY;
                            echo "</td>";
                            echo "<td class=\"text-center\">";
                                echo number_format(floatval($PRICESELL*$QUANTITY),2);
                            echo "</td>";
                            echo "<td class=\"text-center\">";
                                echo "<a href=\"./estimateActions.php?delrec=$CODE\"><span class=\"glyphicon glyphicon-remove text-danger \"></span></a>";
                            echo "</td>";
                        echo "</tr>";

                    }
                    echo "</tbody>";
                    echo "</table>";
                }

                $records->close();
                mysqli_close($conn);
                $conn=null;
                $Query ="";
                ?>
            </div>
        </div>

        <?php
            //include('general.php');
            putScripts();
            //stickfooter();
        ?>
</form>
</body>
</html>