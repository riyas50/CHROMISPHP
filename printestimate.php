<?php
require_once('dbconnect.php');
/* Change to the correct path if you copy this example! */
require '/vendor/mike42/escpos-php/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
/**
 * Assuming your printer is available at LPT1,
 * simpy instantiate a WindowsPrintConnector to it.
 *
 * When troubleshooting, make sure you can send it
 * data from the command-line first:
 *  echo "Hello World" > LPT1
 */


    if ($_GET['command'])
    {
        if($_GET['command'] == 'print')
        {

            $conn = dbConn();
            $Query = "SELECT e.CODE CODE,p.NAME NAME,e.PRICESELL PRICESELL,e.QUANTITY QUANTITY
                        FROM estimate e
                        INNER JOIN products p on p.CODE = e.CODE";

        if($records  = $conn->prepare($Query))
            {
                $records->execute();
                $records->bind_result($CODE,$NAME,$PRICESELL,$QUANTITY);


                $connector = new WindowsPrintConnector("LPT1");
                // A FilePrintConnector will also work, but on non-Windows systems, writes
                // to an actual file called 'LPT1' rather than giving a useful error.
                // $connector = new FilePrintConnector("LPT1");
                /* Print a "Hello world" receipt" */
                $printer = new Printer($connector);
                $printer -> setJustification(Printer::JUSTIFY_CENTER);
                $printer -> text("Estimate\n");
                $printer -> setJustification(Printer::JUSTIFY_LEFT);
                $printer -> text(str_repeat("=",42) . "\n");
                $printer -> text(str_pad("Qty",3) . " " . str_pad("Item Details",22)  . " " . str_pad("Price",7," ",STR_PAD_RIGHT) . " " . str_pad("Total",7," ",STR_PAD_RIGHT) . "\n");
                $printer -> text(str_repeat("=",42) . "\n");

                while($records->fetch())
                {
                    try 
                        {
                            


                            $barcode=$CODE;
                            $desc=$NAME;
                            $price=number_format(floatval($PRICESELL),2);
                            $qty=$QUANTITY;
                            $total=number_format(floatval($PRICESELL * $qty),2);

                            $printer -> text(str_pad($qty,3) . " " . str_pad(trim(substr($desc,0,20)),22) . " " . str_pad($price,7," ",STR_PAD_RIGHT) . " " . str_pad($total,7," ",STR_PAD_RIGHT) . "\n");
                            $printer -> text(str_pad($barcode,17," ",STR_PAD_LEFT) . "\n");

                        } 
                        catch (Exception $e) 
                            {
                                echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
                            }
                }

                $printer -> cut();
                /* Close printer */
                $printer -> close();


                $records->close();
                mysqli_close($conn);
                $conn=null;
                $Query ="";
            }
        }//validate command parameter    
    } //check for command parameter
    
    if ($_GET['redirect'])
        {
            if($_GET['redirect'] == "estimate")
                {
                    header("Location: ./estimate.php");
                }
        }
    
function test() {
        try {
            $connector = new WindowsPrintConnector("LPT1");
            
            // A FilePrintConnector will also work, but on non-Windows systems, writes
            // to an actual file called 'LPT1' rather than giving a useful error.
            // $connector = new FilePrintConnector("LPT1");
            /* Print a "Hello world" receipt" */
            $printer = new Printer($connector);
            $barcode="8901180228128";
            $desc="Faber Castell Plastic Crayons 12+2";
            $price="1156.82";
            $qty="111";
            $total="1111.00";
            $printer -> setJustification(Printer::JUSTIFY_CENTER);
            $printer -> text("Estimate\n");
            $printer -> setJustification(Printer::JUSTIFY_LEFT);
            $printer -> text(str_repeat("=",42) . "\n");
            $printer -> text(str_pad("Qty",3) . " " . str_pad("Item Details",22)  . " " . str_pad("Price",7," ",STR_PAD_RIGHT) . " " . str_pad("Total",7," ",STR_PAD_RIGHT) . "\n");
            $printer -> text(str_repeat("=",42) . "\n");
            $printer -> text(str_pad($qty,3) . " " . str_pad(trim(substr($desc,0,20)),22) . " " . str_pad($price,7," ",STR_PAD_RIGHT) . " " . str_pad($total,7," ",STR_PAD_RIGHT) . "\n");
            $printer -> text(str_pad($barcode,17," ",STR_PAD_LEFT) . "\n");
            $printer -> cut();
            /* Close printer */
            $printer -> close();
} catch (Exception $e) {
    echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
}
}
//   $connector = new WindowsPrintConnector("EPSON TM-T88IV Receipt");
