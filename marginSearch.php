<!DOCTYPE html>
<html lang="en">
  <head>
    
    <?php
        require_once('general.php');
        require_once('marginquery.php');

        putLinks();
    ?>


  </head>
  <body>
    <div class="container">
        <div id="distmodal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title">Estimate</h2>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="marginSearch.php" enctype="multipart/form-data">
                                <!-- <input type="text" class="form-control" placeholder="example control..." id="example"><br/>  -->
                                <input type="text" class="form-control" placeholder="" id="barcode" readonly="readonly"><br/> 
                                <input type="text" class="form-control" placeholder="" id="itemdesc" readonly="readonly"><br/> 
                                <input type="text" class="form-control" placeholder="" id="price" readonly="readonly"><br/> 
                                <input type="text" class="form-control" placeholder="" id="qty" autofocus><br/> 
                                <button type="submit" id="secretButton" style="float:left;" name="secretButton" />
                            </form>
                        </div>
                        <div class="modal-footer">
                            <!-- <input type="button" data-toggle="modal" data-target="#distmodal" class="btn btn-success" name="estSave" id="estSave" value="Save" > -->
                            <!-- <a href="estimate.php" id="estinsert" name="estinsert" class="btn btn-success" data-toggle="modal" data-target="#distmodal">Save</a> -->
                            
                            <a href="estimate.php" id="estinsert" name="estinsert" class="btn btn-success">Save</a>
                            <a class="btn btn-danger" data-toggle="modal" data-target="#distmodal">Close</a>
                        </div>
                    </div>
                </div>
            </div>    
    </div>
    
    <header class="site__header island">
    <div class="wrap">
    <span id="animationSandbox" style="display: block;"  class="tada animated">
    <h1 class="site__title mega text-center">Product Distribution</h1>
    </span>
    </div>
  </header>

<form action="marginsearch.php" method="post" enctype="multipart/form-data">
 <div class="row">
 <div class="form-group">
 <div class="col-lg-4">
    <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" frame scrolling="yes" src="./estimate.php"></iframe>
    </div>
 </div>
 <div class="col-lg-4 text-right">
          <a class="glyphicon glyphicon-home" style="font-size:30px;color:orange" href="/chromisphp/"></a> 
 <div class="input-group">
    <div class="input-group-addon">SEARCH</div>
    <input type="text" class="form-control" name="barcode" id="inlineFormInputGroup" placeholder="BARCODE">
    <input type="text" class="form-control" name="item" id="inlineFormInputGroup" placeholder="ITEM">
    <input type="text" class="form-control" name="category" id="inlineFormInputGroup" placeholder="CATEGORY">
    </div>
    <br />  
     <button type="submit" class="btn btn-success" id="btnSearch" name="Search">Search</button>
     <button type="submit" class="btn btn-warning" id="btnClear" name="Clear">Clear</button>
     <button type="submit" class="btn btn-info" id="btnReload" name="Reload">Reload</button>
 </div>
 <div class="col-lg-4"></div>
 </div>
 </div>
 </form>
<br />
<div class="row">
<div class="col-lg-4"></div>
<div class="col-lg-12">
  
    <?php
/*             session_start();

            if(strcasecmp($_SERVER['REQUEST_METHOD'],"POST") === 0) {
                $_SESSION['postdata'] = $_POST;
                header("Location: ".$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']);
                exit;
            }

            if( isset($_SESSION['postdata'])) {
                $_POST = $_SESSION['postdata'];
                unset($_SESSION['postdata']);
            } */
                
        if (isset($_POST['']))
            {
                //echo 'empty post';
                refreshRecords();
                //putEmptyRow();
            }
        
/*         if(isset($_POST['estinsert']))
            {
                $thisPrice =  $_POST['price'];
                $thisBarcode =  $_POST['barcode'];
                $thisQty =  $_POST['qty'];
                echo $thisPrice;
                echo $thisBarcode;
                echo $thisQty;
                header("Location: estimateActions.php?insertRec=" . $thisPrice . "&code=" . $thisBarcode . "&qty=" . $thisQty);
            } */
    ?>
    
 
</div>
<div class="col-lg-4"></div>
</div>
</div>

    <?php 


    if (isset($_POST['Reload']))
        {
            refreshRecords();
        }

    if (isset($_POST['Search']))
        {
            filterRecords($_POST['barcode'],$_POST['item'],$_POST['category']);
            //$_POST['barcode'] = $_POST['barcode'];
        }

    ?>

    <?php
        putScripts();
    ?>
    
    <script type="text/javascript">

        $(document).ready(function() {
            $("#addNew").on('click',function(){
                $("#distmodal").modal('show');
            })

            $('#distmodal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var qty = button.data('quantity'); // Extract info from data-* attributes
                var barcode = button.data('barcode');
                var itemdesc = button.data('itemdesc');
                var price = button.data('price');
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                //modal.find('.modal-title').text('New message to ' + recipient)
                $(".modal-body #barcode").val(barcode)
                $(".modal-body #itemdesc").val(itemdesc)
                $(".modal-body #price").val(price)
                $("a[href='estimate.php']").attr('href', './estimateActions.php?insertRec=' + price + '&code=' + barcode + '&qty=0') // + qty)
                
            });

              $('#qty').change(function() {
                var newurl = $('#qty').val()
                var newhref = $("#estinsert").attr("href")
                newhref= newhref.replace("qty=0","qty="+newurl)
                //alert(newhref)
                $("#estinsert").attr("href",newhref)
            });

            $("#secretButton").hide()

            $("#qty").keypress(function (e){
                if(e.which == 13) {
                    var newurl = $('#qty').val();
                    var newhref = $("#estinsert").attr("href");
                    newhref= newhref.replace("qty=0","qty="+newurl);
                    $("#estinsert").attr("href",newhref)
                    //sleep(2);
                    //wait(10)
                    $('#estinsert')[0].click();
                }
                
            });

        });      


    </script>

    <?php
        stickfooter();
    ?>
</body>
</html>