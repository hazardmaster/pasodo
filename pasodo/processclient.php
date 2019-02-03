<?php
    $conn = mysqli_connect("localhost", "root", "", "pasodo");
    require_once("include/sessions.php"); 
    if(isset($_POST["submit"])){
        $clientId = $_POST["clientId"];
        $firstName = $_POST["firstName"];
        $middleName = $_POST["middleName"];
        $lastName = $_POST["lastName"];     
        $gender = $_POST["gender"];                       
        $phoneNumber = $_POST["phoneNumber"];
        $category = $_POST["category"];
            $sqlcat = "SELECT ID FROM category WHERE name = '$category' ";
            $result = $conn->query($sqlcat);
            $datarow = $result->fetch_assoc();
        $catID = $datarow["ID"];
        $image = $_POST["image"];
        $imagename = $_FILES['image']['name'];
        $tmpname = $_FILES['image']['tmp_name'];
        
        if(empty('$clientId')){
            $_SESSION["ErrorMessage"] = "clientID missing";
        }
        if (empty("$firstName")) {
            $_SESSION["ErrorMessage"] = "firstName missing";
        }
        if (empty("$middleName")) {
            $_SESSION["ErrorMessage"] = "middleName missing";
        }
        if (empty("$lastName")) {
            $_SESSION["ErrorMessage"] = "lastName missing";
        }
        if (empty("$gender")) {
            $_SESSION["ErrorMessage"] = "gender missing";
        }
        if (empty("$category")) {
            $_SESSION["ErrorMessage"] = "category missing";
        }
        if (empty("$phoneNumber")) {
            $_SESSION["ErrorMessage"] = "phone missing";
        }
        else{
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

             //Check authenticity of user ID          

            date_default_timezone_set("Africa/nairobi");
            $date = time();
            $datetime=strftime("%d-%m-%Y %H:%M:%S", $date);

            //inserting using prepared statement
            if($conn->error){
                die("Connection failed: ".$conn->connect_error);
            }

            //prepare and bind
            $stmt = $conn->prepare("INSERT INTO client2 (clientID,firstName,middleName,lastName,phone,category_id,gender,image,created_at,updated_at) VALUES (?,?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param("ssssssssss", $clientId,$firstName,$middleName,$lastName,$phoneNumber,$catID,$gender,$image,$datetime,$datetime);
            $execute = $stmt->execute();
             if($execute){                
                $_SESSION["SuccessMessage"] = "Entry successful";
                header("Location:backend.php");
                exit;
                }else{
                    $_SESSION["message"] = "Entry error";
                    header("Location:backend.php");
                    exit;
                } 
            $stmt->close();
            $conn->close();
                        
        }            
}    
    

    
        
?>