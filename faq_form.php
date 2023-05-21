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
            width: 400px;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 16px;
            font-size: 16px;
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
    </div>
    <div class="content">
    <?php
require_once 'sql/connection.php';

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the question from the form data
    $question = $_POST['question'];

    // Sanitize the question to prevent SQL injection
    $question = $conn->real_escape_string($question);

    // Insert the question into the database
    $sql = "INSERT INTO questions (question) VALUES ('$question')";

    if ($conn->query($sql) === TRUE) {
        echo 'Question submitted successfully.';
    } else {
        echo 'Error: ' . $sql . '<br>' . $conn->error;
    }
}

// Fetch the answered questions from the database
$answeredQuestions = array();
$sql = "SELECT question, answer FROM questions WHERE answer IS NOT NULL";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $question = 'Question: ' . $row['question'];
        $answer = 'Answer: ' . $row['answer'];
        $answeredQuestions[] = array('question' => $question, 'answer' => $answer);
    }
}

// Close the database connection
$conn->close();
?>


    <?php
    // Display the answered questions if available
    if (!empty($answeredQuestions)) {
        echo '<h2>Recently Answered Questions:</h2>';
        foreach ($answeredQuestions as $answeredQuestion) {
            echo '<p>' . $answeredQuestion['question'] . '</p>';
            echo '<br>';
            echo '<p>' . $answeredQuestion['answer'] . '</p>';
            echo '<hr>';
        }
    }
    ?>
    <h3 style="text-align: center;">If you have a question, feel free to ask below:</h3>
    <form action="" method="POST" style="text-align: center;">
        <textarea name="question" id="question" rows="5" cols="10" required placeholder="Write the question there"></textarea>
        <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
