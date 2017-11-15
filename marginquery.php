<?php
    
    include('dbconnect.php');
    function refreshRecords() {

        
            echo '<div class="panel panel-default">';  
            echo '<table class="table table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo "<th>BARCODE</th>";
            echo "<th>REFERENCE</th>";
            echo "<th>ITEM</th>";
            echo "<th>MRP</th>";
            echo "<th>PM</th>";
            echo "<th class=\"text-center\">12</th>";
            echo "<th class=\"text-center\">11</th>";
            echo "<th class=\"text-center\">10</th>";
            echo "<th class=\"text-center\">09</th>";
            echo "<th class=\"text-center\">08</th>";
            echo "<th class=\"text-center\">07</th>";
            echo "<th class=\"text-center\">06</th>";
            echo "<th class=\"text-center\">05</th>";
            echo "<th class=\"text-center\">04</th>";
            echo "<th class=\"text-center\">03</th>";
            echo "<th class=\"text-center\">02</th>";
            echo "<th class=\"text-center\">01</th>";
            //echo "<th>CATEGORY</th>";
            echo "<th class=\"text-center\">STOCK</th>";
            //echo "<th>TAX TYPE</th>";
            echo '</tr>';
            echo '</thead>';

            $conn = dbConn();
        //========================================================================================================
        //below code generated with workbench plugin for php under tools > utilities
        $query = "SELECT   
        products.CODE BARCODE,   
        (products.PRICEBUY*100) REF,   
        products.NAME NAME,   
        products.PRICESELL PRICESELL,   
        ROUND((((products.PRICESELL - products.PRICEBUY) * 100)/products.PRICESELL),2) MP,   
        FORMAT((products.PRICEBUY / ((100-12)/100)),2) 'SELL 12PER',
        FORMAT((products.PRICEBUY / ((100-11)/100)),2) 'SELL 11PER',
        FORMAT((products.PRICEBUY / ((100-10)/100)),2) 'SELL 10PER',
        FORMAT((products.PRICEBUY / ((100-9)/100)),2) 'SELL 09PER',
        FORMAT((products.PRICEBUY / ((100-8)/100)),2) 'SELL 08PER',
        FORMAT((products.PRICEBUY / ((100-7)/100)),2) 'SELL 07PER',
        FORMAT((products.PRICEBUY / ((100-6)/100)),2) 'SELL 06PER',
        FORMAT((products.PRICEBUY / ((100-5)/100)),2) 'SELL 05PER',
        FORMAT((products.PRICEBUY / ((100-4)/100)),2) 'SELL 04PER',
        FORMAT((products.PRICEBUY / ((100-3)/100)),2) 'SELL 03PER',
        FORMAT((products.PRICEBUY / ((100-2)/100)),2) 'SELL 02PER',
        FORMAT((products.PRICEBUY / ((100-1)/100)),2) 'SELL 01PER',        
        categories.NAME as 'CATEGORY',   
        stockcurrent.UNITS AS 'CURRENT STOCK',   
        taxes.NAME as 'TAX CATEGORY' 
        FROM stockcurrent   
        INNER JOIN products     ON stockcurrent.PRODUCT = products.ID   
        INNER JOIN categories     ON products.CATEGORY = categories.ID   
        INNER JOIN taxes     ON products.TAXCAT = taxes.ID";

//18
        if ($stmt = $conn->prepare($query)) {
            $stmt->execute();
            $stmt->bind_result($CODE, $REFERENCE, $NAME, $PRICESELL, $MRPMARGIN,$SELL12PER,$SELL11PER,$SELL10PER,$SELL9PER,$SELL8PER,$SELL7PER,$SELL6PER,$SELL5PER,$SELL4PER,$SELL3PER,$SELL2PER,$SELL1PER,$CATEGORY, $STOCK, $TAXCAT);
            while ($stmt->fetch()) {
                //printf("%s, %s, %s, %s, %s, %s, %s, %s\n", $CODE, $REFERENCE, $NAME, $PRICESELL, $PRICEBUY, $NAME1, $UNITS, $NAME3);
                        echo '<tbody>';
                        echo "<tr>"; 
                        echo "<td>". $CODE ."</td>";
                        echo "<td>". "12." . $REFERENCE ."</td>";
                        echo "<td>". $NAME ."</td>";
                        echo "<td>". number_format($PRICESELL,2,'.','') ."</td>";
                        if($MRPMARGIN<=0)
                        {echo "<td align=\"right\" bgcolor=\"#f4511e\">". $MRPMARGIN ."</td>";}
                        else{echo "<td>". $MRPMARGIN ."</td>";}

                        echo "<td class=\"text-center\" bgcolor=\"#001f3f\">" . "<font color=\"#7fdbff\">" . $SELL12PER . 
                        "<br />" . ($MRPMARGIN-12) . "</font>" . "</td>";
                        echo "<td class=\"text-center\" bgcolor=\"#0074D9\">". "<font color=\"#fff\">" . $SELL11PER . 
                        "<br />" . ($MRPMARGIN-11) . "</font>" . "</td>";
                        echo "<td class=\"text-center\" bgcolor=\"#7FDBFF\">". "<font color=\"#333\">" . $SELL10PER . 
                        "<br />" . ($MRPMARGIN-10) . "</font>" . "</td>";
                        echo "<td class=\"text-center\" bgcolor=\"#2ECC40\">". "<font color=\"#fff\">" . $SELL9PER . 
                        "<br />" . ($MRPMARGIN-9) . "</font>" . "</td>";
                        echo "<td class=\"text-center\" bgcolor=\"#FFDC00\">" . "<font color=\"#000\">" . $SELL8PER . 
                        "<br />" . ($MRPMARGIN-8) . "</font>" . "</td>";
                        echo "<td class=\"text-center\" bgcolor=\"#111111\">" . "<font color=\"#fff\">" . $SELL7PER . 
                        "<br />" . ($MRPMARGIN-7) . "</font>" . "</td>";
                        echo "<td class=\"text-center\" bgcolor=\"#FF851B\">" . "<font color=\"#fff\">" . $SELL6PER . 
                        "<br />" . ($MRPMARGIN-6) . "</font>" . "</td>";
                        echo "<td class=\"text-center\" bgcolor=\"#F012BE\">" . "<font color=\"#fff\">" . $SELL5PER . 
                        "<br />" . ($MRPMARGIN-5) . "</font>" . "</td>";
                        echo "<td class=\"text-center\" bgcolor=\"#39CCCC\">" . "<font color=\"#fff\">" . $SELL4PER . 
                        "<br />" . ($MRPMARGIN-4) . "</font>" . "</td>";
                        echo "<td class=\"text-center\" bgcolor=\"#FF4136\">" . "<font color=\"#fff\">" . $SELL3PER . 
                        "<br />" . ($MRPMARGIN-3) . "</font>" . "</td>";
                        echo "<td class=\"text-center\" bgcolor=\"#FF4136\">" . "<font color=\"#fff\">" . $SELL2PER . 
                        "<br />" . ($MRPMARGIN-2) . "</font>" . "</td>";
                        echo "<td class=\"text-center\" bgcolor=\"#FF4136\">" . "<font color=\"#fff\">" . $SELL1PER . 
                        "<br />" . ($MRPMARGIN-1) . "</font>" . "</td>";
                        //echo "<td>". $CATEGORY ."</td>";
                        echo "<td class=\"text-center\">". $STOCK ."</td>";
                        //echo "<td>". $TAXCAT ."</td>";
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
            echo "<th>BARCODE</th>";
            echo "<th>REFERENCE</th>";
            echo "<th>ITEM</th>";
            echo "<th>MRP</th>";
            echo "<th>PM</th>";
            echo "<th class=\"text-center\">12</th>";
            echo "<th class=\"text-center\">11</th>";
            echo "<th class=\"text-center\">10</th>";
            echo "<th class=\"text-center\">09</th>";
            echo "<th class=\"text-center\">08</th>";
            echo "<th class=\"text-center\">07</th>";
            echo "<th class=\"text-center\">06</th>";
            echo "<th class=\"text-center\">05</th>";
            echo "<th class=\"text-center\">04</th>";
            echo "<th class=\"text-center\">03</th>";
            echo "<th class=\"text-center\">02</th>";
            echo "<th class=\"text-center\">01</th>";
            //echo "<th>CATEGORY</th>";
            echo "<th class=\"text-center\">STOCK</th>";
            //echo "<th>TAX TYPE</th>";
            echo '</tr>';
            echo '</thead>';

            $conn = dbConn();
        //========================================================================================================
        //below code generated with workbench plugin for php under tools > utilities
                $query = "SELECT   products.CODE 'BARCODE',   (products.PRICEBUY*100) REF,  
                 products.NAME,   products.PRICESELL,   
                ROUND((((products.PRICESELL - products.PRICEBUY) * 100)/products.PRICESELL),2) AS MRPMargin,
                FORMAT((products.PRICEBUY / ((100-12)/100)),2) 'SELL 12PER',
                FORMAT((products.PRICEBUY / ((100-11)/100)),2) 'SELL 11PER',
                FORMAT((products.PRICEBUY / ((100-10)/100)),2) 'SELL 10PER',
                FORMAT((products.PRICEBUY / ((100-9)/100)),2) 'SELL 09PER',
                FORMAT((products.PRICEBUY / ((100-8)/100)),2) 'SELL 08PER',
                FORMAT((products.PRICEBUY / ((100-7)/100)),2) 'SELL 07PER',
                FORMAT((products.PRICEBUY / ((100-6)/100)),2) 'SELL 06PER',
                FORMAT((products.PRICEBUY / ((100-5)/100)),2) 'SELL 05PER',
                FORMAT((products.PRICEBUY / ((100-4)/100)),2) 'SELL 04PER',
                FORMAT((products.PRICEBUY / ((100-3)/100)),2) 'SELL 03PER',
                FORMAT((products.PRICEBUY / ((100-2)/100)),2) 'SELL 02PER',
                FORMAT((products.PRICEBUY / ((100-1)/100)),2) 'SELL 01PER',                
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
                $stmt->bind_result($CODE, $REFERENCE, $NAME, $PRICESELL, $MRPMARGIN,$SELL12PER,$SELL11PER,$SELL10PER,$SELL9PER,$SELL8PER,$SELL7PER,$SELL6PER,$SELL5PER,$SELL4PER,$SELL3PER,$SELL2PER,$SELL1PER,$CATEGORY, $STOCK, $TAXCAT);

                echo '<tbody>';
                $noRecord=false;
                while ($stmt->fetch()) {
                    //printf("%s, %s, %s, %s, %s, %s, %s, %s\n", $CODE, $REFERENCE, $NAME, $PRICESELL, $PRICEBUY, $NAME1, $UNITS, $NAME3);
                        $noRecord = true;
                        echo "<tr>"; 
                        echo "<td>". $CODE ."</td>";
                        echo "<td>" . "12." . $REFERENCE ."</td>";
                        echo "<td>". $NAME ."</td>";
                        echo "<td>". number_format($PRICESELL,2,'.','') ."</td>";
                        if($MRPMARGIN<=0)
                        {echo "<td align=\"right\" bgcolor=\"#f4511e\">". $MRPMARGIN ."</td>";}
                        else{echo "<td>". $MRPMARGIN ."</td>";}

                        echo "<td class=\"text-center\" bgcolor=\"#001f3f\">" . "<font color=\"#7fdbff\">" . $SELL12PER . 
                        "<br />" . ($MRPMARGIN-12) . "</font>" . "</td>";
                        echo "<td class=\"text-center\" bgcolor=\"#0074D9\">". "<font color=\"#fff\">" . $SELL11PER . 
                        "<br />" . ($MRPMARGIN-11) . "</font>" . "</td>";
                        echo "<td class=\"text-center\" bgcolor=\"#7FDBFF\">". "<font color=\"#333\">" . $SELL10PER . 
                        "<br />" . ($MRPMARGIN-10) . "</font>" . "</td>";
                        echo "<td class=\"text-center\" bgcolor=\"#2ECC40\">". "<font color=\"#fff\">" . $SELL9PER . 
                        "<br />" . ($MRPMARGIN-9) . "</font>" . "</td>";
                        echo "<td class=\"text-center\" bgcolor=\"#FFDC00\">" . "<font color=\"#000\">" . $SELL8PER . 
                        "<br />" . ($MRPMARGIN-8) . "</font>" . "</td>";
                        echo "<td class=\"text-center\" bgcolor=\"#111111\">" . "<font color=\"#fff\">" . $SELL7PER . 
                        "<br />" . ($MRPMARGIN-7) . "</font>" . "</td>";
                        echo "<td class=\"text-center\" bgcolor=\"#FF851B\">" . "<font color=\"#fff\">" . $SELL6PER . 
                        "<br />" . ($MRPMARGIN-6) . "</font>" . "</td>";
                        echo "<td class=\"text-center\" bgcolor=\"#F012BE\">" . "<font color=\"#fff\">" . $SELL5PER . 
                        "<br />" . ($MRPMARGIN-5) . "</font>" . "</td>";
                        echo "<td class=\"text-center\" bgcolor=\"#39CCCC\">" . "<font color=\"#fff\">" . $SELL4PER . 
                        "<br />" . ($MRPMARGIN-4) . "</font>" . "</td>";
                        echo "<td class=\"text-center\" bgcolor=\"#FF4136\">" . "<font color=\"#fff\">" . $SELL3PER . 
                        "<br />" . ($MRPMARGIN-3) . "</font>" . "</td>";
                        echo "<td class=\"text-center\" bgcolor=\"#FF4136\">" . "<font color=\"#fff\">" . $SELL2PER . 
                        "<br />" . ($MRPMARGIN-2) . "</font>" . "</td>";
                        echo "<td class=\"text-center\" bgcolor=\"#FF4136\">" . "<font color=\"#fff\">" . $SELL1PER . 
                        "<br />" . ($MRPMARGIN-1) . "</font>" . "</td>";
                        //echo "<td>". $CATEGORY ."</td>";
                        echo "<td class=\"text-center\">". $STOCK ."</td>";
                        //echo "<td>". $TAXCAT ."</td>";
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
        echo "<th>BARCODE</th>";
        echo "<th>REFERENCE</th>";
        echo "<th>ITEM</th>";
        echo "<th>PRICE</th>";
        echo "<th>COST</th>";
        echo "<th>CATEGORY</th>";
        echo "<th>STOCK</th>";
        echo "<th>TAX TYPE</th>";
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        echo "<tr><td class='bg-info text-center' colspan='8'></td></tr>";
        echo '</tbody';
        echo '</table>';
        echo '</div>';  
    }
?>