<?php $conn = mysqli_connect("localhost", "root", "", "pasodo"); ?>
<?php require_once("include/sessions.php") ?>
<?php
    if(isset($_POST["id"])){
        $clientID = $_POST["id"];
        echo $clientID;
        $query = "DELETE FROM client WHERE ID='$clientID'";
        $execute = mysqli_query($query);
        if ($execute){
            $_SESSION["SuccessMessage"] = "deletion successful";
            header("Location: viewfarmers.php");
        }else{
            $_SESSION["SuccessMessage"] = "something is not right";
            header("Location: viewfarmers.php");
        }
    }
    ?>