<?php $conn = mysqli_connect("localhost", "root", "", "pasodo"); ?>
<?php require_once("include/sessions.php");?>
<?php
  // DB Credentials
  define('DB_SERVER', 'localhost');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', '');
  define('DB_NAME', 'pasodo');

  // Attempt to connect to MySQL with PDO
  try {
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
  } catch(PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
  }
  ?>

<?php 
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $clientID = $_POST["clientID"];
        if (empty($clientID)) {
            $_SESSION["ErrorMessage"] = "Empty input";
            header('Location: index.php');
            exit;
        }else{
            //Check existence of ID in the database PDO used
            $clientID = $_POST['clientID'];
            $sql = "SELECT clientID FROM client2 WHERE clientID = '$clientID' ";

            //Prepare statement
            if($stmt = $pdo->prepare($sql)){
                //Attempt to execute statement
                if($stmt->execute())
                    //check if ID exists
                    if($stmt->rowCount() === 1){
                        if($datarows = $stmt->fetch()){
                            $clientID = $datarows["clientID"];
                            //Start session for the specific ID
                            session_start();
                            $_SESSION["clientID"] = $clientID;
                            header("Location: loan.php");
                        }

                    }else{
                        $_SESSION['ErrorMessage'] = "CLient not found";
                        header("Location: index.php");
                        exit;
                    }
                       
                }else{
                    //close statement
                    unset($stmt);
                }
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
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                   <!--<h3 style="color:white">Super Admin!!!</h3>-->
                    <ul id="side_menu" class="nav nav-pills nav-stacked">
                        <li class="active"><a href="">client Info</a></li>
                        <li><a href="">Make Transaction</a></li>
                        <!-- <li><a href="">Manage administrators</a></li>-->
                    </ul>
                </div>
                <div class="col-sm-10" style="width: 50%">
                    <h1 style="color: #000000">View Client information</h1>
                    <?php
                        echo message();
                        echo SuccessMessage();
                    ?>
                    <!--Input CLient ID to view their Payment details-->
                    <form style="form-control" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validateForm()">
                        <div class="form-group">
                            <input type="Number" name="clientID" id="clientID" placeholder="Enter client ID" >                        
                            <input class="btn btn-info btn-large" name="submit" type="submit" value="view client info" >
                        </div>               
                    </form>                 
                </div>
            </div><!-- Ending of row-->
            <script>
                function validateForm(){
                    var clientID = document.getElementById('clientID').value;
                    if(clientID.length > 0){
                        return confirm("proceed");
                        return true;
                    }else{
                        alert("EMPTY Input");
                        return false;
                    }
                }
                

            </script>
        </div><!-- ending of container-->
        <div id="footer" style="position: fixed; bottom: 0; width: 1360px;">
            <hr><p>Brain Behind | Oscar Hazard | &copy;2018  --- All rights reserved</p>
            <a style="color:white; text-decoration: none; cursor:pointer; fontweight:bold;" href="http://pasodo.com">Pasodo</a>
            <p>This site is only for use by PASODO finance group. All rights reseved. No one is allowed to make a copy of this site.</p>
        </div>
        <div style="height: 10px; background: #27AAE1;"></div>
    </body>

</html>