<?php if(!isset($_SESSION['userName']) || empty($_SESSION['userName']) ){
    header('location: ../index.php');
    exit;
    }
if("$_SESSION[userName]" != "admin"){
    $_SESSION["ErrorMessage"] = "You cannot access admin";
    header('location: ../Homepage');
    exit;
}
?>