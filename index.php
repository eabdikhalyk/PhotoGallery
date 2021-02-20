<?php
$targetDir= "upload/";
$message="";
if(isset($_POST["submit"])){
    if($_FILES["fileToUpload"]["name"]){
        $targetFile = $targetDir.basename($_FILES["fileToUpload"]["name"]);
        $uploadOK = 1;
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

        if($check !==false ){
            $message =  $message ." File is a image - " . $check["mime"]. ".";
            $uploadOK = 1;
        }else{
            $message =  $message ." File is not an image.";
            $uploadOK = 0;
        }

        // Check if file already exists
        if (file_exists($targetFile )) {
          $message =  $message ." Sorry, file already exists.";
          $uploadOK = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
          $message =  $message ." Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOK = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOK == 0) {
          $message =  $message ." Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            $message =  $message ." The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
          } else {
            $message =  $message ." Sorry, there was an error uploading your file.";
          }
        }
    }else{
        $message =  $message ." Please choose image.";
    }
}

$files = scandir($targetDir);

?>
<!DOCTYPE html>
<head>
    <title>Gallery</title>
    <style>
        div.header {
             width: 800px;
             margin: auto;
        }
        h1 {
            text-align: center;
        }
        div.upload{
             width: 800px;
             height: 50px;
             margin: auto;
        }
        div.container{
             width: 800px;
             margin: auto;
        }
        div.gallery {
            margin: 5px;
            border: 1px solid #ccc;
            float: left;
            width: 180px;
        }

        div.gallery:hover {
            border: 1px solid #777;
        }

        div.gallery img {
            width: 100%;
            height: auto;
        }

</style>
</head>
<body>
    <div class="header">
         <h1>Photo gallery</h1>
    </div>
 
    <div class="upload">
        <form action="index.php" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type = "file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload Image" name="submit">
            <?php
                if(!empty($message)){
                    echo '<br>';
                    echo $message;
                    echo '<br>';
                }
            ?>
        </form>
    </div> 
    <div class="container">
        <?php
          for($i = 2;$i<count($files);$i++){
            echo "<div class ='gallery'>";
            echo "<img src='".$targetDir.$files[$i]."' alt='Trulli' width='600' height='400'>";
            echo "</div>";
          }
        ?>
    </div>
</body>
</html>

