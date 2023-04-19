<!DOCTYPE html>
<html>

<head>
  <title>Projekti Ueb2</title>
  <link rel="stylesheet" href="css/hp.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.search-box input[type="text"]').on("keyup input", function() {
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if (inputVal.length) {
          $.get("search.php", {
            term: inputVal
          }).done(function(data) {
            // Display the returned data in browser
            resultDropdown.html(data);
            $('#no-search').css("display", "none");
          });
        } else {
          resultDropdown.empty();
          $('#no-search').css("display", "block");

        }
      });

      // Set search input value on click of result item
      $(document).on("click", ".result p", function() {
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
      });
    });
  </script>

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

    form {
      display: flex;
      align-items: center;
    }

    input[type="text"] {
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 16px;
      width: 300px;
    }

    button[type="submit"] {
      padding: 8px;
      background-color: #333;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
      margin-left: 10px;
    }

    button[type="submit"]:hover {
      background-color: #fff;
      color: #333;
      border: 1px solid #333;
    }

    .product-card .button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #333;
      color: #fff;
      font-size: 16px;
      text-decoration: none;
      border-radius: 5px;
      margin-left: 35%;
    }

    .product-card .button:hover {
      background-color: #fff;
      color: #333;
      border: 2px solid #333;
    }

    .search-box {
      width: 100%;
      position: relative;
      display: inline-block;
      font-size: 14px;
    }

    .search-box input[type="text"] {
      margin-left: 35%;
      width: 300px;
      height: 32px;
      padding: 5px 10px;
      border: 1px solid #CCCCCC;
      font-size: 14px;
      margin-bottom: 30px;
    }

    .result {
      display: inline-block;
      position: absolute;
      z-index: 999;
      top: 100%;
      left: 0;
    }
  </style>

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
    <a href="#">About</a>
    <a href="#">Services</a>
    <a href="contact.php">Contact</a>
  </div>
  <div class="content">
    <!-- Add a search form to the HTML -->
    <div class="search-box">
      <input type="text" autocomplete="off" placeholder="Search product..." />
      <div class="result">

      </div>
    </div>

    <div id="no-search">

      <?php
      // Establish a connection to the database
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "ueb2";

      $conn = mysqli_connect($servername, $username, $password, $dbname);

      // Check the connection
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }


      // Check if the category parameter is set
      if (isset($_GET['category'])) {
        // Get the category from the URL parameter
        $category = $_GET['category'];

        // Build and execute the SQL query
        $sql = "SELECT p.*, i.pimage
          FROM products p
          LEFT JOIN (
            SELECT product_id, MIN(pimage) AS pimage FROM images GROUP BY product_id
          ) i
          ON p.id = i.product_id
    WHERE pcategory = '$category' ORDER BY p.id DESC";
        $result = mysqli_query($conn, $sql);


        // Display the results
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='product-card'>";
            echo "<img src='" . $row['pimage'] . "'>";
            echo "<div class='product-content'>";
            echo "<h4>" . $row['pname'] . "</h4>";
            echo "<p><b>" . $row['pcategory'] . "</b></p>";
            echo "<div class='price'>" . $row['pprice'] . "</div>";
            echo "<a href='product-details.php?id=" . $row['id'] . "' class='button'>Buy Now</a>";
            echo "</div>";
            echo "</div>";
          }
        } else {
          echo "No results found.";
        }
      }

      // Close the connection
      mysqli_close($conn);
      ?>

    </div>

  </div>
</body>

</html>