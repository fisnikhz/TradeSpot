<?php
session_start();
if (empty($_SESSION['admin_id'])) {
  header("Location: logout.php");
  exit;
}

if (isset($_SESSION['admin_id'])) {
  require_once("sql/connection.php");
  $query = "SELECT * FROM users WHERE id = {$_SESSION['admin_id']}";
  $result = $conn->query($query);

  $row = $result->fetch_assoc();
}

?>
<link rel="stylesheet" href="css/dashboard.css">

<div class="navbar">
  <h2 style="margin-left:10px; color:white; font-size:28px;">DASHBOARD</h2>
  <a href="dashboard.php">Home</a>
  <a href="view-users.php">Delete User</a>
  <a href="manage_faq.php">FAQ</a>
  <a href="logout.php">Sign Out</a>
</div>
</div>