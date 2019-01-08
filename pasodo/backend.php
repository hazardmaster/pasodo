<?php require_once("include/sessions.php"); 
$conn = mysqli_connect("localhost", "root", "", "pasodo"); ?>

<!DOCTYPE>
<html>
    <head>
        <title>Categories</title>        
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/clientForm.css">
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
                        <li><a href="categories.php">View Categories</a></li>
                        <li><a href="">Approve transactions</a></li>
                        <li><a href="">Manage administrators</a></li>
                        <li><a href="index.php">Front end</a></li>
                    </ul>
                </div>
                <div class="col-sm-10">
                    <h1>Add New Client</h1>
                    <div> <?php echo message(); 
                                echo SuccessMessage();
                        ?> </div>
                    <div>
                        <!--Form for entering client information-->
                        <form action="processes/processclient.php" method="post" onsubmit="return formValidation()"  name="clientForm" id="clientForm">                        
                            <fieldset>

                                <!--Client ID-->
                                <div class="form-group">
                                    <label for="id_number">ID Number:</label>
                                    <input class="form-control" value="23547689" type="text" name="clientId" id="clientId" placeholder="ID number" >
                                </div><br><br> 

                                <!--Client Full names-->
                                <div class="form-group">
                                    <label for="name">Client Name:</label><br>
                                    <input class="" type="text" name="firstName" id="firstName" placeholder="First Name" value="Jane">
                                    <input class="" type="text" name="middleName" id="middleName" placeholder="Middle Name" value="Hazard">
                                    <input class="" type="text" name="lastName" id="lastName" placeholder="Last Name" value="Doe">
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
                                    <select value = "category" name="category">
                                        <?php                                    
                                            $sql = "SELECT * FROM category";
                                            $result = $conn->query($sql);

                                            $i = 0;
                                            while($rows = $result->fetch_assoc()){
                                                    $cat_name = $rows["name"];
                                                    $cat_ID = $rows["ID"];
                                                    ?>                               
                                        <option value="<?php echo $cat_ID; ?>"><?php echo $cat_name; ?></option>  
                                                   <?php $i++;
                                                            } 
                                                              ?>
                                    </select><br><br> 
                                </div>                               

                                <!--Client Image for Authentication of Information-->
                                <div class="form-group">
                                    <label for="image">Client Image:</label>
                                    <input class="form-control" type="file" name="image" id="image" >
                                </div><br><br>
                                
                                <!--Submit Client Information-->
                                <input class="btn btn-success btn-block" type="submit" name="submit" value="Add new client"  >
                                <br>
                                
                            </fieldset>
                            
                            <script>
                                function formValidation(){
                                    // Validate client ID
                                    return confirm("Confirm if you want to submit");
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
                                                        return true;
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
        <div id="footer">
            <hr><p>Brain Behind | Oscar Hazard | &copy;2018  --- All rights reserved</p>
            <a style="color:white; text-decoration: none; cursor:pointer; fontweight:bold;" href="http://pasodo.com">Pasodo</a>
            <p>This site is only for use by PASODO finance group. All rights reseved. No one is allowed to make a copy of this site.</p>
        </div>
        <div style="height: 10px; background: #27AAE1;"></div>
    </body>

</html>