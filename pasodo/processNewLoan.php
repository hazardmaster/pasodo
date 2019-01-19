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
        }
        //prepare and bind
        $stmt = $conn->prepare("INSERT INTO loan (clientID,amount,created_at,updated_at,deadline_at,image,notes) VALUES (?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssss", $clientID, $loanAmount, $datetime, $datetime, $deadlineDate, $image, $notes);
        $result = $stmt->execute();
        if($result){
            $_SESSION["SuccessMessage"] = "Amount entered successfully to the database";
            header("Location: processNewLoan.php?id=$clientID");
            exit;
        }
        $stmt->close();
        $conn->close();

    ?>
<!DOCTYPE>

<html>
    <head>
        <title>Loan Application Form</title>
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
                        <li class="active"><a href="loan.php">client Info</a></li>
                        <li><a href="transaction.php">Make Transaction</a></li>
                        <li><a href="backend.php">Admin</a></li>
                        <!-- <li><a href="">Manage administrators</a></li>-->
                    </ul>
                </div>
                <div class="col-sm-10">
                    <h1 style="color: #000000">New Loan Application Form</h1>
                    <?php
                        echo message();
                        echo SuccessMessage();
                    ?>
                     
                     <!--Form for entering client information-->
                        <form action="" method="post" onsubmit="formValidation()"  name="loanForm" id="loanForm">                        
                            <fieldset  style="color: #000000">

                                <!--Loan Amount-->
                                <div class="form-group">
                                    <label for="loanAmount">Loan Amount:</label>
                                    <input style="margin-left: 40px" type="Number" name="loanAmount" id="loanAmount" placeholder="Enter Amount" >
                                </div>
                                
                               <!--Transaction image-->
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        <label for="image">Image:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="file" name="image" id="image">
                                    </div>                              
                                </div><br> 

                                <!--Deadline date -->                                
                                <div class="form-group">
                                    <label for="deadlineDate">Deadline Date</label>
                                    <input type="Date" name="deadlineDate" placeholder="Loan deadline" id="deadlineDate">
                                </div>
                                <!--Loan Officer Side Notes-->
                                <div class="form-group">
                                    <label for="image">Loan Officer notes:</label>
                                    <textarea name="notes" class="form-control" rows="14px" cols="20px">Add notes here</textarea>
                                </div><br><br>
                                <input type="hidden" name="clientID" value="<?php $clientID = $_GET["id"]; echo $clientID; ?> ">

                                <!--Submit Client Information-->
                                <input class="btn btn-success btn-block" type="submit" name="submit" value="Submit Information"  >
                                <br>
                                
                            </fieldset>
                            
                            <script>
                                function formValidation(){                                    
                                    return confirm("Click ok to proceed");
                                }

                            </script>
                        </form>            
                </div>
            </div><!-- Ending of row-->
        </div><!-- ending of container-->
        <div id="footer" style="position: fixed; bottom: 0; width: 1360px;">
            <hr><p>Brain Behind | Oscar Hazard | &copy;2018  --- All rights reserved</p>
            <a style="color:white; text-decoration: none; cursor:pointer; fontweight:bold;" href="http://pasodo.com">Pasodo</a>
            <p>This site is only for use by PASODO finance group. All rights reseved. No one is allowed to make a copy of this site.</p>
        </div>
        <div style="height: 10px; background: #27AAE1;"></div>
    </body>

</html>