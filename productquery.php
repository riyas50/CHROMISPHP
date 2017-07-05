<?php
    
    include('dbconnect.php');
    function refreshRecords() {

        
            echo '<div class="panel panel-default">';  
            echo '<table class="table table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>BARCODE</th>';
            echo '<th>REFERENCE</th>';
            echo '<th>ITEM</th>';
            echo '<th>PRICE</th>';
            echo '<th>COST</th>';
            echo '<th>CATEGORY</th>';
            echo '<th>STOCK</th>';
            echo '<th>TAX TYPE</th>';
            echo '</tr>';
            echo '</thead>';

            $conn = dbConn();
        //========================================================================================================
        //below code generated with workbench plugin for php under tools > utilities
        $query = "SELECT   products.CODE 'BARCODE',   products.REFERENCE,   products.NAME,   
        products.PRICESELL,   products.PRICEBUY,   categories.NAME as 'CATEGORY',   
        stockcurrent.UNITS AS 'CURRENT STOCK',   taxes.NAME as 'TAX CATEGORY' 
        FROM stockcurrent   
        INNER JOIN products     ON stockcurrent.PRODUCT = products.ID   
        INNER JOIN categories     ON products.CATEGORY = categories.ID   
        INNER JOIN taxes     ON products.TAXCAT = taxes.ID";


        if ($stmt = $conn->prepare($query)) {
            $stmt->execute();
            $stmt->bind_result($CODE, $REFERENCE, $NAME, $PRICESELL, $PRICEBUY, $CATEGORY, $STOCK, $TAXCAT);
            while ($stmt->fetch()) {
                //printf("%s, %s, %s, %s, %s, %s, %s, %s\n", $CODE, $REFERENCE, $NAME, $PRICESELL, $PRICEBUY, $NAME1, $UNITS, $NAME3);
                        echo '<tbody>';
                        echo "<tr><td>". $CODE ."</td>";
                        echo "<td>". $REFERENCE ."</td>";
                        echo "<td>". $NAME ."</td>";
                        echo "<td>". $PRICESELL ."</td>";
                        echo "<td>". $PRICEBUY ."</td>";
                        echo "<td>". $CATEGORY ."</td>";
                        echo "<td>". $STOCK ."</td>";
                        echo "<td>". $TAXCAT ."</td>";
                        echo "</tr>";
                        echo '</tbody';
            }
            $stmt->close();
        }
        //========================================================================================================
             echo '</table>';
             echo '</div>';   
           
            mysqli_close($conn);
            $conn=null;
            $sql="";
        } 
        //function refreshrecords()

        function filterRecords($barcode,$item,$category) 
            {
            echo '<div class="panel panel-default">';  
            echo '<table class="table table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>BARCODE</th>';
            echo '<th>REFERENCE</th>';
            echo '<th>ITEM</th>';
            echo '<th>PRICE</th>';
            echo '<th>COST</th>';
            echo '<th>CATEGORY</th>';
            echo '<th>STOCK</th>';
            echo '<th>TAX TYPE</th>';
            echo '</tr>';
            echo '</thead>';

            $conn = dbConn();
        //========================================================================================================
        //below code generated with workbench plugin for php under tools > utilities
                $query = "SELECT   products.CODE 'BARCODE',   products.REFERENCE,  
                 products.NAME,   products.PRICESELL,   products.PRICEBUY,   
                 categories.NAME as 'CATEGORY',   stockcurrent.UNITS AS 'CURRENT STOCK',   
                 taxes.NAME as 'TAX CATEGORY' FROM stockcurrent   
                 INNER JOIN products     ON stockcurrent.PRODUCT = products.ID  
                 INNER JOIN categories     ON products.CATEGORY = categories.ID   
                 INNER JOIN taxes     ON products.TAXCAT = taxes.ID   
                 WHERE products.code like '%" . $barcode . "%'" .   
                 "AND products.NAME like '%" . $item . "%'" .   
                 "AND categories.NAME like '%" . $category . "%'";


                if ($stmt = $conn->prepare($query)) {
                $stmt->execute();
                $stmt->bind_result($CODE, $REFERENCE, $NAME, $PRICESELL, $PRICEBUY, $CATEGORY, $STOCK, $TAXCAT);

                echo '<tbody>';
                $noRecord=false;
                while ($stmt->fetch()) {
                    //printf("%s, %s, %s, %s, %s, %s, %s, %s\n", $CODE, $REFERENCE, $NAME, $PRICESELL, $PRICEBUY, $NAME1, $UNITS, $NAME3);
                        $noRecord = true;
                        echo "<tr><td>". $CODE ."</td>";
                        echo "<td>". $REFERENCE ."</td>";
                        echo "<td>". $NAME ."</td>";
                        echo "<td>". $PRICESELL ."</td>";
                        echo "<td>". $PRICEBUY ."</td>";
                        echo "<td>". $CATEGORY ."</td>";
                        echo "<td>". $STOCK ."</td>";
                        echo "<td>". $TAXCAT ."</td>";
                        echo "</tr>";
                        
                }
                if ($noRecord == false)
                {
                    echo "<tr><td class='bg-info text-center' colspan='8'>No records found!</td></tr>";
                }
                    echo '</table>';
                    echo '</div>';   
                $stmt->close();
            }
    }
    
    function putEmptyRow()
    {
        echo '<div class="panel panel-default">';  
        echo '<table class="table table-striped">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>BARCODE</th>';
        echo '<th>REFERENCE</th>';
        echo '<th>ITEM</th>';
        echo '<th>PRICE</th>';
        echo '<th>COST</th>';
        echo '<th>CATEGORY</th>';
        echo '<th>STOCK</th>';
        echo '<th>TAX TYPE</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        echo "<tr><td class='bg-info text-center' colspan='8'></td></tr>";
        echo '</tbody';
        echo '</table>';
        echo '</div>';  
    }
?>