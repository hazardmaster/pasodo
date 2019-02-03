<?php require_once("include/sessions.php"); 
$conn = mysqli_connect("localhost", "root", "", "pasodo"); ?>
<?php 
    //process image
            $target_dir = "img/";
            $target_file = $target_dir . basename($_FILES["imageName"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["imageName"]["tmp_name"]);
                if($check !== false) {
                    $_SESSION["SuccessMessage"] =  "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    $_SESSION["ErrorMessage"] = "File is not an image.";
                    $uploadOk = 0;
                }
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                $_SESSION["ErrorMessage"] = "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["imageName"]["size"] > 500000) {
                $_SESSION["ErrorMessage"] =  "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                $_SESSION["ErrorMessage"] =  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 1) {
                $_SESSION["ErrorMessage"] =  "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["imageName"]["tmp_name"], $target_file)) {
                    $_SESSION["SuccessMessage"] =  "The file ". basename( $_FILES["imageName"]["name"]). " has been uploaded.";
                } else {
                    $_SESSION["ErrorMessage"] =  "Sorry, there was an error uploading your file.";
                }
            }
         ?>