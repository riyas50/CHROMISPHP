<?php
    
    include('dbconnect.php');
    function refreshRecords() 
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
        $query = "SELECT   
        products.CODE BARCODE,   
        (products.PRICEBUY*100) REF,   
        products.NAME NAME,   
        products.PRICESELL PRICESELL,   
        ROUND((((products.PRICESELL - products.PRICEBUY) * 100)/products.PRICESELL),2) MP,   
        FORMAT((products.PRICEBUY / ((100-24)/100)),2) 'SELL 24PER',
        FORMAT((products.PRICEBUY / ((100-23)/100)),2) 'SELL 23PER',
        FORMAT((products.PRICEBUY / ((100-22)/100)),2) 'SELL 22PER',
        FORMAT((products.PRICEBUY / ((100-21)/100)),2) 'SELL 21PER',
        FORMAT((products.PRICEBUY / ((100-20)/100)),2) 'SELL 20PER',
        FORMAT((products.PRICEBUY / ((100-19)/100)),2) 'SELL 19PER',
        FORMAT((products.PRICEBUY / ((100-18)/100)),2) 'SELL 18PER',
        FORMAT((products.PRICEBUY / ((100-17)/100)),2) 'SELL 17PER',
        FORMAT((products.PRICEBUY / ((100-16)/100)),2) 'SELL 16PER',
        FORMAT((products.PRICEBUY / ((100-15)/100)),2) 'SELL 15PER',
        FORMAT((products.PRICEBUY / ((100-14)/100)),2) 'SELL 14PER',
        FORMAT((products.PRICEBUY / ((100-13)/100)),2) 'SELL 13PER',
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


        if ($stmt = $conn->prepare($query)) {
            $stmt->execute();
            $stmt->bind_result($CODE, $REFERENCE, $NAME, $PRICESELL, $MRPMARGIN,$SELL24PER,$SELL23PER,$SELL22PER,$SELL21PER,$SELL20PER,$SELL19PER,$SELL18PER,$SELL17PER,$SELL16PER,$SELL15PER,$SELL14PER,$SELL13PER,$SELL12PER,$SELL11PER,$SELL10PER,$SELL9PER,$SELL8PER,$SELL7PER,$SELL6PER,$SELL5PER,$SELL4PER,$SELL3PER,$SELL2PER,$SELL1PER,$CATEGORY, $STOCK, $TAXCAT);
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


                        echo "<td class=\"text-center\" bgcolor=\"#001f3f\">" . "<font color=\"#7fdbff\">" . 
                        number_format(floatval($SELL12PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL12PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .                        
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL12PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-12)),2) . "<br />" .
                        "---------" .
                        "<br />" . "24" . "<br />" . 
                        number_format(floatval($SELL24PER),2) . "<br />" .
                        "<a href=\"./estimateActions.php?addRec=$SELL24PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" . 
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL24PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-24)),2) .
                        "</font>" . "</td>";

                        echo "<td class=\"text-center\" bgcolor=\"#0074D9\">". "<font color=\"#fff\">" . 
                        number_format(floatval($SELL11PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL11PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL11PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-11)),2) . "<br />" .
                        "---------" .
                        "<br />" . "23" ."<br />" . 
                        number_format(floatval($SELL23PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL23PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL23PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-23)),2) .
                        "</font>" . "</td>";
                        
                        echo "<td class=\"text-center\" bgcolor=\"#7FDBFF\">". "<font color=\"#333\">" . 
                        number_format(floatval($SELL10PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL10PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL10PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-10)),2) .  "<br />" .
                        "---------" .
                        "<br />" . "22" ."<br />" . number_format(floatval($SELL22PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL22PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL22PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-22)),2) .                        
                        "</font>" . "</td>";
                        
                        echo "<td class=\"text-center\" bgcolor=\"#2ECC40\">". "<font color=\"#fff\">" . 
                        number_format(floatval($SELL9PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL9PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL9PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-9)),2) . "<br />" .
                        "---------" .
                        "<br />" . "21" ."<br />" . 
                        number_format(floatval($SELL21PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL21PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL21PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-21)),2) .                          
                        "</font>" . "</td>";
                        
                        echo "<td class=\"text-center\" bgcolor=\"#FFDC00\">" . "<font color=\"#000\">" . 
                        number_format(floatval($SELL8PER),2) ."<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL8PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL8PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-8)),2) . "<br />" .
                        "---------" .
                        "<br />" . "20" ."<br />" . 
                        number_format(floatval($SELL20PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL20PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL20PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-20)),2) .                           
                        "</font>" . "</td>";
                        
                        echo "<td class=\"text-center\" bgcolor=\"#111111\">" . "<font color=\"#fff\">" .
                        number_format(floatval($SELL7PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL7PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL7PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-7)),2) . "<br />" .
                        "---------" .
                        "<br />" . "19" ."<br />" . 
                        number_format(floatval($SELL19PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL19PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL19PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-19)),2) .                           
                        "</font>" . "</td>";
                        
                        echo "<td class=\"text-center\" bgcolor=\"#FF851B\">" . "<font color=\"#fff\">" .
                        number_format(floatval($SELL6PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL6PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL6PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-6)),2) . "<br />" .
                        "---------" .
                        "<br />" . "18" ."<br />" . 
                        number_format(floatval($SELL18PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL18PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL18PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-18)),2) .                           
                        "</font>" . "</td>";
                        
                        echo "<td class=\"text-center\" bgcolor=\"#F012BE\">" . "<font color=\"#fff\">" . 
                        number_format(floatval($SELL5PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL5PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL5PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-5)),2) . "<br />" .
                        "---------" .
                        "<br />" . "17" ."<br />" . 
                        number_format(floatval($SELL17PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL17PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL17PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-17)),2) .                           
                        "</font>" . "</td>";
                        
                        echo "<td class=\"text-center\" bgcolor=\"#39CCCC\">" . "<font color=\"#fff\">" .
                        number_format(floatval($SELL4PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL4PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL4PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-4)),2) . "<br />" .
                        "---------" .
                        "<br />" . "16" ."<br />" . 
                        number_format(floatval($SELL16PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL16PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL16PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-16)),2) .                           
                        "</font>" . "</td>";
                        
                        echo "<td class=\"text-center\" bgcolor=\"#001f3f\">" . "<font color=\"#7fdbff\">" . 
                        number_format(floatval($SELL3PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL3PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL3PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-3)),2) . "<br />" .
                        "---------" .
                        "<br />" . "15" ."<br />" . 
                        number_format(floatval($SELL15PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL15PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL15PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-15)),2) .                           
                        "</font>" . "</td>";

                        
                        echo "<td class=\"text-center\" bgcolor=\"#0074D9\">". "<font color=\"#fff\">" . 
                        number_format(floatval($SELL2PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL2PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL2PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-2)),2) . "<br />" .
                        "---------" .
                        "<br />" . "14" ."<br />" . 
                        number_format(floatval($SELL14PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL14PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL14PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-14)),2) .                           
                        "</font>" . "</td>";
                        
                        echo "<td class=\"text-center\" bgcolor=\"#FF4136\">" . "<font color=\"#fff\">" .
                        number_format(floatval($SELL1PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL1PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL1PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-1)),2) . "<br />" .
                        "---------" .
                        "<br />" . "13" ."<br />" . 
                        number_format(floatval($SELL13PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL13PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL13PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-13)),2) .                                                     
                        "</font>" . "</td>";
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
                FORMAT((products.PRICEBUY / ((100-24)/100)),2) 'SELL 24PER',
                FORMAT((products.PRICEBUY / ((100-23)/100)),2) 'SELL 23PER',
                FORMAT((products.PRICEBUY / ((100-22)/100)),2) 'SELL 22PER',
                FORMAT((products.PRICEBUY / ((100-21)/100)),2) 'SELL 21PER',
                FORMAT((products.PRICEBUY / ((100-20)/100)),2) 'SELL 20PER',
                FORMAT((products.PRICEBUY / ((100-19)/100)),2) 'SELL 19PER',
                FORMAT((products.PRICEBUY / ((100-18)/100)),2) 'SELL 18PER',
                FORMAT((products.PRICEBUY / ((100-17)/100)),2) 'SELL 17PER',
                FORMAT((products.PRICEBUY / ((100-16)/100)),2) 'SELL 16PER',
                FORMAT((products.PRICEBUY / ((100-15)/100)),2) 'SELL 15PER',
                FORMAT((products.PRICEBUY / ((100-14)/100)),2) 'SELL 14PER',
                FORMAT((products.PRICEBUY / ((100-13)/100)),2) 'SELL 13PER',
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
                $stmt->bind_result($CODE, $REFERENCE, $NAME, $PRICESELL, $MRPMARGIN,$SELL24PER,$SELL23PER,$SELL22PER,$SELL21PER,$SELL20PER,$SELL19PER,$SELL18PER,$SELL17PER,$SELL16PER,$SELL15PER,$SELL14PER,$SELL13PER,$SELL12PER,$SELL11PER,$SELL10PER,$SELL9PER,$SELL8PER,$SELL7PER,$SELL6PER,$SELL5PER,$SELL4PER,$SELL3PER,$SELL2PER,$SELL1PER,$CATEGORY, $STOCK, $TAXCAT);

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

                        echo "<td class=\"text-center\" bgcolor=\"#001f3f\">" . "<font color=\"#7fdbff\">" . 
                        number_format(floatval($SELL12PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL12PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .                        
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL12PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-12)),2) . "<br />" .
                        "---------" .
                        "<br />" . "24" . "<br />" . 
                        number_format(floatval($SELL24PER),2) . "<br />" .
                        "<a href=\"./estimateActions.php?addRec=$SELL24PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" . 
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL24PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-24)),2) .
                        "</font>" . "</td>";

                        echo "<td class=\"text-center\" bgcolor=\"#0074D9\">". "<font color=\"#fff\">" . 
                        number_format(floatval($SELL11PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL11PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL11PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-11)),2) . "<br />" .
                        "---------" .
                        "<br />" . "23" ."<br />" . 
                        number_format(floatval($SELL23PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL23PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL23PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-23)),2) .
                        "</font>" . "</td>";
                        
                        echo "<td class=\"text-center\" bgcolor=\"#7FDBFF\">". "<font color=\"#333\">" . 
                        number_format(floatval($SELL10PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL10PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL10PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-10)),2) .  "<br />" .
                        "---------" .
                        "<br />" . "22" ."<br />" . number_format(floatval($SELL22PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL22PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL22PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-22)),2) .                        
                        "</font>" . "</td>";
                        
                        echo "<td class=\"text-center\" bgcolor=\"#2ECC40\">". "<font color=\"#fff\">" . 
                        number_format(floatval($SELL9PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL9PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL9PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-9)),2) . "<br />" .
                        "---------" .
                        "<br />" . "21" ."<br />" . 
                        number_format(floatval($SELL21PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL21PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL21PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-21)),2) .                          
                        "</font>" . "</td>";
                        
                        echo "<td class=\"text-center\" bgcolor=\"#FFDC00\">" . "<font color=\"#000\">" . 
                        number_format(floatval($SELL8PER),2) ."<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL8PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL8PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-8)),2) . "<br />" .
                        "---------" .
                        "<br />" . "20" ."<br />" . 
                        number_format(floatval($SELL20PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL20PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL20PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-20)),2) .                           
                        "</font>" . "</td>";
                        
                        echo "<td class=\"text-center\" bgcolor=\"#111111\">" . "<font color=\"#fff\">" .
                        number_format(floatval($SELL7PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL7PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL7PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-7)),2) . "<br />" .
                        "---------" .
                        "<br />" . "19" ."<br />" . 
                        number_format(floatval($SELL19PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL19PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL19PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-19)),2) .                           
                        "</font>" . "</td>";
                        
                        echo "<td class=\"text-center\" bgcolor=\"#FF851B\">" . "<font color=\"#fff\">" .
                        number_format(floatval($SELL6PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL6PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL6PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-6)),2) . "<br />" .
                        "---------" .
                        "<br />" . "18" ."<br />" . 
                        number_format(floatval($SELL18PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL18PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL18PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-18)),2) .                           
                        "</font>" . "</td>";
                        
                        echo "<td class=\"text-center\" bgcolor=\"#F012BE\">" . "<font color=\"#fff\">" . 
                        number_format(floatval($SELL5PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL5PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL5PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-5)),2) . "<br />" .
                        "---------" .
                        "<br />" . "17" ."<br />" . 
                        number_format(floatval($SELL17PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL17PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL17PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-17)),2) .                           
                        "</font>" . "</td>";
                        
                        echo "<td class=\"text-center\" bgcolor=\"#39CCCC\">" . "<font color=\"#fff\">" .
                        number_format(floatval($SELL4PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL4PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL4PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-4)),2) . "<br />" .
                        "---------" .
                        "<br />" . "16" ."<br />" . 
                        number_format(floatval($SELL16PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL16PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL16PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-16)),2) .                           
                        "</font>" . "</td>";
                        
                        echo "<td class=\"text-center\" bgcolor=\"#001f3f\">" . "<font color=\"#7fdbff\">" . 
                        number_format(floatval($SELL3PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL3PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL3PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-3)),2) . "<br />" .
                        "---------" .
                        "<br />" . "15" ."<br />" . 
                        number_format(floatval($SELL15PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL15PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL15PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-15)),2) .                           
                        "</font>" . "</td>";
                        
                        echo "<td class=\"text-center\" bgcolor=\"#0074D9\">". "<font color=\"#fff\">" . 
                        number_format(floatval($SELL2PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL2PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL2PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-2)),2) . "<br />" .
                        "---------" .
                        "<br />" . "14" ."<br />" . 
                        number_format(floatval($SELL14PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL14PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL14PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-14)),2) .                           
                        "</font>" . "</td>";
                        
                        echo "<td class=\"text-center\" bgcolor=\"#FF4136\">" . "<font color=\"#fff\">" .
                        number_format(floatval($SELL1PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL1PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL1PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-1)),2) . "<br />" .
                        "---------" .
                        "<br />" . "13" ."<br />" . 
                        number_format(floatval($SELL13PER),2) . "<br />" . 
                        "<a href=\"./estimateActions.php?addRec=$SELL13PER&code=$CODE\"><span class=\"badge\">select</span></a>" . "<br />" .
                        "<a href=\"#\" data-toggle=\"modal\" data-target=\"#distmodal\" data-quantity=\"1\" data-barcode=$CODE data-itemdesc=$NAME data-price=$SELL13PER><span class=\"badge\">select</span></a>" . "<br />" . 
                        number_format(floatval(($MRPMARGIN-13)),2) .                           
                        "</font>" . "</td>";
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