<?php
session_start();
require '../api/db.php';

if(!isset($_SESSION['user']) || $_SESSION['user']['role']!='admin'){
    header('Location: ../index.php');
    exit;
}

$res=$conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
<title>Usuarios - Jarvix</title>

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

/* CONTENEDOR */
.container{
padding:30px;
}

/* TABLA */
table{
width:100%;
border-collapse:collapse;
background:#181818;
border-radius:10px;
overflow:hidden;
}

th, td{
padding:12px;
text-align:left;
}

th{
background:#222;
}

tr:nth-child(even){
background:#151515;
}

tr:hover{
background:#202020;
}

/* ACCIONES */
.actions a{
text-decoration:none;
padding:6px 10px;
border-radius:5px;
margin-right:5px;
font-size:13px;
}

.edit{
background:#3498db;
color:white;
}

.toggle{
background:#f39c12;
color:white;
}

.delete{
background:#e50914;
color:white;
}

/* BOTON VOLVER */
.back{
display:inline-block;
margin-top:20px;
background:#e50914;
padding:10px 15px;
color:white;
text-decoration:none;
border-radius:6px;
}

</style>

</head>
<body>

<div class="navbar">
<div class="logo">Jarvix Admin</div>
</div>

<div class="container">

<h2>Usuarios registrados</h2>

<table>
<tr>
<th>ID</th>
<th>Email</th>
<th>Plan</th>
<th>Activo</th>
<th>Rol</th>
<th>Acciones</th>
</tr>

<?php while($u=$res->fetch_assoc()){ ?>
<tr>

<td><?= $u['id'] ?></td>
<td><?= $u['email'] ?></td>
<td><?= $u['plan'] ?></td>
<td><?= $u['active'] ? 'Sí':'No' ?></td>
<td><?= $u['role'] ?></td>

<td class="actions">

<a class="edit" href="edit_user.php?id=<?= $u['id'] ?>">
Editar
</a>

<a class="toggle" href="toggle_user.php?id=<?= $u['id'] ?>">
<?= $u['active'] ? 'Desactivar':'Activar' ?>
</a>

<a class="delete"
href="delete_user.php?id=<?= $u['id'] ?>"
onclick="return confirm('Eliminar usuario?')">
Eliminar
</a>

</td>

</tr>
<?php } ?>

</table>

<a class="back" href="dashboard.php">← Volver</a>

</div>

</body>
</html>
