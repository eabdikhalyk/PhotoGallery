<?php include 'upload.php'; ;?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Gallery</title>
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
                $files = scandir($targetDir);
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
            echo "<img src='".$targetDir.$files[$i]."' alt='Trulli'>";
            echo "</div>";
          }
        ?>
    </div>
</body>
</html>

