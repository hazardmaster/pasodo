<?php $conn = mysqli_connect("localhost", "root", "", "pasodo"); ?>
<?php require_once("../include/sessions.php");
require_once("adminAuthentication.php");
?>
<?php 
	if($conn->connect_error){
		die("Connection failed: " .$conn->connect_error);
	}
	$loanID = $_GET["id"];
	$sql = "UPDATE loan SET status = 'unapproved' WHERE ID = '$loanID' ";
	if ($conn->query($sql) === TRUE){
		$_SESSION["SuccessMessage"] = "Loan was not approved";
		header('Location: transactionapproval.php');
		exit;
	}else{
		$_SESSION["ErrorMessage"] = "Error encountered!";
		header('Location: transactionapproval.php');
		exit;
	}
 ?>