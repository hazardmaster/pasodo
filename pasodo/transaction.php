<?php $conn = mysqli_connect("localhost", "root", "", "pasodo"); ?>
<?php require_once("include/sessions.php") ?>

<?php
    global $clientID;
    $clientID = $_get['$clientID'];
   echo $clientID;
?>
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
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                     <span><a href="backend.php"><img src="img/pasodo5.jpg" style="margin-top:10px; margin-bottom:10px" width=full height=55px></a></span>
                    <!--<h3 style="color:white">Super Admin!!!</h3>-->
                    <ul id="side_menu" class="nav nav-pills nav-stacked">
                        <li><a href="frontend.php">client Info</a></li>
                        <li class="active"><a href="transaction.php">Make Transaction</a></li>
                        <li><a href="backend.php">Admin</a></li>
                        <!-- <li><a href="">Manage administrators</a></li>-->
                    </ul>
                </div>
                <div class="col-sm-10">
                    <h1>Make a transaction</h1>
                    <?php
                        echo message();
                    ?>
                    <form style="form-control" action="transaction.php" method="post">
                        <div class="form-group">
                        <label for="id_number">Enter ID number</label>
                        <input class="form-control" type="text" name="clientID" id="clientID" placeholder="Enter client ID" >
                        </div>
                        <a href="#" class="btn btn-info btn-small"><span>Pay loan</span></a>
                        <br><br>
                        <a href="#" class="btn btn-info btn-small"><span>Borrow </span></a>
                        <br>                                           
                    </form>
                    
                    
                    
                    
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