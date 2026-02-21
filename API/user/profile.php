<?php
session_start();
require '../api/db.php';

if(!isset($_SESSION['user'])){
    header('Location: ../index.php');
    exit;
}

$user=$_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Perfil - Jarvix</title>

<style>
body{
background:#0f0f0f;
color:white;
font-family:Arial;
margin:0;
padding:30px;
}

.container{
max-width:500px;
margin:auto;
background:#181818;
padding:20px;
border-radius:12px;
}

input{
width:100%;
padding:10px;
margin:10px 0;
border:none;
border-radius:6px;
}

button{
background:#e50914;
border:none;
padding:10px 15px;
color:white;
border-radius:6px;
cursor:pointer;
}
</style>

</head>
<body>

<div class="container">

<h2>Mi Perfil</h2>

<p><b>Correo:</b> <?= $user['email'] ?></p>
<p><b>Plan:</b> <?= $user['plan'] ?></p>

<hr>

<h3>Cambiar contraseña</h3>

<form method="POST" action="../api/change_password.php">

<input type="password" name="current" placeholder="Contraseña actual" required>

<input type="password" name="new" placeholder="Nueva contraseña" required>

<button>Cambiar contraseña</button>

</form>

<br>
<a href="trailers.php" style="color:red;">← Volver</a>

</div>

</body>
</html>
