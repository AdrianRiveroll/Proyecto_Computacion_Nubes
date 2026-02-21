<?php
session_start();
require '../api/db.php';

if(!isset($_SESSION['user']) || $_SESSION['user']['role']!='admin'){
header('Location: ../index.php');
exit;
}

$res=$conn->query("SELECT * FROM trailers");
?>

<!DOCTYPE html>
<html>
<head>
<title>Trailers Admin - Jarvix</title>

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

/* PANEL */
.panel{
width:95%;
margin:40px auto;
background:#181818;
padding:25px;
border-radius:12px;
box-shadow:0 0 15px rgba(0,0,0,.6);
}

h2{
margin-top:0;
}

/* TABLA */
table{
width:100%;
border-collapse:collapse;
margin-top:20px;
}

th,td{
padding:12px;
text-align:center;
border-bottom:1px solid #333;
}

th{
background:#111;
}

/* IMAGEN */
img{
width:120px;
border-radius:6px;
}

/* BOTONES */
.btn{
padding:6px 12px;
border:none;
border-radius:6px;
color:white;
cursor:pointer;
font-size:13px;
transition:.3s;
}

.activar{
background:#28a745;
}

.inactivar{
background:#e50914;
}

.editar{
background:#f5b50a;
color:black;
}

.btn:hover{
opacity:.85;
}

/* VOLVER */
.back{
display:inline-block;
margin-top:20px;
color:#e50914;
text-decoration:none;
}

</style>

</head>
<body>

<div class="navbar">
<div class="logo">Jarvix Admin</div>
</div>

<div class="panel">

<h2>Peliculas registrados</h2>

<table>
<tr>
<th>Imagen</th>
<th>Nombre</th>
<th>Genero</th>
<th>Descripcion</th>
<th>Estado</th>
<th>Acciones</th>
</tr>

<?php while($t=$res->fetch_assoc()){ ?>
<tr>

<td>
<img src="../assets/uploads/<?= $t['image'] ?>">
</td>

<td><?= $t['title'] ?></td>
<td><?= $t['genre'] ?></td>
<td><?= $t['description'] ?></td>

<td><?= $t['active'] ? 'Activo':'Inactivo' ?></td>

<td>

<a href="toggle_trailer.php?id=<?= $t['id'] ?>">
<button class="btn <?= $t['active']?'inactivar':'activar' ?>">
<?= $t['active']?'Inactivar':'Activar' ?>
</button>
</a>

<a href="edit_trailer.php?id=<?= $t['id'] ?>">
<button class="btn editar">Modificar</button>
</a>

</td>

</tr>
<?php } ?>

</table>

<a class="back" href="dashboard.php">← Volver</a>

</div>

</body>
</html>
