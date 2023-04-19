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
  </style>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var image1 = document.getElementById("image1");
      var image2 = document.getElementById("image2");
      var image3 = document.getElementById("image3");
      var image4 = document.getElementById("image4");
      var mainImage = document.getElementById("main-image");

      image1.addEventListener("click", function() {
        mainImage.src = image1.src;
      });

      image2.addEventListener("click", function() {
        mainImage.src = image2.src;
      });

      image3.addEventListener("click", function() {
        mainImage.src = image3.src;
      });

      image4.addEventListener("click", function() {
        mainImage.src = image4.src;
      });
    });
  </script>
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
  </div>
  <div class="content">
    <?php
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
      <h1 id="prodname"><?php echo $row['pname'] ?></h1>
      <div class='product-details'>
        <div class='product-gallery'>
          <div class='thumbnail-container'>
            <img class='thumbnail-image active' id='image1' src='<?php echo $images[0]; ?>'>
            <img class='thumbnail-image' id='image2' src='<?php echo $images[1]; ?>'>
            <img class='thumbnail-image' id='image3' src='<?php echo $images[2]; ?>'>
            <img class='thumbnail-image' id='image4' src='<?php echo $images[3]; ?>'>
          </div>
          <div class='main-image-container'>
            <img class='main-image' id='main-image' src='<?php echo $images[0]; ?>'>
          </div>
        </div>
      </div>
      <div class="prod-details">
        <h1 id="product-name"><?php echo $row['pname']; ?></h1>
        <p id="product-description"><?php echo $row['pdesc']; ?></p>
        <div id="product-price"><?php echo $row['pprice']; ?></div>
        <a href='#' id="add-to-cart-button" class='button'>Add to Cart</a>

      </div>

    <?php
    } else {
      echo "Product not found.";
    }

    // Close the database connection
    $conn->close();
    ?>



  </div>
</body>

</html>