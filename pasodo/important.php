<?php $conn = mysqli_connect("localhost", "root", "", "pasodo"); ?>
<?php require_once("include/sessions.php");?>
<?php if(isset($_POST["submitNewLoan"])){
        $clientID = $_POST["clientID"];
        $loanAmount = $_POST["loanAmount"];
        $image = $_POST["image"];
        $deadlineDate = $_POST["deadlineDate"];
        $notes = $_POST["notes"];
        date_default_timezone_set("Africa/nairobi");
            $date = time();
            $datetime=strftime("%d-%m-%Y %H:%M:%S", $date);
        }

        //insert client Loan details to the Database using prepared statement
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }else{
	        if (empty($loanAmount) && empty($image)) {
	        	echo "amount and image empty";
	        }else{
	        	echo $loanAmount;
	        }
        }
        

    ?>