<?php $conn = mysqli_connect("localhost", "root", "", "pasodo"); ?>
<?php require_once("include/sessions.php");?>
<?php if(isset($_POST["submitborrowed"])){
        $category = $_POST["Category"];
        echo $category;}
    ?>
<!DOCTYPE>

<html>
    <head>
        <title>Loan Approval</title>
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
                        <li><a href="backend.php">Add new client</a></li>
                        <li><a href="categories.php">View Categories</a></li>
                        <li class="active"><a href="transactionapproval.php">Approve transactions</a></li>
                        <li><a href="">Manage administrators</a></li>
                        <li><a href="index.php">Front end</a></li>
                    </ul>
                </div>
                <div class="col-sm-10">
                    <h1 style="color: #000000">Please Approve the following Loans</h1>
                    <?php
                        echo message();
                        echo SuccessMessage();
                    ?>

                    <!--Input CLient Loan Information in a table for approval-->
                    <div class="table-responsive">
                         <table class="table table-borderless table-dark">
                            <thead class="thead-light" style="color: #000000">
                                <th>ID NUMBER</th>
                                <th>NAME</th>
                                <th>Amount</th>
                                <th>Loan Officer Notes</th>
                                <th>Action</th>
                            </thead>
                             <?php     
                                    $sql = "SELECT * FROM loan WHERE status = 'pending'";
                                    $result = $conn->query($sql);
                                    if($result->num_rows > 0){
                                        while($datarows = $result->fetch_assoc()){
                                            $clientID = $datarows["clientID"];
                                            $amount = $datarows["amount"];
                                            $notes = $datarows["notes"];

                                            

                                         ?>
                                        <tr style="color: #000000">
                                            <td><?php echo $clientID ?></td>
                                            <td>
                                                <?php
                                                //Looking for client's name
                                                $sql = "SELECT * FROM client2 WHERE clientID = '$clientID' ";
                                                $result = $conn->query($sql);
                                                while ($datarows = $result->fetch_assoc()) {
                                                    $firstName = $datarows['firstName'];
                                                    $middleName = $datarows['middleName'];
                                                    $lastName = $datarows['lastName'];
                                                    echo $firstName."  ". $lastName ;
                                                }        ?>                                      
                                            </td>
                                            <td><?php echo $amount ?></td>
                                            <td><?php echo $notes ?></td>
                                            <td>
                                                <a type="button" href="">Approve</a>
                                                
                                                <a type="button" href="delete.php">Disapprove</a>
                                            </td>
                                        </tr>
                                         <?php  
                                        }
                                    }else{
                                        $_SESSION["message"] = "No results found";
                                        header("Location:backend.php");
                                        exit;
                                    }
                                 ?>                       
                        </table>
                    </div>
                                     
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