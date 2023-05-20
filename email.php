<html>
<head>
  <meta http-equiv="content-type" content="text/html"; charset="utf-8"/>
    <title>Welcome</title>
    <link href="email.css" rel="stylesheet" type="text/css"/>
<body>
<?php

$emaili=$_POST["email"];
$subject="Newsletter from TradeSpot";
$body="
<div style='background-color: #f2f2f2; padding: 20px;'>
  <h2 style='text-align: center;'>Welcome to our Newsletter</h2>
  <p>Dear ".$_POST["name"]. "</p>
  <p>Thank you for subscribing to our newsletter! You will now receive the latest news and updates from us straight to your inbox.</p>
  <p>If you have any questions or feedback, please don't hesitate to contact us. We value your opinion and would love to hear from you.</p>
  <p>Best regards,</p>
  <p>The TradeSpot Team</p>
</div>
";
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';
$headers[] = "From: Trade Spot";


if(mail($emaili,$subject,$body,implode("\r\n", $headers))){

    echo "<h3>Thank you! Now you will receive an email.<br>You are welcome again!</h3>
    <br /><a href='javascript:history.go(-1)' style='margin-left:750px;color:red;font-weight:bold;'>Go Back</a>";
}

else{
    echo "Email was not sent!";
    //echo "Error: " . error_get_last()['message'];

}

?>
</body>
</html>