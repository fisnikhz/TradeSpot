<!DOCTYPE html>
<html>

<head>
  <title>Projekti Ueb2</title>
  <link rel="stylesheet" href="css/hp.css">
  <link rel="stylesheet" href="css/profile.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script>
    
    function showProducts() {
      $('#products').css("display", "block");
      $('#hmp').css("display", "block");

    }

    function hideProducts() {
      $('#products').css("display", "none");
      $('#hmp').css("display", "none");
    }
  </script>
  <style>
    .product-container {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      margin: 0 auto;
      width: 80%;
    }

    .product-card {
      background-color: #f5f5f5;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
      display: flex;
      margin: 1rem;
      padding: 1rem;
      width: 45%;
    }

    .product-image {
      height: 10rem;
      margin-right: 1rem;
      width: 10rem;
    }

    .product-details {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .product-details h4 {
      margin: 0;
    }

    .product-price {
      font-weight: bold;
      margin-top: 1rem;
    }

    .product-buttons {
      display: contents;
      /* justify-content: space-between; */
      margin-top: 1rem;
      width: 100%;
    }

    .button {
      border: none;
      color: #fff;
      cursor: pointer;
      padding: 0.75rem 1rem;
    }

    .edit-button {
      background-color: #4caf50;
    }

    .sold-button {
      background-color: #f44336;
    }
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
    $user_id = $_SESSION['user_id'];
    // check if user is logged in
    if (!isset($user_id)) {
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
      $sql = "UPDATE users SET name='$name', lastname='$lastname', username='$username', phone='$phone', address='$address', city='$city', email='$email', password='$hashed_password' WHERE id=" . $user_id;
      if (mysqli_query($conn, $sql)) {
        // user information updated successfully, show success message
        echo "User information updated successfully";
      } else {
        // user information update failed, show error message
        echo "Error updating user information: " . mysqli_error($conn);
      }
    }

    // get user information from database
    $sql = "SELECT * FROM users WHERE id=" . $user_id;
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

    <br>
    <br>
    <div class="buttons" style="margin-left: 35%;">
      <button onclick="showProducts()">Show My Products</button>
      <button onclick="hideProducts()" style="display: none;" id="hmp">Hide My Products</button>
    </div>



    <div id="products" style="display: none;">

      <?php

      $sql1 = "SELECT p.*, i.pimage
          FROM products p
          LEFT JOIN (
            SELECT product_id, MIN(pimage) AS pimage FROM images GROUP BY product_id
          ) i
          ON p.id = i.product_id
          WHERE p.user_id = '$user_id'
          ORDER BY p.id DESC";

      $result1 = mysqli_query($conn, $sql1);
      // $row1 = mysqli_fetch_assoc($result1);

      if ($result1->num_rows > 0) {
        echo "<div class='product-container'>";
        while ($row1 = mysqli_fetch_assoc($result1)) {
          echo "<div class='product-card'>";
          echo "<img src='" . $row1['pimage'] . "' class='product-image'>";
          echo "<div class='product-details'>";
          echo "<h4>" . $row1['pname'] . "</h4>";
          echo "<div class='product-price'>" . $row1['pprice'] . "</div>";
          echo "<div class='product-buttons'>";
          echo "<a href='edit-product.php?id=" . $row1['id'] . "' class='button edit-button'>Edit</a>";
          echo "<a href='?sold_id=" . $row1['id'] . "' class='button sold-button'>Mark as Sold</a>";
          echo "</div>";
          echo "</div>";
          echo "</div>";
        }
        echo "</div>";
      } else {
        echo "No products found.";
      }

      // check if Mark as Sold button is clicked
      if (isset($_GET['sold_id'])) {
        $sold_id = $_GET['sold_id'];


        // delete the product from the database
        $sql2 = "DELETE FROM products WHERE id = '$sold_id';";


        $result2 = mysqli_query($conn, $sql2);

        if ($result) {
          // Redirect to the user's profile page with a success message
          echo "Product marked as sold successfully!<br>";
          header("Location: profile.php");
          exit();
        } else {
          // Redirect to the user's profile page with an error message
          echo "Error marking product as sold.!<br>";
          header("Location: profile.php");
          exit();
        }

        // close the database connection
        mysqli_close($conn);
      }

      ?>
    </div>

  </div>
</body>

</html>