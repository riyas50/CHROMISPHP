<?php
function putLinks()
    {
        echo "<meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
    <!-- Bootstrap -->
    <link href='css/bootstrap.min.css' rel='stylesheet'>
    
    <!--Sticky-footer-->
    <link href='css/sticky-footer.css' rel='stylesheet'>

    <!-- Animate.css -->
    <link href='css/animate.css' rel='stylesheet'>
    
    <!-- Bootstrap datetimepicker -->
    <link href='css/bootstrap-datetimepicker.min.css' rel='stylesheet'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src='https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js'></script>
      <script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
    <![endif]-->
    ";
    }
function stickfooter()
    {
        echo '<footer class="footer">
        <div class="container">
            <p class="text-muted text-center text-success">Chromis POS	0.58.5.7a | Server type: MySQL | Server version: 5.6.26 - MySQL Community Server (GPL)</p>
        </div>
        </footer>';
    }

function putScripts()
    {
        echo "    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src='js/jquery.js'></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src='js/bootstrap.js'></script>
        <script src='js/Chart.js'></script>
        <script src='js/validator.min.js'></script>
        <script src='js/bootstrap-datetimepicker.min.js'></script>";
    }

function putDatePickerScript()
    {
        echo "
        <Script>
        $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
	$('.form_date').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	$('.form_monthly').datetimepicker({
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 3,
		minView: 3,
		forceParse: 0
    });
	$('.form_time').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0
    });
    </Script>";
    }

function putButtonValidatorException()
{
    //validator css related, not sure;   
}

function displayMessage($thisMessage){
                            $message = $thisMessage;
                        echo "<script type='text/javascript'>alert('$message');</script>";
}
?>