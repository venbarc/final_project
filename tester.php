<?php

// email set up /////////////////////////////////////////////////
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';


//SMTP settings
$mail = new PHPMailer\PHPMailer\PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
// erovoutika mails 
$mail->Username = 'erovoutikamails@gmail.com';
// erovoutika password form gmail 
$mail->Password = 'wycnwwgkkvdhieet';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->setFrom('erovoutikamails@gmail.com', 'EIRA Verification');
// users email 
$mail->addAddress($email);
$mail->isHTML(true);
$mail->Subject = 'Verification Pin';
$mail->Body = '
<center>
    <h1> 
        Verify your Account here <br>
        Your verification pin: <br> ' . $pin . '</span> 
    </h1> 
</center>
';

// check if email sent 
if ($mail->send()) 
{
}
?>