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
                  header('location: Homepage');
                }elseif ($userName == "admin") {
                  header('location: Admin');
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
       <canvas id="canvas" width="200" height="200"
      style="background-color:#2f4050">
      </canvas>
  <div class="container">      
    <div class="row" style="margin-top: 0px">
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

 <script>
    var canvas = document.getElementById("canvas");
    var ctx = canvas.getContext("2d");
    var radius = canvas.height / 2;
    ctx.translate(radius, radius);
    radius = radius * 0.90
    setInterval(drawClock, 1000);

    function drawClock() {
      drawFace(ctx, radius);
      drawNumbers(ctx, radius);
      drawTime(ctx, radius);
    }

    function drawFace(ctx, radius) {
      var grad;
      ctx.beginPath();
      ctx.arc(0, 0, radius, 0, 2*Math.PI);
      ctx.fillStyle = 'white';
      ctx.fill();
      grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
      grad.addColorStop(0, '#333');
      grad.addColorStop(0.5, 'white');
      grad.addColorStop(1, '#333');
      ctx.strokeStyle = grad;
      ctx.lineWidth = radius*0.1;
      ctx.stroke();
      ctx.beginPath();
      ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
      ctx.fillStyle = '#333';
      ctx.fill();
    }

    function drawNumbers(ctx, radius) {
      var ang;
      var num;
      ctx.font = radius*0.15 + "px arial";
      ctx.textBaseline="middle";
      ctx.textAlign="center";
      for(num = 1; num < 13; num++){
        ang = num * Math.PI / 6;
        ctx.rotate(ang);
        ctx.translate(0, -radius*0.85);
        ctx.rotate(-ang);
        ctx.fillText(num.toString(), 0, 0);
        ctx.rotate(ang);
        ctx.translate(0, radius*0.85);
        ctx.rotate(-ang);
      }
    }

    function drawTime(ctx, radius){
        var now = new Date();
        var hour = now.getHours();
        var minute = now.getMinutes();
        var second = now.getSeconds();
        //hour
        hour=hour%12;
        hour=(hour*Math.PI/6)+
        (minute*Math.PI/(6*60))+
        (second*Math.PI/(360*60));
        drawHand(ctx, hour, radius*0.5, radius*0.07);
        //minute
        minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
        drawHand(ctx, minute, radius*0.8, radius*0.07);
        // second
        second=(second*Math.PI/30);
        drawHand(ctx, second, radius*0.9, radius*0.02);
    }

    function drawHand(ctx, pos, length, width) {
        ctx.beginPath();
        ctx.lineWidth = width;
        ctx.lineCap = "round";
        ctx.moveTo(0,0);
        ctx.rotate(pos);
        ctx.lineTo(0, -length);
        ctx.stroke();
        ctx.rotate(-pos);
    }
</script>