<?php
$servername = "localhost";
$username = "pasodomo_oscar";
$password = "Oscar3296!!!";

try {
    $conn = new PDO("mysql:host=$servername;dbname=pasodomo_pasodo", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>