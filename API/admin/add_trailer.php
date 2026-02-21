<?php
session_start();
require '../api/db.php';

if(!isset($_SESSION['user']) || $_SESSION['user']['role']!='admin'){
header('Location: ../index.php');
exit;
}

$msg="";

if($_SERVER['REQUEST_METHOD']=='POST'){

$title=$_POST['title'];
$desc=$_POST['description'];
$link=$_POST['link'];
$genre=$_POST['genre'];

$img=$_FILES['image']['name'];
move_uploaded_file($_FILES['image']['tmp_name'],
'../assets/uploads/'.$img);

$stmt=$conn->prepare("
INSERT INTO trailers(title,description,youtube_link,image,genre)
VALUES(?,?,?,?,?)
");

$stmt->bind_param("sssss",$title,$desc,$link,$img,$genre);
$stmt->execute();

$msg="Trailer agregado correctamente ✔";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Agregar Trailer - Jarvix</title>

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
display:flex;
justify-content:center;
align-items:center;
height:85vh;
}

/* PANEL */
.panel{
width:500px;
background:#181818;
padding:30px;
border-radius:12px;
box-shadow:0 0 15px rgba(0,0,0,.6);
}

/* TITULO */
.panel h2{
text-align:center;
margin-top:0;
}

/* INPUTS */
input, textarea, select{
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

<h2>Registrar Pelicula</h2>

<?php if($msg) echo "<div class='msg'>$msg</div>"; ?>

<form method="POST" enctype="multipart/form-data">

<label>Nombre de la Pelicula</label>
<input name="title" required>

<label>Genero</label>
<select name="genre" required>
<option>Accion</option>
<option>Drama</option>
<option>Comedia</option>
<option>Terror</option>
<option>Ciencia Ficcion</option>
<option>Romance</option>
</select>

<label>Link</label>
<input name="link" required>

<label>Imagen</label>
<input type="file" name="image" required>

<label>Descripción</label>
<textarea name="description"></textarea>

<button>Guardar Trailer</button>

</form>

<a class="back" href="dashboard.php">← Volver</a>

</div>

</div>

</body>
</html>
