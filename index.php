<?php
 
/*
Runs on a local server
knowledge base
 
https://github.com/PHPMailer/PHPMailer
 
https://stackoverflow.com/questions/22927634/smtp-connect-failed-phpmailer-php
 
*/
 
require_once('PHPMailer/PHPMailerAutoload.php');
//makes use of php mailer library
 
define ('gmailUserame','yourEmail');
define ('gmailPassword','yourPassoword');
 
//uses gmail as mail server hence you need to provide your credentials
 
global $error;
 
function smtpmailer($to, $from, $from_name, $subject, $body) {
   
    $mail = new PHPMailer();  // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true;  // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
    $mail->SMTPAutoTLS = false;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
/*
  this lines of code is unnecessary if you are running on a secure server
*/
    $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
 
    /*
 
     unnecessary code on secure server ends here
 
    */
);
 
    $mail->Username = gmailUserame;  
    $mail->Password = gmailPassword;          
    $mail->SetFrom($from, $from_name);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress($to);
    if(!$mail->Send()) {
        $error = 'Mail error: '.$mail->ErrorInfo;
        return false;
    } else {
        $error = 'Message sent!';
        return true;
    }
}
 
//Call method
 smtpmailer('onyemenamndu@gmail.com','onyemenamndu@gmail.com','Ndubuisi','hello man','Whats goog');
 //use whatever mail you like
