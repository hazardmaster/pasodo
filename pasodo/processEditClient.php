<?php
    $conn = mysqli_connect("localhost", "root", "", "pasodo");
    require_once("include/sessions.php");

        $clientId = $_GET["clientId"];
        $firstName = $_GET["firstName"];
        $middleName = $_GET["middleName"];
        $lastName = $_GET["lastName"];     
        $gender = $_GET["gender"];                       
        $phoneNumber = $_GET["phoneNumber"];
        $category = $_GET["category"];
            $sqlcat = "SELECT ID FROM category WHERE name = '$category' ";
            $result = $conn->query($sqlcat);
            $datarow = $result->fetch_assoc();
        $catID = $datarow["ID"];
        $image = $_GET["image"];
        
        if(empty('$clientId') || empty("$firstName") || empty("$middleName") || empty("$lastName") || empty("$gender") || empty("$category") || empty("$phoneNumber") || empty("$image")){            
            $_SESSION["ErrorMessage"] = "All fields must be filled out";
            header ("Location:backend.php");
           exit;
       }else{
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

    
        
?>