<!DOCTYPE html>
<html>

<head>
  <title>Projekti Ueb2</title>
  <link rel="stylesheet" href="css/hp.css">
  <style>
    .dropdown {
      position: relative;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      z-index: 1;
      top: 100%;
      left: 0;
      background-color: #333;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    }

    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }

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
    <div class="dropdown">
      <a href="#">Categories</a>
      <div class="dropdown-content">
        <a href="category.php?category=vehicles">Vehicles</a>
        <a href="category.php?category=technology">Technology</a>
        <a href="category.php?category=real estate">Real Estate</a>
        <a href="category.php?category=clothing and accessories">Clothing and Accessories</a>
        <a href="category.php?category=home and garden">Home and Garden</a>
        <a href="category.php?category=sports and outdoors">Sports and Outdoors</a>
        <a href="category.php?category=toys and games">Toys and Games</a>
        <a href="category.php?category=books and bagazines">Books and Magazines</a>
        <a href="category.php?category=art and collectible">Art and Collectible</a>
        <a href="category.php?category=pets and animals">Pets and Animals</a>
        <a href="category.php?category=business and industrial">Business and Industrial</a>
      </div>
    </div>
    <a href="about_us.php">About</a>
    <a href="faq_form.php">FAQ</a>
    <a href="contact.php">Contact</a>
    <a href="logout.php">Sign Out</a>
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
        <div id="product-price"><?php echo $row['pprice']. " €"; ?></div>
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