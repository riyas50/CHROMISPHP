<?php
function GetStoreSalesSummary() 
{
  $dir = "C:/ProgramData/SimpleReceipt/";

  if (is_dir($dir)) {
    
      $filenames = glob($dir . "*.json");
      foreach($filenames as $filename) {
        $data = file_get_contents($filename);
      }

        $data = file_get_contents("C:/ProgramData/SimpleReceipt/tickets_data_04022020.json");
        $tickets = json_decode($data, true);

        return $tickets;
        
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
        }
    }
  }
?>