<?php $conn = mysqli_connect("localhost", "root", "", "pasodo"); ?>
<?php require_once("include/sessions.php");?>

<?php 
    $clientID = $_GET["id"];
    if (isset($_POST["submit"])) {
        $loanAmount = $_POST["loanAmount"];
        date_default_timezone_set("Africa/nairobi");
            $date = time();
            $datetime=strftime("%d-%m-%Y %H:%M:%S", $date);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //prepare and bind
        $stmt = $conn->prepare("INSERT INTO payments (clientID,amount,created_at,updated_at) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $clientID, $loanAmount, $datetime, $datetime);
        if($stmt->execute() === TRUE){
            $_SESSION["SuccessMessage"] = "Amount entered to successful as new loan";
            header('Location: loan.php');
            exit;
        }else{
            $_SESSION["ErrorMessage"] = "Error entering amount";
            header('Location: loan.php');
            exit;
        }
        $stmt->close();
        $conn->close();

    }

 ?>


<!DOCTYPE>

<html>
    <head>
        <title>Loan Payment</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/backend.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        
    </head>
    <body>
        <div class="navbar navbar-inverse">
                <div class="navbar-header" style="padding: 0px">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <center>
                        <a class="" href="index.php"><img src="img/pasodo5.jpg" alt="" width=150px height="full" /></a>
                    </center>
                        
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                            
                        <li><a href="index.php">Loan Officer</a></li>
                            
                        <li><a href="backend.php">Admin</a></li>                    

                    </ul>
                </div>
            </div>
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                   <!--<h3 style="color:white">Super Admin!!!</h3>-->
                    <ul id="side_menu" class="nav nav-pills nav-stacked">
                        <li><a href="index.php">client Info</a></li>
                        <li><a href="transaction.php">Make Transaction</a></li>
                        <li><a href="backend.php">Admin</a></li>
                        <!-- <li><a href="">Manage administrators</a></li>-->
                    </ul>
                </div>
                <div class="col-sm-10">
                    <h1 style="color: #000000">Loan Payment</h1>
                    <?php
                        echo message();
                        echo SuccessMessage();
                    ?>


                    <!--Form for entering Payment Data-->
                    <form action="" method="post" name="clientForm" id="clientForm" onsubmit="return validateForm()"> 

                        <!--Amount to be paid-->
                        <div class="form-group">
                            <label for="loanAmount">Enter Amount:</label>
                            <input class="form-control" type="number" name="loanAmount" id="loanAmount" placeholder="ID number" >
                        </div><br><br> 

                        <!--Submit Payment Information-->
                            <input class="btn btn-success btn-block" type="submit" name="submit" value="Submit"  >
                                <br>

                </div>
            </div><!-- Ending of row-->
            <script>
                function validateForm(){
                    var loanAmount = document.getElementById('loanAmount').value;
                    console.log(loanAmount);
                    if(loanAmount > 0){
                        return confirm("Please continue.");
                        return true;
                    }else{
                        alert("No input detected");
                        return false;
                    }
                }
            </script>

           

        </div><!-- ending of container-->
        <div id="footer" style="position: fixed; bottom: 0; width: 1360px;">
            <hr><p>Brain Behind | Oscar Hazard | &copy;2018  --- All rights reserved</p>
            <a style="color:white; text-decoration: none; cursor:pointer; fontweight:bold;" href="http://pasodo.com">Pasodo</a>
            <p>This site is only for use by PASODO finance group. All rights reseved. No one is allowed to make a copy of this site.</p>
        </div>
        <div style="height: 10px; background: #27AAE1;"></div>
    </body>

</html>