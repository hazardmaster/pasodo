<?php $conn = mysqli_connect("localhost", "root", "", "pasodo"); ?>
<?php require_once("include/sessions.php") ?>
<?php
    //check connection
    if($conn->connect_error){
        die("Connection failed: ".$conn->connect_error);
    }
        $ID = $_GET["id"];
        $sql = "DELETE FROM client2 WHERE ID='$ID'";
        if ($conn->query($sql) === TRUE){
            $_SESSION["SuccessMessage"] = "Record deleted successful";
            header("Location: categories.php");
        }else{
            $_SESSION["SuccessMessage"] = "Error deleting the file";
            header("Location: viewfarmers.php");
        }
    ?>