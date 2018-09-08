<?php $conn = mysqli_connect("localhost", "root", "", "pasodo"); ?>
<?php require_once("include/sessions.php") ?>

<!DOCTYPE>

<html>
    <head>
        <title>Back end</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/backend.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                    <span><a href="backend.php" ><img src="img/pasodo5.jpg" style="margin-top:10px; margin-bottom:10px" width=full height=55px></a></span>
                    
                    <ul id="side_menu" class="nav nav-pills nav-stacked">
                        <li><a href="backend.php">Add new client</a></li>
                            <div class="dropdown">
                              <button class="btn dropdownbutton btn-secondary active dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <li><a href="viewfarmers.php">View Categories</a></li>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="viewfarmers.php" active>Farmers</a></li>
                                <li><a class="dropdown-item" href="">Staff</a></li>
                                <li><a class="dropdown-item" href="">Others</a></li>                                
                              </div>
                            </div>
                        <li><a href="">Approve transactions</a></li>
                        <li><a href="">Manage administrators</a></li>
                    </ul>
                </div>
                <div class="col-sm-10">
                    <h1>View Categories</h1>
                    <div> <?php echo message(); 
                                echo SuccessMessage();
                        ?> </div>
                    <div class="table-responsive">
                         <table class="table table-striped table-hover">
                            <tr>
                                <th>ID NUMBER</th>
                                <th>NAME</th>
                                <th>CATEGORY</th>
                                <th>PHONE NUMBER</th>
                                <th>Date Added</th>
                            </tr>
                             <?php
                                global $conn;
                                $fetch_array = "SELECT * FROM clients";
                                $execute = mysqli_query($conn, $fetch_array);
                                $i = 0;
                                while($datarows = mysqli_fetch_array($execute)){
                                    $ID = $datarows["ID"];
                                    $name = $datarows["Name"];
                                    $category = $datarows["Category"];
                                    $phone = $datarows["Phone"];
                                    $date = $datarows["Date"];
                                    $i++;
                                 ?>
                                    
                                <tr>
                                <td><?php echo $ID ?></td>
                                <td><?php echo $name ?></td>
                                <td><?php echo $category ?></td>
                                <td><?php echo $phone ?></td>
                                <td><?php echo $date ?></td>
                             </tr>
                               <?php } ?>
                            
                             
                        </table>
                    </div>
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