<?php
session_start(); // Start the session to access user data
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ueb2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user has submitted the form
if (isset($_POST['post'])) {
    // Get the user's ID from the session data
    $user_id = $_SESSION['user_id'];

    // Get the product details from the form
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $pcategory = $_POST['pcategory']; // Retrieve the selected value from the form

    // Insert the product into the database
    $sql = "INSERT INTO products (pname, pcategory, pprice, pdesc, user_id)
          VALUES ('$product_name', '$pcategory', '$price', '$description', '$user_id')";

    if ($conn->query($sql) === TRUE) {
        // Get the ID of the inserted product
        $product_id = $conn->insert_id;

        // Save the images in the images table
        $image_paths = array();
        for ($i = 1; $i <= 4; $i++) {
            if ($_FILES['image' . $i]['error'] == 0) {
                $target_dir = "images/";
                $target_file = $target_dir . basename($_FILES['image' . $i]['name']);
                move_uploaded_file($_FILES['image' . $i]['tmp_name'], $target_file);

                // Insert the image path into the images table
                $sql = "INSERT INTO images (pimage, product_id) VALUES ('$target_file', '$product_id')";
                if ($conn->query($sql) !== TRUE) {
                    echo "Error inserting image: " . $conn->error;
                }
            }
        }

        echo ' <script>
          notDisplay();
          showError("Product posted successfully!");
          //notDisplay();
          </script>';
    } else {
        echo "Error posting product: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Projekti Ueb2</title>
    <link rel="stylesheet" href="css/hp.css">
    <link rel="stylesheet" href="css/user-dashboard.css">
    <style>
        form {
            width: 80%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 2px solid #ddd;
            border-radius: 5px;
            background-color: #f5f5f5;
        }

        /* Style the form elements */
        label,
        input,
        select,
        textarea {
            display: block;
            margin-bottom: 10px;
        }

        label {
            font-weight: bold;
            font-size: 16px;
        }

        input[type="text"],
        textarea {
            width: 97%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        select {
            width: 100%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            background-color: #fff;
        }

        textarea {
            height: 150px;
        }

        input[type="button"] {
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            /* transition: background-color 0.3s ease; */
        }

        input[type="submit"] {
            display: block;
            margin: 0 auto;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            font-size: 1.2em;
            transition: background-color 0.2s ease-in-out;
        }

        input[type="button"]:hover,
        input[type="submit"]:hover {
            background-color: #fff;
            color: #333;
            border: 2px solid #333;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 28%;
            background-color: white;
            color: black;
        }

        .close {
            color: rgb(11, 11, 11);
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

</head>

<body>
    <div class="navbar">
        <h1 class="logo">TradeSpot</h1>
        <a href="homepage.php">Home</a>
        <a href="profile.php">Profile</a>
        <a href="user-dashboard.php">Dashboard</a>
        <a href="#">About</a>
        <a href="#">Services</a>
        <a href="#">Contact</a>
    </div>
    <div class="content">

        <form method="POST" enctype="multipart/form-data">
            <label>Product name:</label><br>
            <input type="text" name="product_name"><br>
            <label for="category">Choose a category:</label>
            <select name="pcategory" id="categories">
                <option value="Vehicles">Vehicles</option>
                <option value="Technology">Technology</option>
                <option value="Real Estate">Real Estate</option>
                <option value="Clothing and Accessories">Clothing and Accessories</option>
                <option value="Home and Garden">Home and Garden</option>
                <option value="Sports and Outdoors">Sports and Outdoors</option>
                <option value="Toys and Games">Toys and Games</option>
                <option value="Books and Magazines">Books and Magazines</option>
                <option value="Art and Collectible">Art and Collectible</option>
                <option value="Pets and Animals">Pets and Animals</option>
                <option value="Business and Industrial">Business and Industrial</option>

            </select>
            <label>Price:</label><br>
            <input type="text" name="price"><br>
            <label>Description:</label><br>
            <textarea name="description"></textarea><br>
            <input type="button" value="Add images" id="openModal">
            <input type="submit" name="post" value="Post">
            <div id="modal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <label>Image 1:</label>
                    <input type="file" name="image1"><br>
                    <label>Image 2:</label>
                    <input type="file" name="image2"><br>
                    <label>Image 3:</label>
                    <input type="file" name="image3"><br>
                    <label>Image 4:</label>
                    <input type="file" name="image4"><br>
                </div>
        </form>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("modal");

        // Get the button that opens the modal
        var btn = document.getElementById("openModal");


        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];


        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>

</html>