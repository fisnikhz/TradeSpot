<!DOCTYPE html>
<html>
<head>
  <title>Projekti Ueb2</title>
  <link rel="stylesheet" href="css/hp.css">
  <link rel="stylesheet" href="css/signin-up.css">

</head>

<body>
  <div id="myModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h3 id="modal_message" style="color: #f00;"></h3>
    </div>
  </div>
  <script src="openModal.js"></script>

  <!-- <div class="navbar">
    <h1 class="logo">TradeSpot</h1>
    <a href="homepage.php">Home</a>
    <a href="profile.php">Profile</a>
    <a href="#">About</a>
    <a href="#">Services</a>
    <a href="#">Contact</a>
  </div> -->
  <!-- <div class="content"> -->
    <?php
    // establish database connection
    // $servername = "localhost";
    // $username = "root";
    // $password = "";
    // $dbname = "ueb2";

    // $conn = mysqli_connect($servername, $username, $password, $dbname);

    // // check connection
    // if (!$conn) {
    //   die("Connection failed: " . mysqli_connect_error());
    // }
    include("sql/connection.php");

    // handle login form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
      $username = mysqli_real_escape_string($conn, $_POST['username_or_email']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);

      $sql = "SELECT * FROM users WHERE username='$username' OR email='$username'";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
          // password is correct, start session and redirect to homepage or dashboard depending on user role
          session_start();
          $_SESSION['user_id'] = $row['id'];
          if(!empty($_REQUEST["remember"])) {
            setcookie ("user_name",$_REQUEST["username_or_email"],time()+ (10 * 365 * 24 * 60 * 60));
            setcookie ("user_password",$_REQUEST["password"],time()+ (10 * 365 * 24 * 60 * 60));
          }
          if ($row['email'] == 'admin@admin.com' && $password == 'admin' || ($row['username'] == 'admin')) {
            header("Location: dashboard.php");
          } else {
            header("Location: homepage.php");
          }
          exit;
        } else {
          echo ' <script>
          notDisplay();
          showError("Incorrect password");
          //notDisplay();
          </script>';
        }
      } else {
        // user does not exist, show error message
        echo ' <script>
        notDisplay();
        showError("User not found");
      //  notDisplay();
        </script>';
      }
    }
    mysqli_close($conn);
    ?> 
 
    <div class="center">
      <h1>Login</h1>
      <form method="post" action="login.php" method="post">
        <div class="txt_field">
          <input type="text" required name="username_or_email" value="<?php if(isset($_COOKIE["user_name"])) { echo $_COOKIE["user_name"]; }?>">
          <span></span>
          <label id="u_or_e" for="username_or_email">Username</label>
        </div>
        <div class="txt_field">
          <input type="password" required name="password" value="<?php if(isset($_COOKIE["user_password"])) { echo $_COOKIE["user_password"]; } ?>">
          <span></span>
          <label>Password</label>
        </div>
        <input type="checkbox" name="remember" value="1" id="remember" <?php if(isset($_COOKIE["user_name"])) { ?> checked <?php } ?> /><label style="color: #adadad;">  Remember Me</label>  <br><br>
        <div class="pass">Forgot your password? <a href="forgot.php">Reset it now!</a></div>
        <input type="submit" value="Login" name="login">
        <div class="signup_link">
          Not a member? <a href="signup.php">Sign Up</a>
        </div>
      </form>
  </div>
</body>
</html>