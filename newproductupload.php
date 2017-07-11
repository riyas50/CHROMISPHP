<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
        include('general.php');
        include('productuploadcode.php');
        putLinks();
        
/*        session_start();
        if( strcasecmp($_SERVER['REQUEST_METHOD'],"POST") === 0) {
            $_SESSION['postdata'] = $_POST;
            header("Location: ".$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']);
            exit;
        }
        if( isset($_SESSION['postdata'])) {
            $_POST = $_SESSION['postdata'];
            unset($_SESSION['postdata']);
        } */       

    ?>
   <title>Chromis PHP - Categories</title>
  </head>
  <body>

    <header class="site__header island">
        <div class="wrap">
            <span id="animationSandbox" style="display: block;"  class="tada animated">
                <h1 class="site__title mega text-center">New Product Upload</h1>
            </span>
        </div>
    </header>

    <form action="newproductupload.php" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="form-group">
                <div class="col-lg-3"></div>
                    <div class="col-lg-6 text-right">
                        <a class="glyphicon glyphicon-home text-info" style="font-size:30px;" href="/chromisphp/"></a> 
                    </div>
                <div class="col-lg-3"></div>
            </div> <!-- form-group -->
        </div> <!-- row close -->
        <div class="row">
            <div class="form-group">
                <div class="col-lg-3"></div>
                    <div class="col-lg-6 text-right">
                        <div class="table-bordered"> <!-- just for the frame -->
                        <input class="btn btn-warning btn-block text-right" type="file" name="fileToUpload" id="fileToUpload">
                        <span class='label label-danger center-block' id="upload-file-info"></span>
                        </div> <!-- table bordered closed -->
                    </div> <!-- column close -->
                <div class="col-lg-3"></div>
            </div> <!-- form-group -->
        </div> <!-- row close -->
        <div class="row">
            <div class="form-group">
                <div class="col-lg-3"></div>
                    <div class="col-lg-6 text-right">
                        <div> <!-- just for the frame -->
                        <button type="submit" class="btn btn-success" id="btnUpload" name="upload" >Upload</button>
                        <span><button type="submit" class="btn btn-info" id="btnPreview" name="preview" >Preview</button></span>
                        </div> <!-- just frame close table bordered closed -->
                    </div> <!-- column close -->
                <div class="col-lg-3"></div>
            </div> <!-- form-group -->
        </div> <!-- row close -->
    </form>
<br />

    <div class="row"> <!-- output row open   --> 
    <div class="col-lg-12"> <!-- output 12 column open   --> 

    </div>
    </div>

    <div class="row"> <!-- output row open   --> 
    <div class="col-lg-12"> <!-- output 12 column open   --> 
    <?php 
            
    if (isset($_POST['upload']))
        {
            // $message = "Upload Pressed";
            // echo "<script type='text/javascript'>alert('$message');</script>";
            $target_dir = "uploads/";
            $uniquefile = 
            $target_file = $target_dir . getUniqueDateTime() . '_' . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $uploadFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            
            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if($uploadFileType != "csv") 
            {
                echo "Sorry, only csv file allowed.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) 
            {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                    if (csvupload($target_file))
                    {
                        $message = "Upload completed!";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }                        
        }

    if (isset($_POST['preview']))
        {
            $target_dir = "uploads/";
            $uniquefile = 
            $target_file = $target_dir . getUniqueDateTime() . '_' . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $uploadFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            
            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if($uploadFileType != "csv") 
            {
                echo "Sorry, only csv file allowed.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) 
            {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                    if(csvPreview($target_file))
                                        {
                        $message = "Preview completed!";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }            

        }



    ?>
 
    </div> <!-- output 12 column space close   --> 
    </div> <!-- output row close   --> 

    <?php
        //include('general.php');
        putScripts();
        //stickfooter();
    ?>

    </body>
</html>