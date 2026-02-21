<?php
session_start();
require '../api/db.php';

if(!isset($_SESSION['user']) || $_SESSION['user']['role']!='admin'){
header('Location: ../index.php');
exit;
}

$id=$_GET['id'];

// Guardar cambios
if($_SERVER['REQUEST_METHOD']=='POST'){

$title=$_POST['title'];
$genre=$_POST['genre'];
$desc=$_POST['description'];
$link=$_POST['link'];

if(!empty($_FILES['image']['name'])){

$img=$_FILES['image']['name'];
move_uploaded_file($_FILES['image']['tmp_name'],
'../assets/uploads/'.$img);

$stmt=$conn->prepare("
UPDATE trailers
SET title=?, genre=?, description=?, youtube_link=?, image=?
WHERE id=?
");

$stmt->bind_param("sssssi",$title,$genre,$desc,$link,$img,$id);

}else{

$stmt=$conn->prepare("
UPDATE trailers
SET title=?, genre=?, description=?, youtube_link=?
WHERE id=?
");

$stmt->bind_param("ssssi",$title,$genre,$desc,$link,$id);
}

$stmt->execute();

header("Location: trailers.php");
}

// Obtener datos actuales
$res=$conn->query("SELECT * FROM trailers WHERE id=$id");
$t=$res->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Editar Trailer</title>

<style>
body{font-family:Arial;background:#f4f4f4;}
.panel{
width:700px;margin:40px auto;background:white;
padding:30px;border-radius:10px;
}
input,textarea,select{
width:100%;padding:8px;margin-bottom:10px;
border-radius:6px;border:1px solid #ccc;
}
button{
background:#e50914;color:white;
border:none;padding:10px 20px;
border-radius:6px;cursor:pointer;
}
img{width:200px;margin-bottom:10px;}
</style>

</head>
<body>

<div class="panel">

<h2>Editar Trailer</h2>

<form method="POST" enctype="multipart/form-data">

<label>Nombre:</label>
<input name="title" value="<?= $t['title'] ?>">

<label>Genero:</label>
<select name="genre">
<option <?= $t['genre']=='Accion'?'selected':'' ?>>Accion</option>
<option <?= $t['genre']=='Drama'?'selected':'' ?>>Drama</option>
<option <?= $t['genre']=='Comedia'?'selected':'' ?>>Comedia</option>
<option <?= $t['genre']=='Terror'?'selected':'' ?>>Terror</option>
<option <?= $t['genre']=='Ciencia Ficcion'?'selected':'' ?>>Ciencia Ficcion</option>
</select>

<label>Descripcion:</label>
<textarea name="description"><?= $t['description'] ?></textarea>

<label>Link Trailer:</label>
<input name="link" value="<?= $t['youtube_link'] ?>">

<label>Imagen actual:</label><br>
<img src="../assets/uploads/<?= $t['image'] ?>"><br>

<label>Cambiar imagen:</label>
<input type="file" name="image">

<br>
<button>Guardar cambios</button>

</form>

<br>
<a href="trailers.php">← Volver</a>

</div>

</body>
</html>
