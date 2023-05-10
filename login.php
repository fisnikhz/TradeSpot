<!DOCTYPE html>
<html>
<head>
  <title>Projekti Ueb2</title>
  <link rel="stylesheet" href="css/hp.css">
  <link rel="stylesheet" href="css/login.css">
  <style>
    /* The Modal (background) */
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      margin-left: 80px;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.4);
    }

    /* Modal Content/Box */
    .modal-content {
      background-color: #fefefe;
      padding: 20px;
      border: 1px solid #888;
      width: 250px;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    /* The Close Button */
    .close {
      color: #333;
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 28px;
      font-weight: bold;
      text-align: center;
      line-height: 1;
      width: 30px;
      height: 30px;
      border-radius: 50%;
      background-color: black;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .close:hover,
    .close:focus {
      color: #fff;
      text-decoration: none;
    }
  </style>
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
            setcookie ("user_name",$_REQUEST["email"],time()+ (10 * 365 * 24 * 60 * 60));
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
    ?> <div class="form-box">
      <div class="form">
        <form class="login-form" action="login.php" method="post">
          <h1 id="login-txt">Login</h1>
          <label id="u_or_e" for="username_or_email">Username</label>
          <input type="text" id="usernamebox" name="username_or_email" value="<?php if(isset($_COOKIE["user_name"])) { echo $_COOKIE["user_name"]; }?>">
          <label id="password" for="password">Password</label>
          <input type="password" id="passwordbox" name="password" value="<?php if(isset($_COOKIE["user_password"])) { echo $_COOKIE["user_password"]; } ?>">
          <input type="checkbox" name="remember" value="1" id="remember" <?php if(isset($_COOKIE["user_name"])) { ?> checked <?php } ?> />Remember Me<br>
          <p id="signup-link">Dont have a account, <a href="signup.php">sign up.</a></p>
          <input type="submit" name="login" value="Login">
          <p id="signup-link">Forgot your password? <a href="forgot.php">Reset it now!</a></p>
        </form>
      </div>
    </div>
    </h1>
  <!-- </div> -->
</body>

</html>