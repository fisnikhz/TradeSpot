<?php
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);
 
try {
    $mail->SMTPDebug = 2;                                      
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp.gmail.com;';                   
    $mail->SMTPAuth   = true;                            
    $mail->Username   = 'tradespotphp@gmail.com';                
    $mail->Password   = 'wduhpuppnrpjsven';                       
    $mail->SMTPSecure = 'tls';                             
    $mail->Port       = 587; 
 
    $mail->setFrom('tradespotphp@gmail.com', 'Trade Spot');          
    $mail->addAddress($_POST["Email"]);
      
    $mail->isHTML(true);                                 
    $mail->Subject = 'Newsletter from Trade Spot';
    $mail->Body    = 'HTML message body in <b>bold</b> ';
    $mail->AltBody = 'Body in plain text for non-HTML mail clients';
    $mail->send();
    echo "Mail has been sent successfully!";
} 

catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
 
?>