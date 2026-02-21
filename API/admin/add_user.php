<?php
session_start();
require '../api/db.php';

if(!isset($_SESSION['user']) || $_SESSION['user']['role']!='admin'){
    header('Location: ../index.php');
    exit;
}

$msg="";

if($_SERVER['REQUEST_METHOD']=='POST'){

$email=$_POST['email'];
$password=password_hash($_POST['password'],PASSWORD_DEFAULT);
$plan=$_POST['plan'];
$role=$_POST['role'];
$active=$_POST['active'];

$stmt=$conn->prepare("
INSERT INTO users(email,password,plan,role,active)
VALUES(?,?,?,?,?)
");

$stmt->bind_param("ssssi",$email,$password,$plan,$role,$active);
$stmt->execute();

$msg="Usuario agregado correctamente ✔";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Agregar Usuario - Jarvix</title>

<style>

body{
margin:0;
font-family:Arial, Helvetica, sans-serif;
background:#0f0f0f;
color:white;
}

/* NAVBAR */
.navbar{
background:#141414;
padding:15px 25px;
display:flex;
justify-content:space-between;
align-items:center;
}

.logo{
color:#e50914;
font-size:22px;
font-weight:bold;
}

/* CONTENEDOR FORM */
.container{
display:flex;
justify-content:center;
align-items:center;
height:85vh;
}

/* PANEL */
.panel{
width:420px;
background:#181818;
padding:30px;
border-radius:12px;
box-shadow:0 0 15px rgba(0,0,0,.6);
}

/* TITULO */
.panel h2{
margin-top:0;
text-align:center;
}

/* INPUTS */
input,select{
width:100%;
padding:12px;
margin-bottom:15px;
border-radius:6px;
border:none;
background:#222;
color:white;
}

/* BOTON */
button{
background:#e50914;
border:none;
padding:12px;
color:white;
border-radius:6px;
cursor:pointer;
width:100%;
font-size:15px;
transition:.3s;
}

button:hover{
background:#ff1e28;
}

/* MENSAJE */
.msg{
background:#00ff9030;
padding:10px;
border-radius:6px;
text-align:center;
margin-bottom:15px;
}

/* VOLVER */
.back{
display:block;
margin-top:15px;
text-align:center;
color:#e50914;
text-decoration:none;
}

</style>

</head>
<body>

<div class="navbar">
<div class="logo">Jarvix Admin</div>
</div>

<div class="container">

<div class="panel">

<h2>Agregar Usuario</h2>

<?php if($msg) echo "<div class='msg'>$msg</div>"; ?>

<form method="POST">

<label>Email:</label>
<input type="email" name="email" required>

<label>Password:</label>
<input type="password" name="password" required>

<label>Plan:</label>
<select name="plan">
<option>Gratis</option>
<option>Basico</option>
<option>Premium</option>
</select>

<label>Rol:</label>
<select name="role">
<option value="user">User</option>
<option value="admin">Admin</option>
</select>

<label>Activo:</label>
<select name="active">
<option value="1">Activo</option>
<option value="0">Inactivo</option>
</select>

<button>Guardar Usuario</button>

</form>

<a class="back" href="dashboard.php">← Volver</a>

</div>

</div>

</body>
</html>
