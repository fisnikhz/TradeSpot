<?php
require_once("sql/connection.php");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the user data from the database, including names
$sql = "SELECT products.user_id, users.username
        FROM products
        INNER JOIN users ON products.user_id = users.id";
$result = $conn->query($sql);

// Initialize an array to hold the user data
$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'user_id' => $row['username'] // Use the username column from the users table
        ];
    }
}

// Echo the data as a JSON string
header('Content-Type: application/json');
echo json_encode($data);

// Close the database connection
$conn->close();
?>
