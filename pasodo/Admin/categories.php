<?php $conn = mysqli_connect("localhost", "pasodomo_oscar", "Oscar3296!!!", "pasodomo_pasodo"); 
?>
<?php require_once("../include/sessions.php") ;

require_once("adminAuthentication.php");?>

<!DOCTYPE>

<html>
    <head>
        <title>Back end</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/backend.css">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function(){
              $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
              });
            });
        </script>
        <script>
            function showUser(catName) {
                if (catName == "") {
                    document.getElementById("txtHint").innerHTML = "";
                    return;
                } else { 
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("displayCategoryTable").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET","processCategories.php?catName="+catName,true);
                    xmlhttp.send();
                }
            }
        </script>
        
    </head>
    <body>
        <!--Top navigation bar -->
        <?php 
            include('../myHTML/simple_html_dom.php');
            echo file_get_html('../myHTML/navbar.html');
             ?>
        <!--The Body part -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                    <ul id="side_menu" class="nav nav-pills nav-stacked">
                        <li><a href="index.php">Add new client</a></li>
                        <li class = "active"><a href="categories.php">View Categories</a></li>
                        <li><a href="transactionapproval.php">Approve transactions</a></li>
                        <li><a href="">Manage administrators</a></li>
                    </ul>
                </div>
                <div class="col-sm-10" style="width: 80%">
                    <h1 style="color: #000000">View Categories</h1>
                    <div> <?php echo message(); 
                                echo SuccessMessage();
                        ?> 
                    </div>
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
                                    <select name='catName' onchange='showUser(this.value)'>
                                        <option value="">Select category</option>
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
                        
                    
                    
                   <!-- Filter search BAR -->
                   <input id="myInput" type="text" placeholder="Search.."><br><br>
                   <div id="displayCategoryTable"></div>                  
                    
                </div>
            </div><!-- Ending of row-->
        </div><!-- ending of container-->
        <div id="footer" style="position: fixed; bottom: 0; width: 1360px;">
            <hr><p>Brain Behind | Oscar Hazard | &copy;2018  --- All rights reserved</p>
            <a style="color:white; text-decoration: none; cursor:pointer; fontweight:bold;" href="/">Pasodo</a>
            <p>This site is only for use by PASODO finance group. All rights reseved. No one is allowed to make a copy of this site.</p>
        </div>
        <div style="height: 10px; background: #27AAE1;"></div>
    </body>

</html>