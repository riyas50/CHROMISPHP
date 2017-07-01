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
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src='https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js'></script>
      <script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
    <![endif]-->";
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
        <script src='js/jquery.min.js'></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src='js/bootstrap.min.js'></script>
        <script src='js/validator.js'></script>";
    }
?>