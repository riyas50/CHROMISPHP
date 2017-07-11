<?php
include('dbconnect.php');
$itemname = "";

function searchBarcode($barcode) 
{

        $conn = dbConn();
        $truefalse = false;

        $query = "SELECT NAME FROM products WHERE CODE=$barcode";

        if ($stmt = $conn->prepare($query)) {
            $stmt->execute();
            $stmt->bind_result($NAME);
            while ($stmt->fetch()) {
                //printf("%s \n",$NAME3);
               $GLOBALS['itemname'] = $NAME;
               $truefalse = true;
               //echo $GLOBALS["itemname"];
            }
            
        }
        if (!$truefalse) 
        {
            $GLOBALS['itemname'] = "Item Not Found!";
            $truefalse = false;
            //echo $GLOBALS['itemname'];
        }
        $stmt->close();
        //========================================================================================================
        mysqli_close($conn);
        $conn=null;
        $sql="";
        return $truefalse;
} 

function newPurchase($barcode,$quantity,$buyPrice)
{
            prepareOutputTableHeader();
            
            if (!searchBarcode($barcode))
            {
                echo '<tbody>';
                echo "<tr>";
                echo "<td>$barcode</td>";
                echo "<td>" . $GLOBALS['itemname'] . "</td>";
                echo "<td>$quantity</td>";
                echo "<td>$buyPrice</td>";
                echo "<td><span class='glyphicon glyphicon-remove text-danger'></span></td>";
                echo "</tr>";
                finalizeOutputTable();
                return;
            }
            
            $conn = dbConn();
            
            $sql = "CALL PRODPURCHASE (now(),1,0,$barcode,$quantity,$buyPrice,'Navas')";
            
            //echo $sql;
            
            $result = mysqli_query($conn, $sql);

            if ($result) {

                echo '<tbody>';
                echo "<tr>";
                echo "<td>$barcode</td>";
                echo "<td>" . $GLOBALS['itemname'] . "</td>";
                echo "<td>$quantity</td>";
                echo "<td>$buyPrice</td>";
                echo "<td><span class='glyphicon glyphicon-ok text-center text-success'></span></td>";
                echo "</tr>";
                

                //echo '<div class="label label-success">' . 'Record updated!' . '</div>';
                //echo "<meta http-equiv='refresh' content='0'>";
            }
            else
            {
                echo '<tbody>';
                echo "<tr>";
                echo '<td>' . $barcode . '</td>';
                echo '<td>' . $GLOBALS['itemname'] . '</td>';
                echo '<td >' . $quantity . '</td>';
                echo '<td>' . $buyPrice . '</td>';
                echo '<td><span class="glyphicon glyphicon-remove text-center text-danger"></span></td>';
                echo "</tr>";
                
                //echo '<div class="label label-danger">' . 'failed to save!' . '</div>';
            }
            finalizeOutputTable();
            mysqli_close($conn);
            $conn=null;
            $sql="";
}   

function prepareOutputTableHeader()
{
            //echo '<div class="panel panel-default">';  
            //echo '<div class="row">';
            //echo '<div class="col-lg-2></div>';
            //echo '<div class="col-lg-8>';
            
            echo '<div class="table-responsive">';  
            echo '<center>';
            echo '<table class="table table-striped" style="width:100%;">';
            echo '<thead">';
            echo '<tr>';
            echo '<th>BARCODE</th>';
            echo '<th>ITEM</th>';
            echo '<th>QUANTITY</th>';
            echo '<th>COST</th>';
            echo '<th>STATUS</th>';
            echo '</tr>';
            echo '</thead>';
}
function finalizeOutputTable()
{
    echo '<tr></tr>';
    echo '</tbody';
    echo '</table>';
    echo '</center>';
    //echo '</div>'; //col-lg-10
    //echo '<div class="col-lg-2></div>';
    //echo '</div>'; //row
}
?>