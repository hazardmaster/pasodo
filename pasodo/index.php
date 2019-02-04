<?php
  // Include db config
  require_once("include/PDO_DBConnect.php");

  // Init vars
  $userName = $password = '';
  $userName_err = $password_err = '';

  // Process form when post submit
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // Sanitize POST
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    // Put post vars in regular vars
    $userName = trim($_POST['userName']);
    $password = trim($_POST['password']);

    // Validate email
    if(empty($userName)){
      $userName_err = 'Please enter email';
    }

    // Validate password
    if(empty($password)){
      $password_err = 'Please enter password';
    }

    // Make sure errors are empty
    if(empty($email_err) && empty($password_err)){
      // Prepare query
      $sql = 'SELECT userName, password FROM authenticatedusers WHERE userName = :userName';

      // Prepare statement
      if($stmt = $conn->prepare($sql)){
        // Bind params
        $stmt->bindParam(':userName', $userName, PDO::PARAM_STR);

        // Attempt execute
        if($stmt->execute()){
          // Check if email exists
          if($stmt->rowCount() === 1){
            if($row = $stmt->fetch()){
              $databasepassword = $row['password'];
              if($databasepassword == $password){
                // SUCCESSFUL LOGIN
                session_start();
                $_SESSION['userName'] = $userName;
                if($userName == "oscar"){
                  header('location: homepage.php');
                }elseif ($userName == "admin") {
                  header('location: backend.php');
                }else{
                  echo "Unauthorised user";
                }
                
              } else {
                // Display wrong password message
                $password_err = 'The password you entered is not valid';
              }
            }
          } else {
            $userName_err = 'User not found';
          }
        } else {
          die('Something went wrong');
        }
      }
      // Close statement
      unset($stmt);
    }

    // Close connection
    unset($conn);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

  <title>Pasodo Login Page</title>
</head>
<body style="background-color: #2f4050">
  <div class="container">
    <div class="row" style="margin-top: 200px">
      <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
          <h2><i><b>WELCOME TO PASODO</b></i></h2>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">   
            <div class="form-group">
              <label for="userName">User Name</label>
              <input type="userName" name="userName" class="form-control form-control-lg <?php echo (!empty($userName_err)) ? 'is-invalid' : ''; ?>" value="">
              <span class="invalid-feedback"><?php echo $userName_err; ?></span>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="">
              <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-row">
              <div class="col">
                <input type="submit" value="Login" class="btn btn-success btn-block">
              </div>              
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>