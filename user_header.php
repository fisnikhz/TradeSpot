<?php
session_start();
if (empty($_SESSION['user_id'])) {
  header("Location: logout.php");
  exit;
}

 $user_id = 0;
if (isset($_SESSION['user_id'])) {
  require_once("sql/connection.php");
  $user_id = $_SESSION['user_id'];
  // $query = "SELECT * FROM users WHERE id = {$_SESSION['user_id']}";
  // $result = $conn->query($query);

  // $row = $result->fetch_assoc();
}
?>
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
</style>
<!-- user_navbar.php -->
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