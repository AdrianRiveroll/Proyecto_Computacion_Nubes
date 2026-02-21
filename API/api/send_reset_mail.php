<?php

require __DIR__.'/../PHPMailer/src/Exception.php';
require __DIR__.'/../PHPMailer/src/PHPMailer.php';
require __DIR__.'/../PHPMailer/src/SMTP.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendResetMail($email,$pass){

$mail = new PHPMailer(true);

try{

$mail->isSMTP();
$mail->Host='smtp.gmail.com';
$mail->SMTPAuth=true;
$mail->Username='jarvixapp@gmail.com'; 
$mail->Password='pxvdwhrhzpxqsffn'; 
$mail->SMTPSecure='tls';
$mail->Port=587;

$mail->setFrom('jarvixapp@gmail.com','Jarvix');
$mail->addAddress($email);

$mail->isHTML(true);
$mail->Subject='Recuperación Jarvix';

$mail->Body="
<div style='background:#111;padding:20px;color:white'>
<h2 style='color:red'>Recuperar contraseña</h2>
<p>Tu nueva contraseña es:</p>
<h1>$pass</h1>
<p>Por seguridad cámbiala después.</p>
</div>
";

$mail->send();

}catch(Exception $e){
echo $mail->ErrorInfo;
}

}
