<!DOCTYPE html>
<html>

<head>
    <title>Projekti Ueb2</title>
    <link rel="stylesheet" href="css/hp.css">

    <style>
        .product-details {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            margin: 20px;
        }

        .product-details h1 {
            font-size: 28px;
            margin-top: 0;
            margin-bottom: 10px;
        }

        .product-details p {
            font-size: 16px;
            margin-top: 0;
            margin-bottom: 20px;
        }

        .product-details .price {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .product-details .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .product-details .button:hover {
            background-color: #0062cc;
        }

        /* Product Gallery */

        .product-gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .thumbnail-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            align-items: center;
            margin-right: 20px;
        }

        .thumbnail-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin-right: 10px;
            cursor: pointer;
            border: 2px solid #ddd;
            border-radius: 4px;
            transition: border-color 0.3s ease;
        }

        .thumbnail-image:hover {
            border-color: #007bff;
        }

        .thumbnail-image.active {
            border-color: #007bff;
        }

        .main-image-container {
            position: relative;
            width: 800px;
            height: 500px;
            overflow: hidden;
            border: 2px solid #ddd;
            border-radius: 4px;
        }

        .main-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.3s ease;
        }



        .main-image.loaded {
            opacity: 1;
        }

        /* Loading Spinner */

        .loading-spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50px;
            height: 50px;
            border: 5px solid #ddd;
            border-top-color: #007bff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        /* Style for product name */
        #product-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* Style for product description */
        #product-description {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 10px;
        }

        /* Style for product price */
        #product-price {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* Style for add to cart button */
        #add-to-cart-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            font-size: 16px;
            text-decoration: none;
            border-radius: 5px;
        }

        /* Hover effect for add to cart button */
        #add-to-cart-button:hover {
            background-color: #fff;
            color: #333;
            border: 2px solid #333;
        }

        .prod-details {
            margin-left: 40%;
        }

        #prodname {
            text-align: center;
        }

        /* Center the content */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Style the form inputs */
        input[type=text],
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 16px;
            font-size: 16px;
        }

        /* Style the label */
        label {
            font-weight: bold;
        }

        /* Style the image container */
        .img-container {
            display: flex;
            flex-wrap: wrap;
        }

        /* Style the image */
        .img-container img {
            margin-right: 10px;
            margin-bottom: 10px;
        }

        /* Style the delete checkbox */
        .img-container input[type=checkbox] {
            margin-right: 10px;
        }

        /* Style the submit button */
        input[type=submit] {
            background-color: #333;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        /* On hover */
        input[type=submit]:hover {
            background-color: #fff;
            color: black;
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
        <a href="contact.php">Contact</a>
        <a href = "logout.php">Sign Out</a>
    </div>
    <div class="content">
        <?php
        require_once("sql/connection.php");

        // Get the product ID from the URL parameter
        if (isset($_GET['id'])) {
            $productID = $_GET['id'];
        } else {
            echo "Product ID not specified.";
            exit;
        }

        // Retrieve the product from the database
        $product_id = $_GET['id'];
        $query = "SELECT * FROM products WHERE id = $product_id";
        $result = $conn->query($query);

        // Display the product details
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Retrieve the images of the product from the database
            $sql = "SELECT * FROM images WHERE product_id = $productID";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $images = array();
                while ($row2 = $result->fetch_assoc()) {
                    $images[] = $row2['pimage'];
                }
            }
        ?>

        <?php
        } else {
            echo "Product not found.";
        }


        ?>


        <?php
        // Include the database connection file
        require_once("sql/connection.php");

        // Get the product ID from the URL
        $id = $_GET['id'];

        // If the form is submitted
        if (isset($_POST['submit'])) {
            // Get the form data
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];

            // Delete image from the database and the website
            if (isset($_POST['delete_image'])) {
                $image_id = $_POST['delete_image'];
                // Delete image from the database
                $delete_image_query = "DELETE FROM images WHERE id = $image_id";
                $delete_image_result = mysqli_query($conn, $delete_image_query);
                // Delete image from the website
                $image_path_query = "SELECT pimage FROM images WHERE id = $image_id";
                $image_path_result = mysqli_query($conn, $image_path_query);
                $image_path_row = mysqli_fetch_assoc($image_path_result);
                $image_path_row = mysqli_fetch_assoc($image_path_result);
                if ($image_path_row) {
                    $image_path = $image_path_row['pimage'];
                    unlink($image_path);
                } else {
                    // Handle the case where no image row was found
                    echo "Image not found or already deleted.";
                }

            }

            // Update the product information in the database
            $update_query = "UPDATE products SET pname = '$name', pprice = '$price', pdesc = '$description' WHERE id = $id";
            $update_result = mysqli_query($conn, $update_query);

            // If the query is successful, redirect to the product page
            // if ($update_result) {
            //     header("Location: homepage.php");
            //     exit;
            // }
        }

        // Get the product information from the database
        $product_query = "SELECT * FROM products WHERE id = $id";
        $product_result = mysqli_query($conn, $product_query);
        $product = mysqli_fetch_assoc($product_result);

        // Get the images for the product from the database
        $images_query = "SELECT * FROM images WHERE product_id = $id";
        $images_result = mysqli_query($conn, $images_query);

        // Close the database connection
        $conn->close();
        ?>

        <!-- Display the product information and images -->
        <h1>Edit Product</h1>
        <form method="post">
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo $row['pname']; ?>" /><br><br>

            <label>Price:</label>
            <input type="text" name="price" value="<?php echo $row['pprice']; ?>" /><br><br>

            <label>Description:</label>
            <textarea name="description"><?php echo $row['pdesc']; ?></textarea><br><br>

            <label>Images:</label><br />
            <?php while ($image = mysqli_fetch_assoc($images_result)) { ?>
                <img src="<?php echo $image['pimage']; ?>" height="100"><br>
                <input type="checkbox" name="delete_image" value="<?php echo $image['id']; ?>"> Delete<br>
            <?php } ?>

            <br><br>
            <input type="submit" name="submit" value="Save Changes" />
        </form>

    </div>
</body>

</html>