<?php
    $conn = mysqli_connect("localhost", "pasodomo_oscar", "Oscar3296!!!", "pasodomo_pasodo");
    require_once("../include/sessions.php");
require_once("adminAuthentication.php");
if (isset($_POST["submit"])) {
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
        $ID = $_POST["ID"];
        
        if(empty('$clientId')){
            $_SESSION["ErrorMessage"] = "client id missing";
            header ("Location:categories.php");
           exit;
       } 
       if(empty("$firstName")){
            $_SESSION["ErrorMessage"] = "first name missing";
            header ("Location:categories.php");
           exit;
       } 
       if(empty("$middleName")){
            $_SESSION["ErrorMessage"] = "middle name missing";
            header ("Location:categories.php");
           exit;
       } 
       if(empty("$lastName")){
            $_SESSION["ErrorMessage"] = "last name missing";
            header ("Location:categories.php");
           exit;
       } 
       if(empty("$gender")){
            $_SESSION["ErrorMessage"] = "gender missing";
            header ("Location:categories.php");
           exit;
       } 
       if(empty("$category")){
            $_SESSION["ErrorMessage"] = "category missing";
            header ("Location:categories.php");
           exit;
       }
       if(empty("$phoneNumber")){
            $_SESSION["ErrorMessage"] = "Phone number missing";
            header ("Location:categories.php");
           exit;
       }
       if(empty("$image")){            
            $_SESSION["ErrorMessage"] = "Image file is missing";
            header ("Location:categories.php");
           exit;
       }?>

       <?php

            //Check authenticity of user ID

            date_default_timezone_set("Africa/nairobi");
            $date = time();
            $datetime=strftime("%d-%m-%Y %H:%M:%S", $date);

            //inserting using prepared statement
            if($conn->error){
                die("Connection failed: ".$conn->connect_error);
            }

            //prepare and bind
            $stmt = $conn->prepare("UPDATE client2 SET clientID=?,firstName=?,middleName=?,lastName=?,phone=?,category_id=?,gender=?,image=?,created_at=?,updated_at=? WHERE ID = '$ID' ");
            $stmt->bind_param("ssssssssss", $clientId,$firstName,$middleName,$lastName,$phoneNumber,$catID,$gender,$image,$datetime,$datetime);
            $execute = $stmt->execute();
             if($execute){                
                $_SESSION["SuccessMessage"] = "Entry successful";
                header("Location:categories.php");
                exit;
                }else{
                    $_SESSION["message"] = "Entry error";
                    header("Location:categories.php");
                    exit;
                } 
            $stmt->close();
            $conn->close();
                        
}else{
    $_SESSION["ErrorMessage"] = "Form not set to submit";
    header ("Location:categories.php");
    exit;
}
        
    
    
        
?>