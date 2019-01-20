<?php $conn = mysqli_connect("localhost", "root", "", "pasodo"); ?>
<?php require_once("include/sessions.php");?>

<?php if(isset($_POST["submit"])){
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
            if(!empty($clientID) || empty($loanAmount) || empty($image) || empty($deadlineDate) || empty($notes)){
                
                header('Location: processNewLoan.php');
                $_SESSION["ErrorMessage"] = "Error! Blank fields";
                exit;

            }else{

            }
        }
        

    ?>