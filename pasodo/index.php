<?php $conn = mysqli_connect("localhost", "root", "", "pasodo"); ?>
<?php require_once("include/sessions.php");?>
<?php if(isset($_POST["submitborrowed"])){
        $category = $_POST["Category"];
        echo $category;}
    ?>
<!DOCTYPE>

<html>
    <head>
        <title>Categories</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/backend.css">
        <link rel="stylesheet" href="css/frontend.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        
    </head>
    <body>
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                     <span><a href="backend.php" ><img src="img/pasodo5.jpg" style="margin-top:10px; margin-bottom:10px" width=full height=55px></a></span>
                    <!--<h3 style="color:white">Super Admin!!!</h3>-->
                    <ul id="side_menu" class="nav nav-pills nav-stacked">
                        <li class="active"><a href="">client Info</a></li>
                        <li><a href="transaction.php">Make Transaction</a></li>
                        <li><a href="backend.php">Admin</a></li>
                        <!-- <li><a href="">Manage administrators</a></li>-->
                    </ul>
                </div>
                <div class="col-sm-10">
                    <h1>View Client information</h1>
                    <?php
                        echo message();
                        echo SuccessMessage();
                    ?>
                    <form style="form-control" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="form-group">
                        <input type="text" name="clientID" id="clientID" placeholder="Enter client ID" >                        
                        <input class="btn btn-info btn-large" type="submit" name="submit" value="view client info"  >
                        </div>               
                    </form>
                    
                    
                    <a href="transaction.php? id = <?php 
                             if (isset($_POST["submit"])){
                                 $clientID = $_POST["clientID"];
                                 echo $clientID;
                             }
                             
                             ?>" class="btn btn-light btn-small"><span>Pay loan</span></a>
                        <a href="" class="btn btn-light btn-small" data-toggle="modal" data-target="#borrowloan"><span>Borrow loan </span></a>
                    <div class="modal fade" id="borrowloan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                             <h3>Borrow Loan <?php echo $clientID?></h3> 
                                </div>
                                <?php $fetch_array = "SELECT * FROM clients2 WHERE ID = '$clientID' ";                                        
                                    $execute = mysqli_query($conn, $fetch_array);                                     
                                while($datarows = mysqli_fetch_array($execute)){
                                    $ID = $datarows["ID"];
                                    $name = $datarows["Name"];
                                    $category = $datarows["Category"];
                                    $phone = $datarows["Phone"];
                                    $date = $datarows["Date"];
                                    ?>
                        
                                    
                                        
                        
                       <?php } 
                                

                            
                            ?>
                                
                                <form action="borrow.php" method="post" enctype="multipart/form-data">                                  
                                    <label for="Borrowername" class="col-sm-4 col-form-label">Name:</label>                            
                                    <input type="text" readonly class="form-control-plaintext" name='name' id="Borrowername" value="<?php echo $name; ?>"><br><br>
                                    <label for="BorrowerID" class="col-sm-4 col-form-label">ID Number:</label>
                                    <input type="text" readonly class="form-control-plaintext" id="BorrowerID" name='id' value="<?php echo $ID;?>"><br><br>
                                    <br><br>              
                                    <label class="col-sm-12 col-form-label">How Much Do you want to borrow Mr. <?php echo $name?>:</label><br>     <label for="Borroweramount" class="col-sm-4 col-form-label">Amount:</label>
                                    <input type="text" class="form-control-plaintext" name="amount" id="amount" placeholder="Min 500 - Max 20,000"><br><br>
                                    <label for="Borroweramount" class="col-sm-4 col-form-label">Transaction Date:</label>
                                    <input type="date" name="T_Date" class="form-control-plaintext" id="T_Date" placeholder="<?php                         date_default_timezone_set("Africa/nairobi");
                                            $date = time();
                                            $datetime=strftime("%d-%m-%Y %H:%M:%S", $date);
                                            echo $datetime; ?>" ><br><br>
                                    <label for="scanned" class="col-sm-4 col-form-label">Transaction image:</label>
                                    <input type="file" name="scanned" class="form-control-plaintext" id="scanned"  ><br><br>
                                    
                                    <div class="row">
                                    <div class="col-md-6 offset-md-3">
                                        <input class="btn btn-dark btn-small col-md-4 offset-md-4" type="submit" name="submitborrowed" value="borrow"><br><br> 
                                    </div>
                                    </div>
                                    <input type="hidden" name="categories" class="form-control-plaintext" id="Categories" value="<?php echo $category ?>" ><br>
                                               
                                </form>
                            </div>
                        </div>
                    </div>
                        <br>
                    
                   
                    <table class="table table-striped table-hover">
                        <tr>
                                <th>ID NUMBER</th>
                                <th>NAME</th>
                                <th>CATEGORY</th>
                                <th>PHONE NUMBER</th>
                                <th>Date Added</th>
                            </tr>
                             <?php
                        
                                if(isset($_POST["submit"])){
                                    
                                    $fetch_array = "SELECT * FROM clients2 WHERE ID = '$clientID' ";
                                        
                                    $execute = mysqli_query($conn, $fetch_array); 
                                    
                                while($datarows = mysqli_fetch_array($execute)){
                                    $ID = $datarows["ID"];
                                    $name = $datarows["Name"];
                                    $category = $datarows["Category"];
                                    $phone = $datarows["Phone"];
                                    $date = $datarows["Date"];
                                    
                                    
                                    
                                    
                                 ?>
                                <input type="hidden" name="hazard" value="<?php echo $ID ?>">
                                <tr>
                                <td><?php echo $ID ?></td>
                                <td><?php echo $name ?></td>
                                <td><?php echo $category ?></td>
                                <td><?php echo $phone ?></td>
                                <td><?php echo $date ?></td>
                                </tr>
                                
                               <?php }
                                    
                               } ?>
                                                    
                    </table> 
                    
                </div>
            </div><!-- Ending of row-->
        </div><!-- ending of container-->
        <div id="footer">
            <hr><p>Brain Behind | Oscar Hazard | &copy;2018  --- All rights reserved</p>
            <a style="color:white; text-decoration: none; cursor:pointer; fontweight:bold;" href="http://pasodo.com">Pasodo</a>
            <p>This site is only for use by PASODO finance group. All rights reseved. No one is allowed to make a copy of this site.</p>
        </div>
        <div style="height: 10px; background: #27AAE1;"></div>
    </body>

</html>