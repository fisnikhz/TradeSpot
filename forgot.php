<?php
include('SQL/dataconf.php');
if(isset($_POST["email"]) && (!empty($_POST["email"]))){
$email = $_POST["email"];
$error="";
 
date_default_timezone_set('Europe/Tirane');
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$email = filter_var($email, FILTER_VALIDATE_EMAIL);
if (!$email) {
   echo "<html>
<head>
  <meta http-equiv='content-type' content='text/html'; charset='utf-8'/>
    <title>Fail!</title>
    <link href='forgot.css' rel='stylesheet' type='text/css'/>
<body><h3 style='color:red;text-align:center;margin-top:50px;'>Please type a valid email address!<br>
If you are not registered, please don't try anymore!<br>Thank you!</h3>
 <br /><a href='javascript:history.go(-1)' style='margin-left:750px;color:red;font-weight:bold;'>Go Back</a></body>
</html>";
   }
?>
