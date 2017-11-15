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
            echo '<th>MRP</th>';
            echo '<th>PM</th>';
            echo '<th>@ 1</th>';
            echo '<th>@ 2</th>';
            echo '<th>@ 3</th>';
            echo '<th>@ 4</th>';
            echo '<th>@ 5</th>';
            echo '<th>@ 6</th>';
            echo '<th>@ 7</th>';
            echo '<th>@ 8</th>';
            echo '<th>@ 9</th>';
            echo '<th>@ 10</th>';
            echo '<th>CATEGORY</th>';
            echo '<th>STOCK</th>';
            echo '<th>TAX TYPE</th>';
            echo '</tr>';
            echo '</thead>';

            $conn = dbConn();
        //========================================================================================================
        //below code generated with workbench plugin for php under tools > utilities
        $query = "SELECT   products.CODE 'BARCODE',   (products.PRICEBUY*100) REF,   products.NAME,   
        products.PRICESELL,   
        ROUND((((products.PRICESELL - products.PRICEBUY) * 100)/products.PRICESELL),2) AS MRPMargin,   
        FORMAT((products.PRICEBUY / ((100-1)/100)),2) 'SELL 1PER',
        FORMAT((products.PRICEBUY / ((100-2)/100)),2) 'SELL 2PER',
        FORMAT((products.PRICEBUY / ((100-3)/100)),2) 'SELL 3PER',
        FORMAT((products.PRICEBUY / ((100-4)/100)),2) 'SELL 4PER',
        FORMAT((products.PRICEBUY / ((100-5)/100)),2) 'SELL 5PER',
        FORMAT((products.PRICEBUY / ((100-6)/100)),2) 'SELL 6PER',
        FORMAT((products.PRICEBUY / ((100-7)/100)),2) 'SELL 7PER',
        FORMAT((products.PRICEBUY / ((100-8)/100)),2) 'SELL 8PER',
        FORMAT((products.PRICEBUY / ((100-9)/100)),2) 'SELL 9PER',
        FORMAT((products.PRICEBUY / ((100-10)/100)),2) 'SELL 10PER',        
        categories.NAME as 'CATEGORY',   
        stockcurrent.UNITS AS 'CURRENT STOCK',   taxes.NAME as 'TAX CATEGORY' 
        FROM stockcurrent   
        INNER JOIN products     ON stockcurrent.PRODUCT = products.ID   
        INNER JOIN categories     ON products.CATEGORY = categories.ID   
        INNER JOIN taxes     ON products.TAXCAT = taxes.ID";


        if ($stmt = $conn->prepare($query)) {
            $stmt->execute();
            $stmt->bind_result($CODE, $REFERENCE, $NAME, $PRICESELL, $MRPMARGIN,$SELL1PER,$SELL2PER,$SELL3PER,$SELL4PER,$SELL5PER,$SELL6PER,$SELL7PER,$SELL8PER,$SELL9PER,$SELL10PER,$CATEGORY, $STOCK, $TAXCAT);
            while ($stmt->fetch()) {
                //printf("%s, %s, %s, %s, %s, %s, %s, %s\n", $CODE, $REFERENCE, $NAME, $PRICESELL, $PRICEBUY, $NAME1, $UNITS, $NAME3);
                        echo '<tbody>';
                        echo "<tr><td>". $CODE ."</td>";
                        echo "<td>". $REFERENCE ."</td>";
                        echo "<td>". $NAME ."</td>";
                        echo "<td>". number_format($PRICESELL,2,'.','') ."</td>";
                        if($MRPMARGIN<=0)
                        {echo "<td align=\"right\" bgcolor=\"#f4511e\">". $MRPMARGIN ."</td>";}
                        else{echo "<td>". $MRPMARGIN ."</td>";}
                        echo "<td bgcolor=\"#001f3f\">" . "<font color=\"#7fdbff\">" . $SELL1PER . "</font>" . "</td>";
                        echo "<td bgcolor=\"#0074D9\">". "<font color=\"#fff\">" . $SELL2PER . "</font>" . "</td>";
                        echo "<td bgcolor=\"#7FDBFF\">". "<font color=\"#333\">" . $SELL3PER . "</font>" . "</td>";
                        echo "<td bgcolor=\"#2ECC40\">". "<font color=\"#fff\">" . $SELL4PER . "</font>" . "</td>";
                        echo "<td bgcolor=\"#FFDC00\">" . "<font color=\"#000\">" . $SELL5PER . "</font>" . "</td>";
                        echo "<td bgcolor=\"#111111\">" . "<font color=\"#fff\">" . $SELL6PER . "</font>" . "</td>";
                        echo "<td bgcolor=\"#FF851B\">" . "<font color=\"#fff\">" . $SELL7PER . "</font>" . "</td>";
                        echo "<td bgcolor=\"#F012BE\">" . "<font color=\"#fff\">" . $SELL8PER . "</font>" . "</td>";
                        echo "<td bgcolor=\"#39CCCC\">" . "<font color=\"#fff\">" . $SELL9PER . "</font>" . "</td>";
                        echo "<td bgcolor=\"#FF4136\">" . "<font color=\"#fff\">" . $SELL10PER . "</font>" . "</td>";
 
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
            echo '<th>MRP</th>';
            echo '<th>PM</th>';
            echo '<th>@ 1</th>';
            echo '<th>@ 2</th>';
            echo '<th>@ 3</th>';
            echo '<th>@ 4</th>';
            echo '<th>@ 5</th>';
            echo '<th>@ 6</th>';
            echo '<th>@ 7</th>';
            echo '<th>@ 8</th>';
            echo '<th>@ 9</th>';
            echo '<th>@ 10</th>';            
            echo '<th>CATEGORY</th>';
            echo '<th>STOCK</th>';
            echo '<th>TAX TYPE</th>';
            echo '</tr>';
            echo '</thead>';

            $conn = dbConn();
        //========================================================================================================
        //below code generated with workbench plugin for php under tools > utilities
                $query = "SELECT   products.CODE 'BARCODE',   (products.PRICEBUY*100) REF,  
                 products.NAME,   products.PRICESELL,   
                ROUND((((products.PRICESELL - products.PRICEBUY) * 100)/products.PRICESELL),2) AS MRPMargin,
                FORMAT((products.PRICEBUY / ((100-1)/100)),2) 'SELL 1PER',
                FORMAT((products.PRICEBUY / ((100-2)/100)),2) 'SELL 2PER',
                FORMAT((products.PRICEBUY / ((100-3)/100)),2) 'SELL 3PER',
                FORMAT((products.PRICEBUY / ((100-4)/100)),2) 'SELL 4PER',
                FORMAT((products.PRICEBUY / ((100-5)/100)),2) 'SELL 5PER',
                FORMAT((products.PRICEBUY / ((100-6)/100)),2) 'SELL 6PER',
                FORMAT((products.PRICEBUY / ((100-7)/100)),2) 'SELL 7PER',
                FORMAT((products.PRICEBUY / ((100-8)/100)),2) 'SELL 8PER',
                FORMAT((products.PRICEBUY / ((100-9)/100)),2) 'SELL 9PER',
                FORMAT((products.PRICEBUY / ((100-10)/100)),2) 'SELL 10PER',                 
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
                $stmt->bind_result($CODE, $REFERENCE, $NAME, $PRICESELL, $MRPMARGIN,$SELL1PER,$SELL2PER,$SELL3PER,$SELL4PER,$SELL5PER,$SELL6PER,$SELL7PER,$SELL8PER,$SELL9PER,$SELL10PER,$CATEGORY, $STOCK, $TAXCAT);

                echo '<tbody>';
                $noRecord=false;
                while ($stmt->fetch()) {
                    //printf("%s, %s, %s, %s, %s, %s, %s, %s\n", $CODE, $REFERENCE, $NAME, $PRICESELL, $PRICEBUY, $NAME1, $UNITS, $NAME3);
                        $noRecord = true;
                        echo "<tr><td>". $CODE ."</td>";
                        echo "<td>". $REFERENCE ."</td>";
                        echo "<td>". $NAME ."</td>";
                        echo "<td>". number_format($PRICESELL,2,'.','') ."</td>";
                        if($MRPMARGIN<=0)
                        {echo "<td align=\"right\" bgcolor=\"#f4511e\">". $MRPMARGIN ."</td>";}
                        else{echo "<td>". $MRPMARGIN ."</td>";}
                        echo "<td bgcolor=\"#001f3f\">" . "<font color=\"#7fdbff\">" . $SELL1PER . "</font>" . "</td>";
                        echo "<td bgcolor=\"#0074D9\">". "<font color=\"#fff\">" . $SELL2PER . "</font>" . "</td>";
                        echo "<td bgcolor=\"#7FDBFF\">". "<font color=\"#333\">" . $SELL3PER . "</font>" . "</td>";
                        echo "<td bgcolor=\"#2ECC40\">". "<font color=\"#fff\">" . $SELL4PER . "</font>" . "</td>";
                        echo "<td bgcolor=\"#FFDC00\">" . "<font color=\"#000\">" . $SELL5PER . "</font>" . "</td>";
                        echo "<td bgcolor=\"#111111\">" . "<font color=\"#fff\">" . $SELL6PER . "</font>" . "</td>";
                        echo "<td bgcolor=\"#FF851B\">" . "<font color=\"#fff\">" . $SELL7PER . "</font>" . "</td>";
                        echo "<td bgcolor=\"#F012BE\">" . "<font color=\"#fff\">" . $SELL8PER . "</font>" . "</td>";
                        echo "<td bgcolor=\"#39CCCC\">" . "<font color=\"#fff\">" . $SELL9PER . "</font>" . "</td>";
                        echo "<td bgcolor=\"#FF4136\">" . "<font color=\"#fff\">" . $SELL10PER . "</font>" . "</td>";
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