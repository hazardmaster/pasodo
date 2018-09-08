<?php
    require_once("include/sessions.php"); 
    $conn = mysqli_connect("localhost", "root", "", "pasodo");
    if(isset($_POST["submit"])){
        $ID_number = $_POST["id_number"];
        $F_name = $_POST["F_name"];
        $M_name = $_POST["M_name"];
        $L_name = $_POST["L_name"];
        $category = $_POST["category"];                       
        $phonenumber = $_POST["phonenumber"];       
        //$date = $_POST["date"];       
        
        if(empty('$ID_number') || empty("$F_name") || empty("$M_name") || empty("$L_name") || empty("$category") || empty("$phonenumber")){
            $_SESSION["ErrorMessage"] = "All fields must be filled out";
            header ("Location:backend.php");
           exit;
       }else{
            $_SESSION["SuccessMessage"] = "Entry successful";
            date_default_timezone_set("Africa/nairobi");
            $date = time();
            $datetime=strftime("%d-%m-%Y %H:%M:%S", $date);
            $datetime;
            $sql = "INSERT INTO clients2(clientID,firstname,middlename,lastname,Category,Phone,Date) VALUES('$ID_number','$F_name','$M_name','$L_name','$category','$phonenumber','$datetime')";
            $execute = mysqli_query($conn, $sql);  
            header("Location:backend.php");
                exit;
       }    
    }
        
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
                     <span><a href="backend.php" ><img src="img/pasodo5.jpg" style="margin-top:10px; margin-bottom:10px" width=full height=55px></a></span>
                    <!--<h3 style="color:white">Super Admin!!!</h3>-->
                    <ul id="side_menu" class="nav nav-pills nav-stacked">
                        <li class="active"><a href="backend.php">Add new client</a></li>
                        <li><a href="viewfarmers.php">View Categories</a></li>
                            <!-- <div class="dropdown">
                              <button class="btn dropdownbutton dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <a href="viewfarmers.php">View Categories</a>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="viewfarmers.php">Farmers</a></li>
                                <li><a class="dropdown-item" href="viewfarmers.php">Staff</a></li>
                                <li><a class="dropdown-item" href="viewfarmers.php">Others</a></li>                                
                              </div>
                            </div>-->
                        <li><a href="">Approve transactions</a></li>
                        <li><a href="">Manage administrators</a></li>
                        <li><a href="frontend.php">Front end</a></li>
                    </ul>
                </div>
                <div class="col-sm-10">
                    <h1>Add New Client</h1>
                    <div> <?php echo message(); 
                                echo SuccessMessage();
                        ?> </div>
                    <div>
                        <form action="backend.php" method="post">
                             <?php
                                    if($conn){
                                        echo "connection possible"; 
                                    }else{
                                        echo "connection failed";
                                    }?>
                            <fieldset>
                                <div class="form-group">
                                    <label for="id_number">ID Number</label>
                                    <input class="form-control" value="23547689" type="text" name="id_number" id="id_number" placeholder="ID number" >
                                </div>
                                <div class="form-group">
                                    <label for="name">Client Name</label><br>
                                    <input class="" type="text" name="F_name" id="F_name" placeholder="First Name" value="Jane">
                                    <input class="" type="text" name="M_name" id="M_name" placeholder="Middle Name" value="Hazard">
                                    <input class="" type="text" name="L_name" id="L_name" placeholder="Last Name" value="Doe">
                                </div>
                               
                                <div class="form-group">
                                    <label for="phonenumber">Phone number</label>
                                    <input class="form-control" type="text" name="phonenumber" id="phonenumber" value="0724657487" placeholder="Phone number">
                                </div>
                                <label>Categories: </label><br>
                                
                                <select value = "categories" name="category" class="">
                                    <?php                                    
                                        $sql = ("SELECT * FROM categories");
                                        $execute = mysqli_query($conn, $sql);                                       
                                        $i = 1;
                                            while($rows = mysqli_fetch_array($execute)){
                                                $cat_name = $rows["name"];
                                                $cat_ID = $rows["ID"];
                                                ?>                               
                                    <option value="<?php echo $cat_ID; ?>"><?php echo $cat_name; ?></option> // displaying categories
                                               <?php $i++;} ?>
                                </select><br><br>
                                <!-- <div class="form-group">
                                    <label for="category">Category</label>
                                    <input class="form-control" type="text" name="category" id="category" placeholder="category">
                                </div> -->
                                <!--<div class="form-group">
                                    <label for="date">Date</label>
                                    <input class="form-control" type="date" name="date" id="date" placeholder="date today">
                                </div>
                                <br>-->
                                <input class="btn btn-success btn-block" type="submit" name="submit" value="Add new client"  >
                                <br>
                                
                            </fieldset>
                        </form>
                    </div>
                </div><!--ending of col 10-->
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