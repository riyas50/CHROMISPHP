<?php
include('dbconnect.php');
$itemname = "";
//max_execution_time=360  <<--- this value should be updated in php.ini file, otherwise execution timeout.
function searchBarcode($barcode) 
    {

            $conn = dbConn();
            $truefalse = false;

            $query = "SELECT NAME FROM products WHERE CODE=$barcode";

            if ($stmt = $conn->prepare($query)) {
                $stmt->execute();
                $stmt->bind_result($NAME);
                while ($stmt->fetch()) {
                $GLOBALS['itemname'] = $NAME;
                $truefalse = true;
                //echo $GLOBALS["itemname"];
                }
             $stmt->close();   
            }
            if (!$truefalse) 
            {
                $GLOBALS['itemname'] = "Item Not Found!";
                $truefalse = false;
                //echo $GLOBALS['itemname'];
            }
            //========================================================================================================
            mysqli_close($conn);
            $conn=null;
            $sql="";
            return $truefalse;
    } 

function test($thisFileName)
    {
        $csvFile = file($thisFileName,FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
            $data = [];
            prepareOutputTableHeader();            
            foreach ($csvFile as $line) 
            {
                $data[] = str_getcsv($line);

                if (searchBarcode($data[(count($data)-1)][1]))
                {
                    echo '<tbody>';
                    echo "<tr>";
                    echo "<td>" . $data[(count($data)-1)][0] . "</td>";
                    echo "<td>" . $data[(count($data)-1)][1] . "</td>";
                    echo "<td>" . $data[(count($data)-1)][2] . "</td>";
                    echo "<td>" . $data[(count($data)-1)][3] . "</td>";
                    echo "<td>" . $data[(count($data)-1)][4] . "</td>";
                    echo "<td>" . $data[(count($data)-1)][5] . "</td>";
                    echo "<td>" . $data[(count($data)-1)][6] . "</td>";
                    echo "<td>" . $data[(count($data)-1)][7] . "</td>";
                    echo "<td><span class='glyphicon glyphicon-ok text-center text-success'></span></td>";
                    echo "</tr>";
                }
                else
                {
                    echo '<tbody>';
                    echo "<tr>";
                    echo "<td>" . $data[(count($data)-1)][0] . "</td>";
                    echo "<td>" . $data[(count($data)-1)][1] . "</td>";
                    echo "<td>" . $data[(count($data)-1)][2] . "</td>";
                    echo "<td>" . $data[(count($data)-1)][3] . "</td>";
                    echo "<td>" . $data[(count($data)-1)][4] . "</td>";
                    echo "<td>" . $data[(count($data)-1)][5] . "</td>";
                    echo "<td>" . $data[(count($data)-1)][6] . "</td>";
                    echo "<td>" . $data[(count($data)-1)][7] . "</td>";
                    echo "<td><span class='glyphicon glyphicon-remove text-center text-danger'></span></td>";
                    echo "</tr>";
                }

            }

            finalizeOutputTable(); 
    }

function csvPreview($thisFileName)
    {      
         $csvFile = file($thisFileName,FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
            
            $data = [];
            
            prepareOutputTableHeader();  
            
            $cnt = 0; //display line numbers     

            foreach ($csvFile as $line) 
            {
                $data[] = str_getcsv($line);
                
                $cnt++; //display line number increment

                if (searchBarcode($data[(count($data)-1)][1]))
                {
                    echo '<tbody>';
                    echo "<tr>";
                    echo "<td>" . $cnt . "</td>";
                    echo "<td>" . $data[(count($data)-1)][0] . "</td>";
                    echo "<td>" . $data[(count($data)-1)][1] . "</td>";
                    echo "<td>" . $data[(count($data)-1)][2] . "</td>";
                    echo "<td>" . $data[(count($data)-1)][3] . "</td>";
                    echo "<td>" . $data[(count($data)-1)][4] . "</td>";
                    echo "<td>" . $data[(count($data)-1)][5] . "</td>";
                    echo "<td>" . $data[(count($data)-1)][6] . "</td>";
                    echo "<td>" . $data[(count($data)-1)][7] . "</td>";
                    echo "<td><span class='glyphicon glyphicon-ok text-center text-success'></span></td>";
                    echo "<td><span class='glyphicon glyphicon-remove text-center text-danger'></span></td>";
                    echo "</tr>";
                }
                else
                {
                    echo '<tbody>';
                    echo "<tr>";
                    echo "<td>" . $cnt . "</td>";
                    echo "<td>" . $data[(count($data)-1)][0] . "</td>";
                    echo "<td>" . $data[(count($data)-1)][1] . "</td>";
                    echo "<td>" . $data[(count($data)-1)][2] . "</td>";
                    echo "<td>" . $data[(count($data)-1)][3] . "</td>";
                    echo "<td>" . $data[(count($data)-1)][4] . "</td>";
                    echo "<td>" . $data[(count($data)-1)][5] . "</td>";
                    echo "<td>" . $data[(count($data)-1)][6] . "</td>";
                    echo "<td>" . $data[(count($data)-1)][7] . "</td>";
                    echo "<td><span class='glyphicon glyphicon-remove text-center text-danger'></span></td>";
                    echo "<td><span class='glyphicon glyphicon-remove text-center text-danger'></span></td>";
                    echo "</tr>";
                }

            }

            finalizeOutputTable(); 
            return true;
    }

function prepareOutputTableHeader()
    {

                echo '<center>';
                echo '<table class="table table-striped" style="width:100%;">';
                echo '<thead">';
                echo '<tr>';
                echo '<th>SERIAL#</th>';
                echo '<th>REFERENCE</th>';
                echo '<th>BARCODE</th>';
                echo '<th>ITEM</th>';
                echo '<th>SELL</th>';
                echo '<th>BUY</th>';
                echo '<th>CATEGORY</th>';
                echo '<th>TAX</th>';
                echo '<th>QUANTITY</th>';
                echo '<th>EXISTING</th>';
                echo '<th>UPLOADED?</th>';
                echo '</tr>';
                echo '</thead>';
    }
function finalizeOutputTable()
    {
        echo '<tr></tr>';
        echo '</tbody';
        echo '</table>';
        echo '</center>';
    }

function getUniqueDateTime()
    {
        $fileunique =  date('dmYGis'); 
        return $fileunique;
        /*        $m = date('m');
        $y = date('Y');
        $h = date('G');
        $m = date('i');
        $s = date('s');
        echo $d.$m.$y;
        echo "<br/>";
        echo $h.$m.$s;*/
        /*$fileunique = $d;
        echo $d;
        */
    }

function csvUpload($thisFileName)
    {
         $csvFile = file($thisFileName,FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
            $data = [];

            prepareOutputTableHeader();            

            $cnt = 0; //display line numbers     
            
            foreach ($csvFile as $line) 
            {
                $data[] = str_getcsv($line);

                $cnt++; //display line number increment

                if (searchBarcode($data[(count($data)-1)][1]))
                    {

                        echo '<tbody>';
                        if (!empty($data[(count($data)-1)][0]))
                            {
                                echo "<tr bgcolor=\"#81c784\">";
                            }
                        else
                            {
                                echo "<tr bgcolor=\"#ff4081\">";
                            }
                        //echo "<tr>";
                        echo "<td>" . $cnt . "</td>";
                        echo "<td>" . $data[(count($data)-1)][0] . "</td>";
                        echo "<td>" . $data[(count($data)-1)][1] . "</td>";
                        echo "<td>" . $data[(count($data)-1)][2] . "</td>";
                        echo "<td>" . $data[(count($data)-1)][3] . "</td>";
                        echo "<td>" . $data[(count($data)-1)][4] . "</td>";
                        echo "<td>" . $data[(count($data)-1)][5] . "</td>";
                        echo "<td>" . $data[(count($data)-1)][6] . "</td>";
                        echo "<td>" . $data[(count($data)-1)][7] . "</td>";
                        echo "<td><span class='glyphicon glyphicon-ok text-center text-success'></span></td>";
                        
                        if (newPurchase($data[(count($data)-1)][1],$data[(count($data)-1)][7],$data[(count($data)-1)][4]))
                        {
                            echo "<td><span class=\"glyphicon glyphicon-ok text-center text-success\"></span></td>";
                        }
                        else
                        {
                            echo "<td><span class=\"glyphicon glyphicon-remove text-center text-danger\"></span></td>";
                        }
                        echo "</tr>";
                    }
                else
                    {

                        echo '<tbody>';
                        if (!empty($data[(count($data)-1)][0]))
                            {
                                echo "<tr bgcolor=\"#81c784\">";
                            }
                        else
                            {
                                echo "<tr bgcolor=\"#ff4081\">";
                            }
                        //echo "<tr>";
                        echo "<td>" . $cnt . "</td>"; //Display record number
                        echo "<td>" . $data[(count($data)-1)][0] . "</td>"; //Reference - 0
                        echo "<td>" . $data[(count($data)-1)][1] . "</td>"; //Barcode - 1
                        echo "<td>" . $data[(count($data)-1)][2] . "</td>"; //description - 2
                        echo "<td>" . $data[(count($data)-1)][3] . "</td>"; //sell price - 3
                        echo "<td>" . $data[(count($data)-1)][4] . "</td>"; //buy price - 4
                        echo "<td>" . $data[(count($data)-1)][5] . "</td>"; //category - 5
                        echo "<td>" . $data[(count($data)-1)][6] . "</td>"; //Tax - 6
                        echo "<td>" . $data[(count($data)-1)][7] . "</td>"; //Quantity - 7
                        echo "<td><span class='glyphicon glyphicon-remove text-center text-danger'></span></td>";

                        //newProduct($reference,$barcode,$description,$sell,$buy,$category,$quantity)
                        if (newProduct($data[(count($data)-1)][0],$data[(count($data)-1)][1],$data[(count($data)-1)][2],
                            $data[(count($data)-1)][3],$data[(count($data)-1)][4],$data[(count($data)-1)][5],$data[(count($data)-1)][7]))
                        {
                            echo "<td><span class=\"glyphicon glyphicon-ok text-center text-success\"></span></td>";
                        }
                        else
                        {
                            echo "<td><span class=\"glyphicon glyphicon-remove text-center text-danger\"></span></td>";
                        }
                        echo "</tr>";
                    }

            }

            finalizeOutputTable();    
            return true;     
    }

function newPurchase($barcode,$quantity,$buyPrice) //existing product purchase
    {
            
            $conn = dbConn();
            
            $sql = "CALL PRODPURCHASE (now(),1,0,$barcode,$quantity,$buyPrice,'Navas')";
            
            //echo $sql;
            
            $result = mysqli_query($conn, $sql);

            if ($result) 
            {
                return true;
            }
            else
            {
                return false;
            }
            mysqli_close($conn);
            $conn=null;
            $sql="";        
    }
function newProduct($reference,$barcode,$description,$sell,$buy,$category,$quantity)
    {
            $conn = dbConn();
            
            $escDesc = mysqli_real_escape_string($conn,$description);

            $sql = "CALL UPLOADPROD($reference,$barcode,'" . $escDesc . "',$sell,$buy,'" . $category . "','000',$quantity)";
            
            //echo $sql;
            
            $result = mysqli_query($conn, $sql);

            if ($result) 
            {
                return true;
            }
            else
            {
                echo("Error description: " . mysqli_error($conn) . "<br />");
                return false;
            }
            mysqli_close($conn);
            $conn=null;
            $sql="";         
    }
?>