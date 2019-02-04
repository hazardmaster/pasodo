<?php require_once("include/sessions.php"); 
$conn = mysqli_connect("localhost", "root", "", "pasodo"); ?>
?>
<!DOCTYPE>
<html>
    <head>
        <title>Edit</title>        
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/clientForm.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>        
    </head>
    <body>
        <!--Top navigation bar -->
        <?php 
            include('myHTML/simple_html_dom.php');
            echo file_get_html('myHTML/navbar.html');
             ?>
        <!--The Body part -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                    <!--<h3 style="color:white">Super Admin!!!</h3>-->
                    <ul id="side_menu" class="nav nav-pills nav-stacked">
                        <li><a href="backend.php">Add new client</a></li>
                        <li><a href="categories.php">View Categories</a></li>
                        <li><a href="transactionapproval.php">Approve transactions</a></li>
                        <li><a href="">Manage administrators</a></li>
                        <li><a href="homepage.php">Front end</a></li>
                    </ul>
                </div>
                <div class="col-sm-10">
                    <h1>Edit Client Information</h1>
                    <div> <?php echo message(); 
                                echo SuccessMessage();
                        ?> </div>
                    <div>
                    <!--Pick Client data as saved in the database-->
                        <?php
                            $ID = $_GET["id"];
                            $sql = "SELECT * FROM client2 WHERE ID = '$ID' ";
                            $result = $conn->query($sql);
                            while($datarows = $result->fetch_assoc()){
                                $clientID = $datarows["clientID"];
                                $firstName = $datarows["firstName"];
                                $middleName = $datarows["middleName"];
                                $lastName = $datarows["lastName"];
                                $phone = $datarows["phone"]; 
                                $gender = $datarows["gender"];
                                $category = $datarows["category_id"];
                                $image = $datarows["image"];

                                ?>    

                        <!--Form for entering client information-->
                        <form action="processEditClient.php"  name="clientForm" id="clientForm" onsubmit="formValidation()">                        
                            <fieldset>

                                <!--Client ID-->
                                <div class="form-group">
                                    <label for="id_number">ID Number:</label>
                                    <input class="form-control" value="<?php echo $clientID; ?>" type="text" name="clientId" id="clientId"  >
                                </div><br><br> 

                                <!--Client Full names-->
                                <div class="form-group">
                                    <label for="name">Client Name:</label><br><br>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="firstName">First name:</label>
                                            <input class="" type="text" name="firstName" id="firstName" value="<?php echo $firstName; ?>">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="middleName">Middle name:</label>
                                            <input class="" type="text" name="middleName" id="middleName" value="<?php echo $middleName; ?>">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="lastName">Last name:</label>
                                            <input class="" type="text" name="lastName" id="lastName" value="<?php echo $lastName; ?>">
                                        </div>
                                    </div>                            
                                </div><br><br> 
                               
                               <!--Client Phone number-->
                                <div class="form-group">
                                    <label for="phonenumber">Phone number:</label>
                                    <input class="form-control" type="text" name="phoneNumber" id="phoneNumber" value="<?php echo $phone; ?>" >
                                </div><br><br> 

                                <!--Client Gender-->
                                <div class="form-group">
                                    <label for="gender">Gender:</label><br>
                                    <input type="radio" name="gender" value="<?php echo $gender; ?>"> Male<br>
                                    <input type="radio" name="gender" value="<?php echo $gender; ?>"> Female<br>
                                    <input type="radio" name="gender" value="<?php echo $gender; ?>"> Other
                                </div><br>

                                <!--Client category-->
                                <div class="form-group">
                                    <label>Categories: </label><br>                                
                                    <select value = "<?php echo $category; ?>" name="category">
                                        <?php                                    
                                            $sql = "SELECT * FROM category";
                                            $result = $conn->query($sql);

                                            $i = 0;
                                            while($rows = $result->fetch_assoc()){
                                                    $cat_name = $rows["name"];
                                                    $cat_ID = $rows["ID"];
                                                    ?>                               
                                        <option><?php echo $cat_name; ?></option>  
                                                   <?php $i++;
                                                            } 
                                                              ?>
                                    </select><br><br> 
                                </div>                               

                                <!--Client Image for Authentication of Information-->
                                <div class="form-group">
                                    <label for="image">Client Image:</label>
                                    <input class="form-control" value="" type="file" name="image" id="image" >
                                </div><br><br>
                                <input type="hidden" name="ID" value="<?php echo $ID; ?>">
                                
                                <!--Submit Client Information-->
                                <input class="btn btn-success btn-block" type="submit" name="submit"   >
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
                                                        return this.submit();
                                                    }else{
                                                        alert(" last name cannot be less than 3 letters");
                                                        return false;
                                                    }
                                                }  else{
                                                    alert("middle name cannot be less than 3 letters");
                                                    return false;
                                                }  
                                             }else{
                                                alert("first name cannot be less than 3 letters");
                                                return false;
                                            } 
                                        }
                                                                      
                                }

                            </script>
                        </form>
                        <?php } ?>
                    </div>
                </div><!--ending of col 10-->
            </div><!-- Ending of row-->            

        </div><!-- ending of container-->

        <div id="footer" style="position: relative; bottom: 0; width: 1360px;">
            <hr><p>Brain Behind | Oscar Hazard | &copy;2018  --- All rights reserved</p>
            <a style="color:white; text-decoration: none; cursor:pointer; fontweight:bold;" href="homepage.php">Pasodo</a>
            <p>This site is only for use by PASODO finance group. All rights reseved. No one is allowed to make a copy of this site.</p>
        </div>
        <div style="height: 10px; background: #27AAE1;"></div>
    </body>

</html>