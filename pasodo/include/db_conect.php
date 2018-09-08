<?php
    $conn = mysqli_connect("localhost", "root", "", "PASODO");
    if($conn){
        echo "Database connect";
    }else{
        echo "Database connection failure";
    }
?>