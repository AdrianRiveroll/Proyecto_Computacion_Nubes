<?php

require 'api/db.php';
require 'api/send_welcome_mail.php';

if($_SERVER['REQUEST_METHOD']=='POST'){

$nombre=$_POST['nombre'];
$edad=$_POST['edad'];
$email=$_POST['email'];
$plan=$_POST['plan'];
$password=password_hash($_POST['password'], PASSWORD_DEFAULT);

if($edad < 18){
echo "<script>alert('Debes ser mayor de edad');</script>";
exit;
}

$stmt=$conn->prepare("INSERT INTO users(email,password,plan)
VALUES(?,?,?)");

$stmt->bind_param("sss",$email,$password,$plan);
$stmt->execute();

sendWelcomeMail($email,$nombre);

header("Location: index.php");
exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Registro Jarvix</title>

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

/* CARD */
.panel{
width:400px;
background:#181818;
padding:30px;
border-radius:12px;
box-shadow:0 0 20px rgba(0,0,0,.7);
}

h2{
text-align:center;
margin-bottom:20px;
}

/* INPUTS */
input,select{
width:100%;
padding:10px;
margin-bottom:15px;
border:none;
border-radius:6px;
background:#222;
color:white;
font-size:14px;
}

input:focus,select:focus{
outline:none;
background:#2a2a2a;
}

/* BOTONES */
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

/* LOGIN LINK */
.login-btn{
margin-top:10px;
background:#333;
}

.login-btn:hover{
background:#444;
}

/* LOGO */
.logo{
text-align:center;
color:#e50914;
font-size:24px;
font-weight:bold;
margin-bottom:10px;
}

</style>

</head>
<body>

<div class="panel">

<div class="logo">Jarvix</div>
<h2>Crear cuenta</h2>

<form method="POST">

<input name="nombre" placeholder="Nombre completo" required>

<input type="number" name="edad" placeholder="Edad" required>

<input type="email" name="email" placeholder="Correo electrónico" required>

<input type="password" name="password" placeholder="Contraseña" required>

<select name="plan" required>
<option value="Gratis">Plan Gratis</option>
<option value="Basico">Plan Básico</option>
<option value="Premium">Plan Premium</option>
</select>

<button type="submit">Registrarse</button>

</form>

<a href="index.php">
<button class="login-btn">
Ya tengo cuenta / Iniciar sesión
</button>
</a>

</div>

</body>
</html>
