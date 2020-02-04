<?php
  $dir = "C:\ProgramData\SimpleReceipt";
  if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
      //foreach(glob("*.json") as $filename) {
        // $data = file_get_contents($filename);
        $data = file_get_contents("C:/ProgramData/SimpleReceipt/tickets_data_04022020.json");
        $tickets = json_decode($data, true);
        var_dump($tickets);
        echo("<br>");
        echo("<br>");
        echo("<br>");
        foreach($tickets as $ticket) {
          echo $ticket['TicketNo'] . "<br/>";
          echo $ticket['TicketDate'] . "<br/>";
          echo "--------------------------------------------------------------------";
          echo "<br>";
          for ($i=0; $i < count($ticket['TicketLineItem']); $i++) { 
            # code...
            echo "SrNo: " . $ticket['TicketLineItem'][$i]['ItemIndex'] . "<br/>";
            echo "Quantity: " . $ticket['TicketLineItem'][$i]['Qty'] . "<br/>";
            echo "Rate: " . $ticket['TicketLineItem'][$i]['Rate'] . "<br/>";
            echo "Total: " . $ticket['TicketLineItem'][$i]['TotalItemPrice'] . "<br/>";
            echo "--------------------------------------------------------------------";
            echo "<br>";
          }
          // foreach($tickets['TicketLineItem'][0] as $transaction) {
          //   echo $transaction['ItemIndex'] . "<br/>";
          //   echo $transaction['Qty'] . "<br/>";
          //   echo $transaction['Rate'] . "<br/>";
          //   echo $transaction['TotalItemPrice'] . "<br/>";
          // }
        }
      //}
    }
  }
?>