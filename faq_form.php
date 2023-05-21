<!DOCTYPE html>
<html>

<head>
    <title>Projekti Ueb2</title>
    <link rel="stylesheet" href="css/hp.css">

    <style>

    
       
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
<?php include 'user_header.php'; ?>

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
