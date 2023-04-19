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

  <div class="navbar">
    <h1 class="logo">TradeSpot</h1>
    <a href="homepage.php">Home</a>
    <a href="profile.php">Profile</a>
    <a href="#">About</a>
    <a href="#">Services</a>
    <a href="#">Contact</a>
  </div>
  <div class="content">
     <div class="form-box">
      <div class="form">
        <form class="login-form" action="login.php" method="post">
          <h1 id="login-txt">Login</h1>

          <label id="u_or_e" for="username_or_email">Username</label>
          <input type="text" id="usernamebox" name="username_or_email">
          <label id="password" for="password">Password</label>
          <input type="password" id="passwordbox" name="password">
          <p id="signup-link">Dont have a account, <a href="signup.php">sign up.</a></p>
          <input type="submit" name="login" value="Login">
          <p id="signup-link">Forgot your password? <a href="forgot.php">Reset it now!</a></p>
        </form>
      </div>
    </div>
    </h1>
  </div>
</body>

</html>