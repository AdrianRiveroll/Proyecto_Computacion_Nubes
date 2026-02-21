<?php

require __DIR__.'/../PHPMailer/src/Exception.php';
require __DIR__.'/../PHPMailer/src/PHPMailer.php';
require __DIR__.'/../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendWelcomeMail($email,$nombre){

$config = require __DIR__."/config_mail.php";

$mail = new PHPMailer(true);

try {

$mail->CharSet = 'UTF-8';

$mail->isSMTP();
$mail->Host = $config['host'];
$mail->SMTPDebug = 0;
$mail->SMTPAuth = true;
$mail->Username = $config['username'];
$mail->Password = $config['password'];
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = $config['port'];



$mail->setFrom($config['username'],$config['from_name']);
$mail->addAddress($email,$nombre);

$mail->isHTML(true);
$mail->Subject = "Bienvenido a Jarvix 🎬";

$mail->Body = "
<div style='background:#111;padding:25px;color:white;font-family:Arial'>
<h2 style='color:#e50914'>Bienvenido $nombre a Jarvix</h2>
<p>Gracias por registrarte en nuestra plataforma.</p>
<p>Ya puedes disfrutar trailers exclusivos.</p>
<hr>
<p style='font-size:12px;color:gray'>
Jarvix © ".date('Y')."
</p>
</div>
";

$mail->AltBody = "Bienvenido $nombre a Jarvix";

$mail->send();

return true;

} catch (Exception $e) {

echo "Error Mail: ".$mail->ErrorInfo;
return false;

}

}
