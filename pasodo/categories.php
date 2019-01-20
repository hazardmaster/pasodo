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
        <!--Top navigation bar -->
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
        <!--The Body part -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                    <ul id="side_menu" class="nav nav-pills nav-stacked">
                        <li><a href="backend.php">Add new client</a></li>
                        <li class = "active"><a href="categories.php">View Categories</a></li>
                        <li><a href="transactionapproval.php">Approve transactions</a></li>
                        <li><a href="">Manage administrators</a></li>
                    </ul>
                </div>
                <div class="col-sm-10">
                    <h1 style="color: #000000">View Categories</h1>
                    <div> <?php echo message(); 
                                echo SuccessMessage();
                        ?> </div>
                    <?php                    
                    //Show categories on drop down
                    if($conn->connect_error){
                        die("Connection failed:" .$conn->connect_error);
                    }
                        $sql = "SELECT * FROM category";
                        $result = $conn->query($sql);
                        if($result->num_rows > 0){
                            //output of each row                             
                                ?>

                                <form action="">                                    
                                    <select name='catName' onchange='this.form.submit()'>
                                      <?php
                                        while ($row = $result->fetch_assoc()){
                                            $catID = $row['ID'];
                                            $catName = $row['name']; ?>
                                        <option> <?php echo $catName; ?> </option>
                                       <?php } ?>
                                    </select>

                                    <noscript><input type="submit" value="Submit"></noscript>
                                </form>

                           <?php } ?> 
                        
                    
                    
                   <!--  -->
                    
                    <div class="table-responsive">
                         <table class="table table-borderless table-dark">
                            <thead class="thead-light" style="color: #000000">
                                <th>ID NUMBER</th>
                                <th>NAME</th>
                                <th>PHONE NUMBER</th>
                                <th>Date Added</th>
                                <th>Action</th>
                            </thead>
                             <?php     
                                    $catName = $_GET["catName"];
                                    $sqlcat = "SELECT ID FROM category WHERE name = '$catName' ";
                                    $result = $conn->query($sqlcat);
                                    $datarow = $result->fetch_assoc();
                                    $catID = $datarow["ID"];

                                    $sql = "SELECT * FROM client2 WHERE category_id = '$catID'";
                                    $result = $conn->query($sql);

                                    if($result->num_rows > 0){
                                        while($datarows = $result->fetch_assoc()){
                                            $ID = $datarows["ID"];
                                            $clientID = $datarows["clientID"];
                                            $F_name = $datarows["firstName"];
                                            $L_name = $datarows["lastName"];
                                            $date = $datarows["created_at"];
                                            $phone = $datarows["phone"];
                                         ?>
                                        <tr style="color: #000000">
                                            <td><?php echo $clientID ?></td>
                                            <td><?php echo $F_name."  ". $L_name ?></td>
                                            <td><?php echo $phone ?></td>
                                            <td><?php echo $date ?></td>
                                            <td>
                                                <a href="editClient.php?id=<?php echo $ID?>"><span class="btn btn-info">Edit</span></a>
                                                <a href="delete.php?id=<?php echo $ID?>"><span class="btn btn-danger">Delete</span></a>
                                            </td>
                                         </tr>
                                         <?php  
                                        }
                                    }else{
                                        $_SESSION["message"] = "No results found";
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