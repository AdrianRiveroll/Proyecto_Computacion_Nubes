<?php
session_start();

if(!isset($_SESSION['user']) || $_SESSION['user']['role']!='admin'){
    header('Location: ../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Jarvix</title>

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
.admin-box{
background:#181818;
padding:40px;
border-radius:12px;
width:350px;
box-shadow:0 0 25px rgba(0,0,0,.8);
text-align:center;
}

/* LOGO */
.logo{
color:#e50914;
font-size:30px;
font-weight:bold;
margin-bottom:10px;
}

/* SUBTITULO */
.subtitle{
margin-bottom:25px;
font-size:14px;
color:#bbb;
}

/* BOTONES */
.menu a{
display:block;
background:#222;
color:white;
padding:12px;
margin:10px 0;
border-radius:6px;
text-decoration:none;
transition:.3s;
}

.menu a:hover{
background:#e50914;
}

/* LOGOUT */
.logout{
background:#e50914 !important;
}

.logout:hover{
background:#ff1f1f !important;
}

</style>
</head>

<body>

<div class="admin-box">

<div class="logo">Jarvix</div>
<div class="subtitle">Panel Administrador</div>

<div class="menu">
<a href="users.php">👥 Ver usuarios</a>
<a href="add_user.php">➕ Agregar usuario</a>
<a href="add_trailer.php">🎬 Agregar pelicula</a>
<a href="trailers.php">📺 Ver peliculas</a>
<a href="../logout.php" class="logout">🚪 Cerrar sesión</a>
</div>

</div>

</body>
</html>
