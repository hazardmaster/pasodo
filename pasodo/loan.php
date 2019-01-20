<?php $conn = mysqli_connect("localhost", "root", "", "pasodo"); ?>
<?php require_once("include/sessions.php");?>

<!DOCTYPE>

<html>
    <head>
        <title>Categories</title>
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
                        <li style="float: right;"><a href="processNewLoan.php?id=<?php
                            $clientID = $_POST["clientID"];
                             echo $clientID; ?>" 
                             class="btn btn-info btn-large" style="background-color: green" >New Loan!</a></li>
                </div>
            </div>
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                   <!--<h3 style="color:white">Super Admin!!!</h3>-->
                    <ul id="side_menu" class="nav nav-pills nav-stacked">
                        <li class="active"><a href="index.php">client Info</a></li>
                        <li><a href="transaction.php">Make Transaction</a></li>
                        <li><a href="backend.php">Admin</a></li>
                        <!-- <li><a href="">Manage administrators</a></li>-->
                    </ul>
                </div>
                <div class="col-sm-10" >
                    <h1 style="color: #000000">Client information</h1>

                    <?php
                        echo message();
                        echo SuccessMessage();
                    
                    if(isset($_POST["submit"])){

                        //Check client personal Info
                        $clientID = $_POST["clientID"];
                        $sql = "SELECT * FROM client2 WHERE clientID = '$clientID' ";
                        $result = $conn->query($sql);
                        while ($datarows = $result->fetch_assoc()) {
                            $clientID = $datarows["clientID"];
                            $firstName = $datarows["firstName"];
                            $middleName = $datarows["middleName"];
                            $lastName = $datarows["lastName"];
                            $phone = $datarows["phone"]; 
                            $gender = $datarows["gender"]; 
                            $date = $datarows["created_at"]; ?>

                            <center><img src="img/mathe.jpg" height="200px" width="200px"></center>

                            <div style="border: 2px black solid">
                                <h3>Personal Details</h3>
                                <div class="form-group" style="color: #000000">
                                    <label for="Name">Full Name:</label>
                                    <?php echo $firstName. "  ". $middleName. "  ". $lastName; ?>
                                </div>
                                <div class="form-group" style="color: #000000">
                                    <label for="ID number">ID Number:</label>
                                    <?php echo $clientID; ?>
                                </div>
                                <div class="form-group" style="color: #000000">
                                    <label for="Phone number">Phone Number:</label>
                                    <?php echo '0'.$phone; ?>
                                </div>
                                <?php $sql = "SELECT * FROM loan WHERE clientID = '$clientID' ";
                                $result = $conn->query($sql);
                                while ($datarows = $result->fetch_assoc()) {
                                    
                                    $clientID = $datarows["clientID"];
                                    $amount = $datarows["amount"];
                                    $created_at = $datarows["created_at"];
                                    $deadline_at = $datarows["deadline_at"];
                                    $notes = $datarows["notes"];
                                ?>
                                <div class="form-group">
                                    <hr>
                                    <h3>Loan Details</h3>
                                    <div class="form-group" style="color: #000000">
                                        <label for="loan amount">Outstanding Loan:</label>
                                        <b><span style="color: red"><?php echo $amount; ?></span></b>
                                    </div>
                                    <div class="form-group" style="color: #000000">
                                        <label for="Date Borrowed: ">Date Borrowd:</label>
                                        <?php echo $created_at; ?>
                                    </div>
                                    <div class="form-group" style="color: #000000">
                                        <label for="Deadline Date:">Deadline Date:</label>
                                        <?php echo $deadline_at; ?>
                                    </div>
                                    <div class="form-group" style="color: #000000">
                                        <label for="Loan Officer Notes:">Loan Officer Notes:</label>
                                        <p><?php echo $notes; ?></p>
                                    </div>
                                                             
                                </div>

                               <?php } ?>

                            </div>
                                                   
                       <?php }


                    }else{

                        echo "hdiuahdoia";
                        $_SESSION["message"] = "You are not here";
                    }
                    ?>

                </div>
            </div><!-- Ending of row-->
        </div><!-- ending of container-->
        <div id="footer" style="position: relative; bottom: 0; width: 1360px;">
            <hr><p>Brain Behind | Oscar Hazard | &copy;2018  --- All rights reserved</p>
            <a style="color:white; text-decoration: none; cursor:pointer; fontweight:bold;" href="http://pasodo.com">Pasodo</a>
            <p>This site is only for use by PASODO finance group. All rights reseved. No one is allowed to make a copy of this site.</p>
        </div>
        <div style="height: 10px; background: #27AAE1;"></div>
    </body>

</html>