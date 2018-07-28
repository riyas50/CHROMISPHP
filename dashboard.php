<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
        include('general.php');
        include('dashboard_charts.php');
        putScripts();
        putLinks();
    ?>
    <title>CHROMIS BACKOFFICE</title>
  </head>
  <body>
  

<nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand tada animated" href="./index.php">CHROMIS BACKOFFICE</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
<!--         <ul class="nav navbar-nav navbar-left">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Products <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="/chromisphp/productsearch.php">Search</a></li>
                    <li><a href="#">New Product</a></li>
                    <li><a href="/chromisphp/productpurchase.php">Purchase</a></li>
                    <li><a href="#">Distribution</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Masters <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="./Locations.php">Locations</a></li>
                    <li><a href="./categories.php">Categories</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Uploads <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="./newproductupload.php">All Purchases</a></li>
                    <li><a href="./csvupload.php">Quantity from CSV</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="./Report_ProductSalesProfit.php">Itemwise Profit</a></li>
                    <li><a href="./Report_ProductSalesProfitMonthly.php">Monthly Profit</a></li>
                    <li><a href="./Report_CustomerInvoices.php">Customer Invoices</a></li>
                    <li><a href="./Report_CustomerItems.php">Customer Items</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="./Report_CashReceipts.php">Cash Receipts Search</a></li>
                    <li><a href="./Report_CashReceiptsItems.php">Cash Receipts Product Search</a></li>
                </ul>
            </li>
        </ul> -->
    </div><!-- /.navbar-collapse -->
</nav>

<header class="site__header island">
  <div class="wrap">
   <span id="animationSandbox" style="display: block; color:red;"  class="tada animated">
   <h1 class="site__title mega text-center">Grand Dashboard</h1>
   </span>
  </div>
  </header>

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-center">
            <canvas id="YearlyTotalSalesChart" width="100" height="100"></canvas>
        </div>    
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-center">
            <canvas id="YearlyCashSalesChart" width="150" height="150"></canvas>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-center">
            <canvas id="YearlyCustSalesChart" width="150" height="150"></canvas>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-center">
            <canvas id="CurrMonthCashSalesChart" width="150" height="150"></canvas>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-center">
            <canvas id="CurrMonthCustSalesChart" width="100" height="100"></canvas>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-center">
            <canvas id="TotalYearlyProfitChart" width="100" height="100"></canvas>
        </div>
    </div>
</div> <!-- container -->

<script>
function Mround(value, decimals) {
  return Number(Math.round(value+'e'+decimals)+'e-'+decimals);
}
</script>

<script>
// Define a plugin to provide data labels
Chart.plugins.register({
			afterDatasetsDraw: function(chart) {
				var ctx = chart.ctx;

				chart.data.datasets.forEach(function(dataset, i) {
					var meta = chart.getDatasetMeta(i);
					if (!meta.hidden) {
						meta.data.forEach(function(element, index) {
							// Draw the text in black, with the specified font
							ctx.fillStyle = 'rgb(98,0,234)';

							var fontSize = 10;
							var fontStyle = 'bold';
							var fontFamily = 'Arial'; //'Helvetica Neue';
							ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

							// Just naively convert to string for now
							//var dataString = dataset.data[index].toString();
							var dataString = Mround(dataset.data[index],2).toString();

							// Make sure alignment settings are correct
							ctx.textAlign = 'center';
							ctx.textBaseline = 'middle';

							var padding = 5;
							var position = element.tooltipPosition();
							ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
						});
					}
				});
			}
		});
</script>

    <?php //Yearly Total Sales
        TotalYearlySales();                                         
    ?>
    
    <script>
        var ctx = document.getElementById('YearlyTotalSalesChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',
            // The data for our dataset
            data: {
                labels: <?php echo json_encode($outputYears);?>,
                datasets: [{
                    label: "Yearly Total Sales",
                    backgroundColor: 'rgb(255,23,68)',
                    borderColor: 'rgb(255,23,68)',
                    data: <?php echo json_encode($outputInvAmount);?>,
                }]
            },
            // Configuration options go here
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
</script>

    <?php //Yearly Total Sales
        TotalYearlyProfit();                                         
    ?>
    
    <script>
        var ctx = document.getElementById('TotalYearlyProfitChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',
            // The data for our dataset
            data: {
                labels: <?php echo json_encode($outputYears);?>,
                datasets: [{
                    label: "Yearly Total Profit",
                    backgroundColor: 'rgb(118,255,3)',
                    borderColor: 'rgb(118,255,3)',
                    data: <?php echo json_encode($outputInvAmount);?>,
                }]
            },
            // Configuration options go here
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
</script>

    <?php //Yearly Sales Cash
        YearlySalesCash();                                         
    ?>
    
    <script>
        var ctx = document.getElementById('YearlyCashSalesChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',
            // The data for our dataset
            data: {
                labels: <?php echo json_encode($outputYears);?>,
                datasets: [{
                    label: "Yearly Cash Sales",
                    backgroundColor: 'rgb(255,235,59)',
                    borderColor: 'rgb(255,235,59)',
                    data: <?php echo json_encode($outputInvAmount);?>,
                }]
            },
            // Configuration options go here
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        
</script>

    <?php //Yearly Sales Customers
        YearlySalesCustomers();                                         
    ?>

    <script>
        var ctx = document.getElementById('YearlyCustSalesChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',
            // The data for our dataset
            data: {
                labels: <?php echo json_encode($outputYears);?>,
                datasets: [{
                    label: "Yearly Customer Sales",
                    backgroundColor: 'rgb(213,0,249)',
                    borderColor: 'rgb(213,0,249)',
                    data: <?php echo json_encode($outputInvAmount);?>,
                }]
            },
            // Configuration options go here
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }                
            }
        });
</script>

    <?php   //current month cash Sales 
            //previous years vs current year
        CurrentMonthCashSales();                                         
    ?>

    <script>
        var ctx = document.getElementById('CurrMonthCashSalesChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',
            // The data for our dataset
            data: {
                labels: <?php echo json_encode($outputYears);?>,
                datasets: [{
                    label: "This Month Cash Sales",
                    backgroundColor: 'rgb(21,101,192)',
                    borderColor: 'rgb(21,101,192)',
                    data: <?php echo json_encode($outputInvAmount);?>,
                }]
            },
            // Configuration options go here
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }                
            }
        });
</script>
    <?php   //Current month sales customers 
            //Previous Years vs current year
        CurrentMonthCustSales();                                         
    ?>

    <script>
        var ctx = document.getElementById('CurrMonthCustSalesChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',
            // The data for our dataset
            data: {
                labels: <?php echo json_encode($outputYears);?>,
                datasets: [{
                    label: "This Month Cust Sales",
                    backgroundColor: 'rgb(245,0,87)',
                    borderColor: 'rgb(245,0,87)',
                    data: <?php echo json_encode($outputInvAmount);?>,
                }]
            },
            // Configuration options go here
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }                
            }
        });
</script>



<?php
    stickfooter();
?>
</body>
</html>