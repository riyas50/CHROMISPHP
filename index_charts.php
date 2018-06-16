<?php
        ini_set('max_execution_time', 300);
        include('dbconnect.php');

        $qYearlyCashSales = "select sum(invamountab) cSales,invdateab sYear from view_yearly_sales_all_cash group by invdateab order by invdateab;";
        $qYearlyCustSales = "select sum(invamountab) cSales,invdateab sYear from view_yearly_sales_all_customers group by invdateab order by invdateab;";
        $qCurMonCashSales = "select * from view_current_month_cash_sales;";
        $qCurMonCustSales = "select * from view_current_month_cust_sales;";
        $qYearlyTotalSales = "select * from view_yearly_total_sales";
        $qYearlyTotalProfit = "select * from view_yearly_total_profit";
        
        $outputInvAmount = array();
        $outputYears = array();

        function clearArrays()
        {
            $GLOBALS['outputInvAmount'] = array();
            $GLOBALS['outputYears'] = array();
        }

        function YearlySalesCash()
        {
            clearArrays();
            $con = dbconn();


            if ($stmt = $con->prepare($GLOBALS['qYearlyCashSales'])) {
                $stmt->execute();
                $stmt->bind_result($cSales, $sYear);
                
                while ($stmt->fetch()) {
                    $GLOBALS['outputInvAmount'][] = array($cSales);
                    $GLOBALS['outputYears'][] = array($sYear);
                }
                //print(json_encode($output));
                $stmt->close();
            }
        }

        function TotalYearlySales()
        {
            clearArrays();
            $con = dbconn();


            if ($stmt = $con->prepare($GLOBALS['qYearlyTotalSales'])) {
                $stmt->execute();
                $stmt->bind_result($cSales, $sYear);
                
                while ($stmt->fetch()) {
                    $GLOBALS['outputInvAmount'][] = array($cSales);
                    $GLOBALS['outputYears'][] = array($sYear);
                }
                //print(json_encode($output));
                $stmt->close();
            }
        }

        function TotalYearlyProfit()
        {
            clearArrays();
            $con = dbconn();


            if ($stmt = $con->prepare($GLOBALS['qYearlyTotalProfit'])) {
                $stmt->execute();
                $stmt->bind_result($cSales, $sYear);
                
                while ($stmt->fetch()) {
                    $GLOBALS['outputInvAmount'][] = array($cSales);
                    $GLOBALS['outputYears'][] = array($sYear);
                }
                //print(json_encode($output));
                $stmt->close();
            }
        }

        function YearlySalesCustomers()
        {
            clearArrays();
            $con = dbconn();

            if ($stmt = $con->prepare($GLOBALS['qYearlyCustSales'])) {
                $stmt->execute();
                $stmt->bind_result($cSales, $sYear);
                
                while ($stmt->fetch()) {
                    $GLOBALS['outputInvAmount'][] = array($cSales);
                    $GLOBALS['outputYears'][] = array($sYear);
                }
                //print(json_encode($output));
                $stmt->close();
            }
        }
        function CurrentMonthCashSales()
        {
            clearArrays();
            $con = dbconn();

            if ($stmt = $con->prepare($GLOBALS['qCurMonCashSales'])) {
                $stmt->execute();
                $stmt->bind_result($cSales, $sMonthYear);
                
                while ($stmt->fetch()) {
                    $GLOBALS['outputInvAmount'][] = array($cSales);
                    $GLOBALS['outputYears'][] = array($sMonthYear);
                }
                //print(json_encode($output));
                $stmt->close();
            }
        }

        function CurrentMonthCustSales()
        {
            clearArrays();
            $con = dbconn();

            if ($stmt = $con->prepare($GLOBALS['qCurMonCustSales'])) {
                $stmt->execute();
                $stmt->bind_result($cSales, $sMonthYear);
                
                while ($stmt->fetch()) {
                    $GLOBALS['outputInvAmount'][] = array($cSales);
                    $GLOBALS['outputYears'][] = array($sMonthYear);
                }
                //print(json_encode($output));
                $stmt->close();
            }
        }
