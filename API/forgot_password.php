<?php

require 'api/db.php';
require 'api/send_reset_mail.php';

$msg="";

if($_SERVER['REQUEST_METHOD']=="POST"){

$email=$_POST['email'];

$newPass=substr(md5(rand()),0,8);
$hash=password_hash($newPass,PASSWORD_DEFAULT);

$conn->query("UPDATE users SET password='$hash' WHERE email='$email'");

sendResetMail($email,$newPass);

$msg="Contraseña enviada a tu correo";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Recuperar contraseña - Jarvix</title>

<style>

body{
margin:0;
font-family:Arial, Helvetica, sans-serif;
background:#0f0f0f;
color:white;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

/* PANEL */
.panel{
width:400px;
background:#181818;
padding:30px;
border-radius:12px;
box-shadow:0 0 20px rgba(0,0,0,.7);
}

.logo{
text-align:center;
color:#e50914;
font-size:24px;
font-weight:bold;
margin-bottom:10px;
}

h2{
text-align:center;
margin-bottom:20px;
}

/* INPUT */
input{
width:100%;
padding:12px;
margin-bottom:15px;
border:none;
border-radius:6px;
background:#222;
color:white;
font-size:14px;
}

input:focus{
outline:none;
background:#2a2a2a;
}

/* BUTTON */
button{
width:100%;
padding:12px;
border:none;
border-radius:6px;
background:#e50914;
color:white;
font-size:15px;
cursor:pointer;
transition:.3s;
}

button:hover{
background:#ff1f28;
}

.back-btn{
margin-top:10px;
background:#333;
}

.back-btn:hover{
background:#444;
}

.msg{
text-align:center;
color:#00ff90;
margin-bottom:15px;
}

</style>

</head>
<body>

<div class="panel">

<div class="logo">Jarvix</div>
<h2>Recuperar contraseña</h2>

<?php if($msg) echo "<div class='msg'>$msg</div>"; ?>

<form method="POST">
<input type="email" name="email" required placeholder="Correo electrónico">
<button>Enviar nueva contraseña</button>
</form>

<a href="index.php">
<button class="back-btn">Volver al login</button>
</a>

</div>

</body>
</html>
