<!DOCTYPE html>
<html>

<head>
    <title>SignUp</title>
    <link rel="stylesheet" href="css/hp.css">
    <link rel="stylesheet" href="css/signup.css">
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
            width: 300px;
            height: 50px;
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
        <div class="form-box">
            <img id="form-background" src="Images\home-nike.png" alt="">

            <form class="form" action="signup.php" method="post">
                <div style="width:180px;">
                    <h1>Sign up</h1>
                </div>

                <div style="width:180px;">
                    <label style="font-size: 12px;" for="name">Name:</label><br>
                    <input type="text" id="name" name="name">
                </div>

                <div style="width:180px;">
                    <label style="font-size: 12px;" for="lastname">Lastname:</label><br>
                    <input type="text" id="lastname" name="lastname">
                </div>

                <div style="width:180px;">
                    <label style="font-size: 12px;" for="username">Username:</label><br>
                    <input type="text" id="username" name="username">
                </div>

                <div style="width:180px;">
                    <label style="font-size: 12px;" for="phone">Phone Number:</label><br>
                    <input type="text" id="phone" name="phone">
                </div>

                <div style="width:180px;">
                    <label style="font-size: 12px;" for="address">Address:</label><br>
                    <input type="text" id="address" name="address">
                </div>

                <div style="width:180px;">
                    <label style="font-size: 12px;" for="City">City:</label><br>
                    <select id="city" name="City">
                        <option value="none">none</option>
                        <option value="Decan">Decan</option>
                        <option value="Dragash">Dragash</option>
                        <option value="Ferizaj">Ferizaj</option>
                        <option value="Gjakova">Gjakova</option>
                        <option value="Gjilan">Gjilan</option>
                        <option value="Istog">Istog</option>
                        <option value="Junik">Junik</option>
                        <option value="Kamenic">Kamenic</option>
                        <option value="Kline">Kline</option>
                        <option value="Fushe-Kosove">Fushe-Kosove</option>
                        <option value="Lipjan">Lipjan</option>
                        <option value="Malisheva">Malisheva</option>
                        <option value="Mitrovic">Mitrovic</option>
                        <option value="Obilic">Obilic</option>
                        <option value="Peja">Peja</option>
                        <option value="Prizren">Prizren</option>
                        <option value="Rahovec">Rahovec</option>
                        <option value="Shtime">Shtime</option>
                        <option value="Skenderaj">Skenderaj</option>
                        <option value="Suhareke">Suhareke</option>
                        <option value="Viti">Viti</option>
                        <option value="Vushtri">Vushtri</option>

                    </select>
                </div>

                <div style="width:180px;">
                    <label style="font-size: 12px;" for="email">Email:</label><br>
                    <input type="text" id="email" name="email">
                </div>

                <div style="width:180px;">
                    <label style="font-size: 12px;" for="password">Password:</label><br>
                    <input type="password" id="password" name="password">
                </div>

                <p id="signup-link">You alredy have a account, <a href="login.php">Log in.</a></p>

                <div class="signup-button">
                    <input type="submit" value="Sign Up">
                </div>

            </form>

        </div>
    </div>
</body>

</html>