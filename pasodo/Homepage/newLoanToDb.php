<?php
        ob_start();
     $conn = mysqli_connect("localhost", "pasodomo_oscar", "Oscar3296!!!", "pasodomo_pasodo");  
     require_once("../include/sessions.php");

    if(isset($_POST["submit"])){       

        //insert client Loan details to the Database using prepared statement
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }else{
                 $clientID = $_POST["clientID"];
                    $loanAmount = $_POST["loanAmount"];
                    $image = $_POST["image"];
                    $deadlineDate = $_POST["deadlineDate"];
                    $notes = $_POST["notes"];
            if(!empty($clientID) && !empty($loanAmount) && !empty($image) && !empty($deadlineDate) && !empty($notes)){
                //working
                $interestRate = 0.15;
                $interestAmount = $loanAmount * $interestRate;
                $amountPlusInterest = $loanAmount + $interestAmount;
               
                date_default_timezone_set("Africa/nairobi");
                    $date = time();
                    $datetime=strftime("%d-%m-%Y %H:%M:%S", $date);

                $stmt = $conn->prepare("INSERT INTO loan(clientID,amount,interestRate,interestAmount,amountPlusInterest,created_at,updated_at,deadline_at,image,notes)VALUES(?,?,?,?,?,?,?,?,?,?)");

                $stmt->bind_param("ssssssssss", $clientID,$loanAmount,$interestRate,$interestAmount,$amountPlusInterest,$datetime,$datetime,$deadlineDate,$image,$notes);

                $execute = $stmt->execute();
                 if($execute){        
                    $_SESSION["SuccessMessage"] = $loanAmount. " shillings entered successfully as new loan.". "<br>". "Deadline date: ". $deadlineDate
                                    . "<br>". "Interest rate: ". $interestRate
                                    . "<br>". "Interest amount: ". $interestAmount
                                    . "<br>". "Amount to pay: ". $amountPlusInterest;       
                    header("Location:loan.php");                    
                    exit;
                    }else{
                        $_SESSION["message"] = "Entry error";                        
                        header("Location:loan.php");
                        exit;
                    } 
                $stmt->close();
                $conn->close(); 
                }else{
                header('Location: loan.php');
                $_SESSION["ErrorMessage"] = "Error! Blank fields";
                exit;

        }
    }
}
        
ob_get_flush();
    ?>