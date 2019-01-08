<?php
    $conn = mysqli_connect("localhost", "root", "", "pasodo");
    if(isset($_POST["submit"])){
        $ID_number = $_POST["id_number"];
        $F_name = $_POST["F_name"];
        $M_name = $_POST["M_name"];
        $L_name = $_POST["L_name"];
        $category = $_POST["category"];                       
        $phonenumber = $_POST["phonenumber"];     
        
        if(empty('$ID_number') || empty("$F_name") || empty("$M_name") || empty("$L_name") || empty("$category") || empty("$phonenumber")){
            $_SESSION["ErrorMessage"] = "All fields must be filled out";
            header ("Location:backend.php");
           exit;
       }else{
            date_default_timezone_set("Africa/nairobi");
            $date = time();
            $datetime=strftime("%d-%m-%Y %H:%M:%S", $date);
            $datetime;
            $sql = "INSERT INTO clients2(clientID,firstname,middlename,lastname,Category,Phone,Date) VALUES('$ID_number','$F_name','$M_name','$L_name','$category','$phonenumber','$datetime')";
            $execute = mysqli_query($conn, $sql);
            if($execute){                
                $_SESSION["SuccessMessage"] = "Entry successful";
                header("Location:backend.php");
                exit;
                }else{
                     $_SESSION["message"] = "Entry error";
                }              
       }    
    }
        
?>