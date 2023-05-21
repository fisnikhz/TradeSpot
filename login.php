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
    session_start();
    session_regenerate_id(true);

    include("sql/connection.php");

    if(isset($_SESSION['login_id'])){
      header('Location: homepage.php');
      exit;
  }
  require 'google-api/google-api-php-client-2.4.0/vendor/autoload.php';
  // Creating new google client instance
  $client = new Google_Client();
  // Enter your Client ID
  $client->setClientId('257614048411-fb4inco8n8jupn1urit9jjo3f2anbbs3.apps.googleusercontent.com');
  // Enter your Client Secrect
  $client->setClientSecret('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');
  // Enter the Redirect URL
  $client->setRedirectUri('http://localhost/UEB_II/login.php');
  // Adding those scopes which we want to get (email & profile Information)
  $client->addScope("email");
  $client->addScope("profile");
  if(isset($_GET['code'])){
      $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
      if(!isset($token["error"])){
          $client->setAccessToken($token['access_token']);
          // getting profile information
          $google_oauth = new Google_Service_Oauth2($client);
          $google_account_info = $google_oauth->userinfo->get();
      
          // Storing data into database
          $id = mysqli_real_escape_string($conn, $google_account_info->id);
          $full_name = mysqli_real_escape_string($conn, trim($google_account_info->name));
          $email = mysqli_real_escape_string($conn, $google_account_info->email);
          $profile_pic = mysqli_real_escape_string($conn, $google_account_info->picture);
          // checking user already exists or not
          $get_user = mysqli_query($conn, "SELECT `google_id` FROM `google_users` WHERE `google_id`='$id'");
          if(mysqli_num_rows($get_user) > 0){
              $_SESSION['login_id'] = $id; 
              header('Location: homepage.php');
              exit;
          }
          else{
              // if user not exists we will insert the user
              $insert = mysqli_query($conn, "INSERT INTO `google_users`(`google_id`,`name`,`email`,`profile_image`) VALUES('$id','$full_name','$email','$profile_pic')");
              if($insert){
                  $_SESSION['login_id'] = $id; 
                  header('Location: homepage.php');
                  exit;
              }
              else{
                  echo "Sign up failed!(Something went wrong).";
              }
          }
      }
      else{
          header('Location: login.php');
          exit;
      }  
  }
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
        <p style="margin-left:9.5em">or</p>
        <a href="<?php echo $client->createAuthUrl(); ?>"><input type="button" style="width: 100%;
    height: 50px;
    border: 1px solid;
    background: #333;
    border-radius: 25px;
    font-size: 18px;
    background-color: #eb584d;
    color:white;
    font-weight: 700;
    cursor: pointer;
    outline: none;" value="Login with Google" name="loginG"></>
        <div class="signup_link">
          Not a member? <a href="signup.php">Sign Up</a>
        </div>
      </form>
  </div>
</body>
</html>