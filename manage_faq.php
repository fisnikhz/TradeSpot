<!DOCTYPE html>
<html>

<head>
  <title>Vertical Navbar</title>
  <link rel="stylesheet" href="css/dashboard.css">
  <link rel="stylesheet" href="css/view-users.css">

  <style>
    table {
      width: 800px;
      border-collapse: collapse;
      margin: auto;
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
      border: 1px solid #ddd;
    }

    table th,
    table td {
      padding: 12px 15px;
      text-align: left;
      border: 1px solid #ddd;
    }

    table th {
      background-color: #f5f5f5;
    }

    table tr:nth-child(even) td {
      background-color: #fafafa;
    }

    table tr:hover td {
      background-color: #f2f2f2;
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
      border: 1px solid black;
    }
  </style>

</head>

<body>
<?php include 'admin_header.php'; ?>

<td><a href='dashboard.php?delete=" . $row["id"] . "'></a></td>      </div>


  </div>
  <div class="content">
    <?php
    require_once("sql/connection.php");

    // Process the form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Retrieve the question and answer from the form data
      $question = $_POST['question'];
      $answer = $_POST['answer'];

      // Sanitize the question and answer to prevent SQL injection
      $question = $conn->real_escape_string($question);
      $answer = $conn->real_escape_string($answer);

      // Update the corresponding question in the database with the answer
      $sql = "UPDATE questions SET answer = '$answer' WHERE question = '$question'";

      if ($conn->query($sql) === TRUE) {
        echo 'Answer submitted successfully.';
      } else {
        echo 'Error: ' . $sql . '<br>' . $conn->error;
      }
    }

    // Fetch all the questions from the database
    $sql = "SELECT * FROM questions";
    $result = $conn->query($sql);
    ?>

    <h1>Admin Dashboard - Answer Questions</h1>

    <?php
    // Display the questions and answer form in the admin dashboard
    if ($result->num_rows > 0) {
      echo '<table>';
      echo '<tr><th>Question</th><th>Answer</th></tr>';

      while ($row = $result->fetch_assoc()) {
        $question = $row['question'];
        $answer = $row['answer'];
    ?>

        <form action="" method="POST">
          <tr>
            <td><?php echo $question; ?></td>
            <td>
              <textarea name="question" style="display: none;"><?php echo $question; ?></textarea>
              <textarea name="answer" rows="4" cols="50" required><?php echo $answer; ?></textarea>
            </td>
            <td><input type="submit" value="Submit"></td>
          </tr>
        </form>

    <?php
      }
      echo '</table>';
    } else {
      echo 'No questions found.';
    }

    // Close the database connection
    $conn->close();
    ?>

  </div>
</body>

</html>