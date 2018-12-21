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
                        <li><a href="viewfarmers.php">View Categories</a></li>
                        <li><a href="">Approve transactions</a></li>
                        <li><a href="">Manage administrators</a></li>
                    </ul>
                </div>
                <div class="col-sm-10">
                    <h1>View Categories</h1>
                    <div> <?php echo message(); 
                                echo SuccessMessage();
                        ?> </div>
                    <?php
                        $sql = ("SELECT * FROM categories");
                        $execute = mysqli_query($conn, $sql);
                        $j=1;
                        while($rows=mysqli_fetch_array($execute)){
                            $catID = $rows['ID'];
                            $catname = $rows['name'];$j++;?>
                    
                        <form method="post" action="">
                            <select>
                                <option value="<?php echo $catID; ?>"><?php echo $catname; ?></option>
                            </select>
                        </form>
                    
                                              
                             
                        <?php  } ?>
                    
                        
                    
                    
                   <!--  -->
                    
                    <div class="table-responsive">
                         <table class="table table-borderless table-dark">
                            <thead class="thead-light">
                                <th>ID NUMBER</th>
                                <th>NAME</th>
                                <th>PHONE NUMBER</th>
                                <th>Date Added</th>
                                <th>Action</th>
                            </thead>
                             <?php                                
                                $testname = "farmer";
                                                                  
                                $fetch_array = "SELECT * FROM clients2 where category='$testname'";
                                $execute = mysqli_query($conn, $fetch_array);
                                $i = 0;
                                while($datarows = mysqli_fetch_array($execute)){
                                    $clientID = $datarows["clientID"];
                                    $F_name = $datarows["firstname"];
                                    $M_name = $datarows["middlename"];
                                    $L_name = $datarows["lastname"];
                                    $date = $datarows["Date"];
                                    $phone = $datarows["Phone"];
                                    
                                    
                                    $i++;
                                 ?>
                                    
                                <tr>
                                <td><?php echo $clientID ?></td>
                                <td><?php echo $F_name."  ". $L_name ?></td>
                                <td><?php echo $phone ?></td>
                                <td><?php echo $date ?></td>
                                <td><a href="delete.php?<?php echo $ID?>"><span class="btn btn-danger">Delete</span></a></td>
                             </tr>
                                    
                                    
                                    
                                 
                             
                             
                               
                               <?php  } ?>
                            
                             
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