<?php
   // establish database connection
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "ueb2";
   
   $conn = mysqli_connect($servername, $username, $password, $dbname);
    // check connection
   if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
   }
   
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
      <link href='css/signup.css' rel='stylesheet' type='text/css'/>
   <body><h3 style='color:red;text-align:center;margin-top:50px;'>Please type a valid email address!<br>
   If you are not registered, please don't try anymore!<br>Thank you!</h3>
   <br /><a href='javascript:history.go(-1)' style='margin-left:750px;color:red;font-weight:bold;'>Go Back</a></body>
   </html>";
     }else{
     $sel_query = "SELECT * FROM users WHERE email='".$email."'";
     $results = mysqli_query($conn,$sel_query);
     $row = mysqli_num_rows($results);
     if ($row==""){
   echo "<html>
   <head>
    <meta http-equiv='content-type' content='text/html'; charset='utf-8'/>
      <title>Fail!</title>
      <link href='css/signup.css' rel='stylesheet' type='text/css'/>
   <body><h3 style='color:red;text-align:center;margin-top:50px;'>You aren't registered with this email address! <br>Please enter the email you are registered!<br>
   If you are not registered, please don't try anymore!<br>Thank you!</h3>
   <br /><a href='javascript:history.go(-1)' style='margin-left:750px;color:red;font-weight:bold;'>Go Back</a></body>
   </html>";
     }
    else{
     $expFormat = mktime(
     date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
     );
     $expDate = date("Y-m-d H:i:s",$expFormat);
     $key = md5($email);
     $addKey = substr(md5(uniqid(rand(),1)),3,10);
     $key = $key . $addKey;
   // Insert Temp Table
   mysqli_query($conn,
   "INSERT INTO temp_reseto (`email`, `key`, `expDate`)
   VALUES ('".$email."', '".$key."', '".$expDate."');");
   
   $output='<p>Dear user,</p>';
   $output.='<p>Please click on the following link to reset your password.</p>';
   $output.='<p>-------------------------------------------------------------</p>';
   $output.='<p><a href="reset.php?
   key='.$key.'&email='.$email.'&action=reset" target="_blank">
   reset.php
   ?key='.$key.'&email='.$email.'&action=reset</a></p>'; 
   $output.='<p>-------------------------------------------------------------</p>';
   $output.='<p>Please be sure to copy the entire link into your browser.
   The link will expire after 1 day for security reason.</p>';
   $output.='<p>If you did not request this forgotten password email, no action 
   is needed, your password will not be reset. However, you may want to log into 
   your account and change your security password as someone may have guessed it.</p>';   
   $output.='<p>Thanks,</p>';
   $output.='<p>TradeSpot Team</p>';
   $body = $output; 
   $subject = "Password Recovery";
   
   $to_mail = $email;
   $headers[] = 'MIME-Version: 1.0';
   $headers[] = 'Content-type: text/html; charset=iso-8859-1';
   
   $headers[] = "From: TradeSpot";
   
   if(mail($to_mail,$subject,$body,implode("\r\n", $headers))){
   
   echo "<html>
   <head>
    <meta http-equiv='content-type' content='text/html'; charset='utf-8'/>
      <title>Success!</title>
      <link href='css/signup.css' rel='stylesheet' type='text/css'/>
   <body><h3 style='color:red;text-align:center;'>You will receive a link to reset your password!</h3></body>
   </html>";
   }
   else{
   echo "Ka deshtuar emaili";
   }
   }
     }
   }else{
   ?>
<html manifest="cache.appache">
   <head>
      <title>Update password</title>
      <link rel="stylesheet" href="css/signup.css">
      <link rel="stylesheet" href="css/hp.css">
   </head>
   <body>
      <div class="navbar">
         <h1 class="logo">TradeSpot</h1>
         <a href="homepage.php">Home</a>
         <a href="profile.php">Profile</a>
         <a href="#">About</a>
         <a href="#">Services</a>
         <a href="#">Contact</a>
      </div>
      <div class="content">
         <div class="form-box">
            <form method="post" action="" name="reset" id="registration">
               <br /><br />
               <label style="color:black;font-size:20px;"><strong>Enter Your Email Address:</strong></label><br /><br />
               <input type="email" name="email" placeholder="  username@email.com" style="width:200px; height:30px; border-radius: 18px" />
               <br /><br />
               <div class="signup-button">
                  <input type="submit" value="Reset Password"/>
               </div>
            </form>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
         </div>
      </div>
      <?php } ?>
