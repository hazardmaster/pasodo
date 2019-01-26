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
             //Check authenticity of user ID
            $uploaddir = 'img/';
            $uploadfile = $uploaddir . basename($imagename);
            move_uploaded_file($tmpname , $uploadfile);

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