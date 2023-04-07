
<?php
// Attempt MySQL server connection
$link = mysqli_connect("localhost", "root", "", "ueb2");

// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


if (isset($_REQUEST["term"])) {
    // Prepare a select statement
    if (!empty($_REQUEST["term"])) {
        $sql = "SELECT products.*, images.pimage
          FROM products
          LEFT JOIN (
            SELECT product_id, MIN(pimage) AS pimage FROM images GROUP BY product_id
          ) images
          ON products.id = images.product_id
          WHERE products.pname LIKE ? OR products.pdesc LIKE ?
          ORDER BY products.id DESC";
    } else {
        $sql = "SELECT p.*, i.pimage
          FROM products p
          LEFT JOIN (
            SELECT product_id, MIN(pimage) AS pimage FROM images GROUP BY product_id
          ) i
          ON p.id = i.product_id
          ORDER BY p.id DESC";
    }

    echo "<style>
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
</style>";
    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ss", $param_term, $param_term);

        // Set parameters
        $param_term = '%' . $_REQUEST["term"] . '%';

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            // Check number of rows in the result set
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product-card'>";
                    if ($row['pimage'] != null) {
                        echo "<img src='" . $row['pimage'] . "'>";
                    }
                    echo "<div class='product-content'>";
                    echo "<h4>" . $row['pname'] . "</h4>";
                    echo "<p><b>" . $row['pcategory'] . "</b></p>";
                    echo "<div class='price'>" . $row['pprice'] . "</div>";
                    echo "<a href='product-details.php?id=" . $row['id'] . "' class='button'>Buy Now</a>";
                    echo "</div>";


                    echo "</div>";
                }
            } else {
                echo "No products found.";
            }
        }
    }



    // Close statement
    mysqli_stmt_close($stmt);
}

// close connection
mysqli_close($link);

?>