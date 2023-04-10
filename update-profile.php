<!DOCTYPE html>
<html>

<head>
    <title>Projekti Ueb2</title>
    <link rel="stylesheet" href="css/hp.css">
    <link rel="stylesheet" href="css/update-profile.css">
  
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
            $City = mysqli_real_escape_string($conn, $_POST['City']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            // hash password for security
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // update user information in database
            $sql = "UPDATE users SET name='$name', lastname='$lastname', username='$username', phone='$phone', address='$address', City='$City', email='$email', password='$hashed_password' WHERE id=" . $_SESSION['user_id'];
            if (mysqli_query($conn, $sql)) {
                // user information updated successfully, show success message
                echo ' <script>
          notDisplay();
          showError("User information updated successfully");
          //notDisplay();
          </script>';
            } else {
                // user information update failed, show error message
                echo ' <script>
          notDisplay();
          showError("Error updating user information: " . mysqli_error($conn));
          //notDisplay();
          </script>';
              }
        }

        // get user information from database
        $sql = "SELECT * FROM users WHERE id=" . $_SESSION['user_id'];
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>

        <div class="form-box">

            <form method="post" class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div style="width:180px;">
                    <h1>Update Informations</h1>
                </div>

                <div style="width:180px;">
                    <label style="font-size: 12px;" for="name">Name:</label>
                    <input type="text" name="name" id="name" value="<?php echo $row['name']; ?>" required>
                </div>

                <div style="width:180px;">
                    <label style="font-size: 12px;" for="lastname">Lastname:</label>
                    <input type="text" name="lastname" id="lastname" value="<?php echo $row['lastname']; ?>" required>
                </div>

                <div style="width:180px;">
                    <label style="font-size: 12px;" for="username">Username:</label>
                    <input type="text" name="username" id="username" value="<?php echo $row['username']; ?>" required>

                    <div style="width:180px;">
                        <label style="font-size: 12px;" for="phone">Phone Number:</label>
                        <input type="text" name="phone" id="phone" value="<?php echo $row['phone']; ?>" required>
                    </div>

                    <div style="width:180px;">
                        <label style="font-size: 12px;" for="address">Address:</label>
                        <input type="text" name="address" id="address" value="<?php echo $row['address']; ?>" required>
                    </div>

                    <div style="width:180px;">
                        <label style="font-size: 12px;" for="City">City:</label>
                        <input type="text" name="City" id="city" value="<?php echo $row['City']; ?>" required>
                    </div>


                    <div style="width:180px;">
                        <label style="font-size: 12px;" for="email">Email:</label>
                        <input type="email" name="email" id="email" value="<?php echo $row['email']; ?>" required>

                    </div>

                    <div style="width:180px;">
                        <label style="font-size: 12px;" for="password">Password:</label>
                        <input type="password" name="password" id="password" required>
                    </div>


                    <div class="update-button">
                        <input type="submit" name="update" value="Update">
                    </div>

            </form>

        </div>
</body>

</html>