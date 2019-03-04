<?php 
ob_start();
require_once("../include/sessions.php"); 
$conn = mysqli_connect("localhost", "pasodomo_oscar", "Oscar3296!!!", "pasodomo_pasodo"); 
include('../myHTML/simple_html_dom.php');
require_once("adminAuthentication.php");
    ?>


<!DOCTYPE>
<html>
    <head>
        <title>Admin Back End</title>        
        <?php           
            echo file_get_html('../myHTML/myLinks.html');
             ?>        
    </head>
    <body>
        <!--Top navigation bar -->
        <?php           
            echo file_get_html('../myHTML/navbar.html');

             ?>
        <!--The Body part -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                    <!--<h3 style="color:white">Super Admin!!!</h3>-->
                    <ul id="side_menu" class="nav nav-pills nav-stacked">
                        <li class="active"><a href="index.php">Add new client</a></li>
                        <li><a href="categories.php">View Categories</a></li>
                        <li><a href="transactionapproval.php">Approve transactions</a></li>
                        <li><a href="">Manage administrators</a></li>
                        <li><a href="../Homepage.php">Front end</a></li>
                        <li style="float: right;">
                            <a href="../include/sessionsDestroy.php?userName=<?php echo $_SESSION['userName']; ?>" class="btn btn-danger btn-large">Logout
                            </a>
                        </li>
                    </ul>                     
                </div>
                <div class="col-sm-10">


                    <h1>Add New Client</h1>
                    <div> <?php echo message(); 
                                echo SuccessMessage();
                        ?> </div>
                    <div>
                        <!--Form for entering client information-->
                        <form action="processclient.php" method="POST" onsubmit="formValidation()"  name="clientForm" id="clientForm" enctype="multipart/form-data">                        
                            <fieldset>

                                <!--Client ID-->
                                <div class="form-group">
                                    <label for="id_number">ID Number:</label>
                                    <input class="form-control" value="23547689" type="text" name="clientId" id="clientId" placeholder="ID number" >
                                </div><br><br> 

                                <!--Client Full names-->
                                <div class="form-group">
                                    <label for="name">Client Name:</label><br><br>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="firstName">First name:</label>
                                            <input class="" type="text" name="firstName" id="firstName" placeholder="First Name" value="Jane">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="middleName">Middle name:</label>
                                            <input class="" type="text" name="middleName" id="middleName" placeholder="Middle Name" value="Hazard">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="lastName">Last name:</label>
                                            <input class="" type="text" name="lastName" id="lastName" placeholder="Last Name" value="Doe">
                                        </div>
                                    </div>                            
                                </div><br><br> 
                               
                               <!--Client Phone number-->
                                <div class="form-group">
                                    <label for="phonenumber">Phone number:</label>
                                    <input class="form-control" type="text" name="phoneNumber" id="phoneNumber" value="0724657487" placeholder="Phone number">
                                </div><br><br> 

                                <!--Client Gender-->
                                <div class="form-group">
                                    <label for="gender">Gender:</label><br>
                                    <input type="radio" name="gender" value="male"> Male<br>
                                    <input type="radio" name="gender" value="female"> Female<br>
                                    <input type="radio" name="gender" value="other"> Other
                                </div><br>

                                <!--Client category-->
                                <div class="form-group">
                                    <label>Categories: </label><br>                                
                                    <select value = "category" name="category" style="width:100%; padding: 12px; margin: 8px 0px;">
                                        <?php                                    
                                            $sql = "SELECT * FROM category";
                                            $result = $conn->query($sql);

                                            $i = 0;
                                            while($rows = $result->fetch_assoc()){
                                                    $cat_name = $rows["name"];
                                                    $cat_ID = $rows["ID"];
                                                    ?>                               
                                        <option style=""><?php echo $cat_name; ?></option>  
                                                   <?php $i++;
                                                            } 
                                                              ?>
                                    </select><br><br> 
                                </div>                               

                                <!--Client Image for Authentication of Information-->
                                <div class="form-group">
                                    <label for="image">Client Image</label>
                                    <input class="form-control" type="file" name="image" id="image" >
                                </div><br><br> 
                                
                                <!--Submit Client Information-->
                                <input class="btn btn-success btn-block" type="submit" name="submit" value="Add new client"  >
                                <br>
                                
                            </fieldset>
                            
                            <script>
                                function formValidation(){                                    
                                    // Validate client ID
                                    var clientId = document.getElementById("clientId").value;
                                    var toString = clientId.toString();
                                    var idLength = toString.length;
                                    if(idLength != 8){
                                        alert("This ID is not valid");
                                        return false;
                                    }else{
                                        // Validate client names
                                        var firstName = document.getElementById("firstName").value;
                                        var middleName = document.getElementById("middleName").value;
                                        var lastName = document.getElementById("lastName").value;
                                        var firstNameLength = firstName.length;
                                        var middleNameLength = middleName.length;
                                        var lastNameLength = lastName.length;

                                            //check if client names are alphabet values. Return false if !=
                                            if(firstNameLength > 2){
                                                if(middleNameLength > 2 ){
                                                    if(lastNameLength > 2){
                                                        return confirm("Confirm if you want to submit");
                                                    }else{
                                                        alert(" last name cannot be less than 3 letters");
                                                    }
                                                }  else{
                                                    alert("middle name cannot be less than 3 letters");
                                                }  
                                             }else{
                                                alert("first name cannot be less than 3 letters");
                                                return false;
                                            } 
                                        }
                                                                      
                                }

                            </script>
                        </form>
                    </div>
                </div><!--ending of col 10-->
            </div><!-- Ending of row-->            

        </div><!-- ending of container-->


       <?php include("../include/footer.php"); ?>

</html>

<?php ob_get_flush(); ?>