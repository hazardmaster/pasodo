<?php 
ob_start();
	$conn = mysqli_connect("localhost", "pasodomo_oscar", "Oscar3296!!!", "pasodomo_pasodo");  
	require_once("../include/sessions.php");
	require_once("adminAuthentication.php");

	if($conn->connect_error){
		die("Connection failed: " .$conn->connect_error);
	}
	$loanID = $_GET["id"];
	$sql = "UPDATE loan SET status = 'approved' WHERE ID = '$loanID' ";
	if ($conn->query($sql) === TRUE){
		$_SESSION["SuccessMessage"] = "Loan approved successfully";
		header('Location: transactionapproval.php');
		exit;
	}else{
		$_SESSION["ErrorMessage"] = "Error encountered!";
		header('Location: transactionapproval.php');
		exit;
	}
	ob_get_flush();
 ?>