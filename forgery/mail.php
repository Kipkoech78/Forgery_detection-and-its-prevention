<?php
require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'sangdennis07@gmail.com';          // SMTP username
$mail->Password = 'Dk6soSpl'; // SMTP password
$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                          // TCP port to connect to

$mail->setFrom('info@example.com', 'CodexWorld');
$mail->addReplyTo('info@example.com', 'CodexWorld');
$mail->addAddress('john@gmail.com');   // Add a recipient
$mail->addCC('cc@example.com');
$mail->addBCC('bcc@example.com');

$mail->isHTML(true);  // Set email format to HTML

$bodyContent = '<h1>How to Send Email using PHP in Localhost by CodexWorld</h1>';
$bodyContent .= '<p>This is the HTML email sent from localhost using PHP script by <b>CodexWorld</b></p>';

$mail->Subject = 'Email from Localhost by CodexWorld';
$mail->Body    = $bodyContent;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
?>