<!DOCTYPE html>
<html>

<head>
  <title>Vertical Navbar</title>
  <link rel="stylesheet" href="css/dashboard.css">
  <link rel="stylesheet" href="css/view-users.css">
 
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
      margin: 20px 0;
      font-size: 1.2em;
      font-family: Arial, sans-serif;
    }

    table th,
    table td {
      padding: 12px 15px;
      text-align: left;
      border: 1px solid #ddd;
    }

    table th {
      background-color: #f5f5f5;
    }

    table tr:nth-child(even) td {
      background-color: #fafafa;
    }

    table tr:hover td {
      background-color: #f2f2f2;
    }

    table td a {
      color: #007bff;
      text-decoration: none;
    }

    table td a:hover {
      text-decoration: underline;
    }
  </style>

</head>

<body>
  <div class="navbar">
    <h2 style="margin-left:10px; color:white; font-size:28px;">DASHBOARD</h2>
    <a href="#">Home</a>
    <div class="dropdown">
      <a href="#">Users</a>
      <div class="dropdown-content">
        <a href="#">Add User</a>
        <a href="#">Delete User</a>
      </div>
    </div>
    <a href="#">Services</a>
    <a href="contact.php">Contact</a>
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
    // handle user form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
      $username = mysqli_real_escape_string($conn, $_POST['username']);
      $phone = mysqli_real_escape_string($conn, $_POST['phone']);
      $address = mysqli_real_escape_string($conn, $_POST['address']);
      $City = mysqli_real_escape_string($conn, $_POST['City']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);

      $sql = "INSERT INTO users (name, lastname, username, phone, address, City, email, password) 
            VALUES ('$name', '$lastname', '$username', '$phone', '$address', '$City', '$email', '$password')";
      if (mysqli_query($conn, $sql)) {
        echo "User added successfully";
      } else {
        echo "Error adding user: " . mysqli_error($conn);
      }
    }

    // handle user deletion
    if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
      $user_id = $_GET['delete'];

      $sql = "DELETE FROM users WHERE id=$user_id";
      if (mysqli_query($conn, $sql)) {
        echo "User deleted successfully";
      } else {
        echo "Error deleting user: " . mysqli_error($conn);
      }
    }
    // create an array in php
    // retrieve all users
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);

    // display users in a table
    if (mysqli_num_rows($result) > 0) {
      echo "<table>";
      echo "<tr><th>ID</th><th>Name</th><th>Lastname</th><th>Username</th><th>Phone</th><th>Address</th><th>City</th><th>Email</th><th>Password</th><th>Action</th></tr>";
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["lastname"] . "</td><td>" . $row["username"] . "</td><td>" . $row["phone"] . "</td><td>" . $row["address"] . "</td><td>" . $row["City"] . "</td><td>" . $row["email"] . "</td><td>" . $row["password"] . "</td><td><a href='dashboard.php?delete=" . $row["id"] . "'>Delete</a></td></tr>";
      }
      echo "</table>";
    } else {
      echo "No users found";
    }

    mysqli_close($conn);
    ?>
  </div>
</body>

</html>