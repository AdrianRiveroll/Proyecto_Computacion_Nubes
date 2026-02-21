<?php
session_start();
require '../api/db.php';

if(!isset($_SESSION['user']) || $_SESSION['user']['role']!='admin'){
header('Location: ../index.php');
exit;
}

$id=$_GET['id'];

if($_SERVER['REQUEST_METHOD']=='POST'){

$email=$_POST['email'];
$plan=$_POST['plan'];
$role=$_POST['role'];

$stmt=$conn->prepare("UPDATE users SET email=?,plan=?,role=? WHERE id=?");
$stmt->bind_param("sssi",$email,$plan,$role,$id);
$stmt->execute();

header("Location: users.php");
}

$user=$conn->query("SELECT * FROM users WHERE id=$id")->fetch_assoc();
?>

<h2>Editar Usuario</h2>

<form method="POST">
Email:<br>
<input name="email" value="<?= $user['email'] ?>"><br><br>

Plan:<br>
<select name="plan">
<option <?= $user['plan']=='Gratis'?'selected':'' ?>>Gratis</option>
<option <?= $user['plan']=='Basico'?'selected':'' ?>>Basico</option>
<option <?= $user['plan']=='Premium'?'selected':'' ?>>Premium</option>
</select><br><br>

Rol:<br>
<select name="role">
<option <?= $user['role']=='user'?'selected':'' ?>>user</option>
<option <?= $user['role']=='admin'?'selected':'' ?>>admin</option>
</select><br><br>

<button>Guardar</button>
</form>

<a href="users.php">Volver</a>
