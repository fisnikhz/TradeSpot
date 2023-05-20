<?php
require_once("sql/connection.php");

// Fetch the product data from the database
$sql = "SELECT pcategory FROM products";
$result = $conn->query($sql);

// Initialize an array to hold the product data
$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'pcategory' => $row['pcategory']
        ];
    }
}

// Echo the data as a JSON string
header('Content-Type: application/json');
echo json_encode($data);

// Close the database connection
$conn->close();
?>
