<!DOCTYPE html>
<html>

<head>
    <title>SignUp</title>
    <link rel="stylesheet" href="css/hp.css">
    <link rel="stylesheet" href="css/signin-up.css">
    <style>
        ::-webkit-scrollbar {
        width: 0;
        height: 0;
        background-color: transparent;
        }
    </style>
</head>

<body>

    <!-- <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3 id="modal_message" style="color: #f00;"></h3>
        </div>
    </div>

    <script src="openModal.js"></script> -->

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

        require_once("sql/connection.php");



        // handle sign up form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

            // check if username or email already exist
            $sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                // username or email already exist, show error message
                echo ' <script>
          notDisplay();
          showError("Username or email already exist");
          //notDisplay();
          </script>';
            } else {
                // username and email do not exist, insert new user into database
                $sql = "INSERT INTO users (name, lastname, username, phone, address, city, email, password)
                VALUES ('$name', '$lastname', '$username', '$phone', '$address', '$city', '$email', '$hashed_password')";
                if (mysqli_query($conn, $sql)) {
                    // user registration successful, redirect to login page
                    header("Location: login.php");
                    exit;
                } else {
                    // user registration failed, show error message
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        }

        // handle login form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            $sql = "SELECT * FROM users WHERE email='$email'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                if (password_verify($password, $row['password'])) {
                    // password is correct, start session and redirect to dashboard
                    session_start();
                    $_SESSION['user_id'] = $row['id'];
                    header("Location: homepage.php");
                    exit;
                } else {
                    // password is incorrect, show error message
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
          //notDisplay();
          </script>';
            }
        }

        mysqli_close($conn);
        ?>
    <div class="center" style="height: 100%;overflow:auto;">

        <h1>Sign Up</h1>

        <form method="post" action="signup.php" method="post">

        <div class="txt_field">
            <input type="text" required name="name">
            <span></span>
            <label>Name</label>
        </div>

        <div class="txt_field">
            <input type="text" required name="lastname">
            <label>Lastname</label>
        </div>

        <div class="txt_field">
            <input type="text" required name="username">
            <label>Username</label>
        </div>

        <div class="txt_field">
            <input type="text" required name="phone">
            <label>Phone number</label>
        </div>

        <div class="txt_field">
            <input type="text" required name="address">
            <label>Address</label>
        </div>

        <div>
            <label style="color: #adadad">City</label><br>
            <select id="city" name="City" style="padding: 3px;color: #adadad;width:320px">
                <option value="none">none</option>
                <option value="Decan">Deçan</option>
                <option value="Dragash">Dragash</option>
                <option value="Ferizaj">Ferizaj</option>
                <option value="Gjakova">Gjakovë</option>
                <option value="Gjilan">Gjilan</option>
                <option value="Istog">Istog</option>
                <option value="Junik">Junik</option>
                <option value="Kamenic">Kamenicë</option>
                <option value="Kline">Klinë</option>
                <option value="Fushe-Kosove">Fushë-Kosovë</option>
                <option value="Lipjan">Lipjan</option>
                <option value="Malisheva">Malishevë</option>
                <option value="Mitrovic">Mitrovicë</option>
                <option value="Obilic">Obiliq</option>
                <option value="Peja">Pejë</option>
                <option value="Prizren">Prizren</option>
                <option value="Rahovec">Rahovec</option>
                <option value="Shtime">Shtime</option>
                <option value="Skenderaj">Skënderaj</option>
                <option value="Suhareke">Suharekë</option>
                <option value="Viti">Viti</option>
                <option value="Vushtri">Vushtri</option>
            </select>
        </div>

        <div class="txt_field">
            <input type="email" required name="email">
            <label>Email</label>
        </div>

        <div class="txt_field">
            <input type="password" required name="password">
            <label>Password</label>
        </div>

        <input type="submit" value="Sign Up" name="sign-up">
        <div class="signup_link">
            If you already have an account, <a href="login.php">Login</a>
        </div>
        </form>
    </div>
    <!-- </div> -->
</body>

</html>