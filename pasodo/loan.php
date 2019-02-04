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
                        <a class="" href="homepage.php"><img src="img/pasodo5.jpg" alt="" width=150px height="full" /></a>
                    </center>
                        
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                            
                        <li><a href="homepage.php">Loan Officer</a></li>
                            
                        <li><a href="backend.php">Admin</a></li>                      

                    </ul>
                        <li style="float: right;"><a href="processNewLoan.php?id=<?php
                            $clientID = $_SESSION["clientID"];
                             echo $clientID; ?>" 
                             class="btn btn-info btn-large" style="background-color: green" >New Loan!</a></li>
                </div>
            </div>
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                   <!--<h3 style="color:white">Super Admin!!!</h3>-->
                    <ul id="side_menu" class="nav nav-pills nav-stacked">
                        <li class="active"><a href="homepage.php">client Info</a></li>
                        <li><a href="">Make Transaction</a></li>
                        <!-- <li><a href="">Manage administrators</a></li>-->
                    </ul>
                </div>
                <div class="col-sm-10" style="width: 80%" >
                    <h1 style="color: #000000">Client information</h1>

                    <?php
                        echo message();
                        echo SuccessMessage();
                    

                        //Check client personal Info
                        $clientID = $_SESSION["clientID"];
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


                            <!-- The content section oc col-sm-10-->
                                <!--Section for image of the different clients-->
                            <section id="clientImage">
                                <div class="row">
                                    <center>
                                        <?php
                                        $sqlQuery = "SELECT * FROM client2 WHERE clientID = $clientID";
                                        $rs = $conn->query($sqlQuery);
                                        $result=mysqli_fetch_array($rs);
                                        echo '<img src="data:image/jpeg;base64,'.base64_encode( stripslashes($result['image']) ).'" width="300" height="300"" />';
                                        ?>
                                    </center>
                                    
                                </div>
                            </section>                        


                            <!--This section shows the payment information of the client i.e 1. Total alltime loan. 2. Amount Total amount paid. 3. Remaining amount-->
                            <section style="margin-left: 45px ;margin-right: 50px; margin-top: 10px ">
                                    <div class="row" style="position: relative; background-color: black; ">

                                        <div class="col-lg-7 col-md-7 col-sm-12">

                                            <!--Action is either to borrow new loan or pay loan -->

                                            <!--Button for new loan and pay loan-->
                                            <div class="row" style="padding: 30px">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                    <div class="newloan">
                                                        <a href="processNewLoan.php?id=<?php
                                                             echo $clientID; ?>" 
                                                             class="btn btn-success btn-large" style="text-decoration: none;" ><span><img src="img/new-loan-icon.png" width="40px" height="40px"></span> NEW LOAN
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                    <div class="payloan">
                                                        <a href="processPayLoan.php?id=<?php
                                                             echo $clientID; ?>" 
                                                             class="btn btn-danger btn-large" style="text-decoration: none;" ><span><img src="img/pay-loan-icon.png" width="40px" height="40px"></span>PAY LOAN
                                                        </a>
                                                    </div>
                                                </div>                                     
                                            </div>                                           
                                        </div>

                                        <div class="col-lg-5 col-md-5 col-sm-12">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="padding: 5px">
                                                    <h4 class="" style="font-size: 42px; color: green;">                                                  
                                                            <?php 
                                                                $sql = "SELECT SUM(amount) AS totalAmount FROM loan WHERE clientID = '$clientID' ";
                                                                $result = $conn->query($sql);
                                                                if($result){
                                                                    $datarows = $result->fetch_assoc();
                                                                    $totalLoanAmount = $datarows['totalAmount'];
                                                                    echo $totalLoanAmount;                                                                   
                                                                }else{
                                                                    echo "invalid";
                                                                }
                                                              ?>
                                                       
                                                    </h4>
                                                        <h5 style="color: white">Total Loan Borrowed</h5>
                                                </div>

                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="border-left: 1px dashed #fff; border-right: 1px dashed #fff; padding: 5px">
                                                    <h4 class="" style="font-size: 42px; color: orange">
                                                        <?php 
                                                                $sql = "SELECT SUM(amount) AS totalAmount FROM payments WHERE clientID = '$clientID' ";
                                                                $result = $conn->query($sql);
                                                                $num_rows = mysqli_num_rows($result);
                                                                if($num_rows > 0){

                                                                $datarows = $result->fetch_assoc();
                                                                    $totalPaymentAmount = $datarows['totalAmount'];
                                                                    echo $totalPaymentAmount;     
                                                                }else{
                                                                    echo "0.00";
                                                                }
                                                              ?>
                                                    </h4>
                                                    <h5 style="color: white">Total Loan Paid</h5>
                                                </div>

                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="padding: 5px">
                                                    <h4 class="avail-balance-sum balance-sum" style="font-size: 42px; color: yellow; margin: 5px; padding: 5px">
                                                        <span>
                                                            <?php
                                                            $outstandingBalance = $totalLoanAmount - $totalPaymentAmount;
                                                                    echo $outstandingBalance;
                                                                    ?>
                                                        </span>
                                                    </h4>
                                                    <h5 style="color: white">Outstanding Balance</h5>
                                                </div>                                           
                                            </div>
                                        </div>     

                                    </div>  
                            </section>


            <!--Section Displaying client Particular info with A table-->
        <section style="margin: 30px">
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

                <!--Displaying Payment Information in a Table-->

                <div class="table-responsive">
                    <table class="table table-borderless table-dark">
                        <thead class="thead-light" style="color: #000000">
                            <th>Date</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Balance</th>
                            <th>Status</th>
                        </thead>
                        <?php  

                        //Seect client Info from the loans table
                        $sql = "SELECT * FROM loan WHERE clientID = '$clientID' ";
                        $result = $conn->query($sql);

                        while ($datarows = $result->fetch_assoc()) {
                            $date = $datarows["created_at"];                                   
                            $debit = $datarows["amount"];
                            $status = $datarows["status"];
                                            
                        ?>
                            <tr style="color: #000000">
                                <td><?php echo $date ?></td>
                                <td><?php echo $debit ?></td>
                                <td><?php echo "Holla"; ?></td>
                                <td><?php echo "Holla"; ?></td>
                                <td><?php echo $status ?></td>                                            
                            </tr>
                            <?php  
                                }                                   
                             ?>                       
                    </table>
                </div>
            </div>
        </section>

                <?php
            }
        ?>

                </div><!--End of col-sm-10-->
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

