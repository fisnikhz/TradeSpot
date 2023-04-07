<!DOCTYPE html>
<html>

<head>
  <title>Projekti Ueb2</title>
  <link rel="stylesheet" href="css/hp.css">
  <link rel="stylesheet" href="css/profile.css">


  <style>

  </style>
</head>

<body>
  <div class="navbar">
    <h1 class="logo">TradeSpot</h1>
    <a href="homepage.php">Home</a>
    <a href="profile.php">Profile</a>
    <a href="#">About</a>
    <a href="#">Services</a>
    <a href="#">Contact</a>
  </div>
  <div class="content">
    <?php
    // establish database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ueb2";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    // start session
    session_start();

    // check if user is logged in
    if (!isset($_SESSION['user_id'])) {
      // user is not logged in, redirect to login page
      header("Location: login.php");
      exit;
    }

    // handle update form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
      // sanitize input data
      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
      $username = mysqli_real_escape_string($conn, $_POST['username']);
      $phone = mysqli_real_escape_string($conn, $_POST['phone']);
      $address = mysqli_real_escape_string($conn, $_POST['address']);
      $city = mysqli_real_escape_string($conn, $_POST['City']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);

      // hash password for security
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      // update user information in database
      $sql = "UPDATE users SET name='$name', lastname='$lastname', username='$username', phone='$phone', address='$address', city='$city', email='$email', password='$hashed_password' WHERE id=" . $_SESSION['user_id'];
      if (mysqli_query($conn, $sql)) {
        // user information updated successfully, show success message
        echo "User information updated successfully";
      } else {
        // user information update failed, show error message
        echo "Error updating user information: " . mysqli_error($conn);
      }
    }

    // get user information from database
    $sql = "SELECT * FROM users WHERE id=" . $_SESSION['user_id'];
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="dashboard-container">
      <h1 class="userdashboard">User Dashboard</h1>
      <p>Welcome <?php echo $row['name'] . " " . $row['lastname']; ?></p>
      <p>Username: <?php echo $row['username']; ?></p>
      <p>Phone Number: <?php echo $row['phone']; ?></p>
      <p>Address: <?php echo $row['address']; ?></p>
      <p>City: <?php echo $row['City']; ?></p>
      <p>Email: <?php echo $row['email']; ?></p>
      <div class="button-container">
        <a href="update-profile.php">
          <button>Update Profile</button>
        </a>
        <p>Need to change your information? Click the button above to update your profile.</p>
      </div>
    </div>

  </div>
</body>

</html>