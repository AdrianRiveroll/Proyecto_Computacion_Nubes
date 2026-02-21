<?php
session_start();
require 'db.php';

if(!isset($_SESSION['user'])){
header('Location: ../index.php');
exit;
}

$id=$_SESSION['user']['id'];
$current=$_POST['current'];
$new=$_POST['new'];

$res=$conn->query("SELECT password FROM users WHERE id=$id");
$user=$res->fetch_assoc();

if(password_verify($current,$user['password'])){

$newHash=password_hash($new,PASSWORD_DEFAULT);

$conn->query("UPDATE users SET password='$newHash' WHERE id=$id");

echo "<script>
alert('Contraseña actualizada');
window.location='../user/profile.php';
</script>";

}else{

echo "<script>
alert('Contraseña incorrecta');
window.location='../user/profile.php';
</script>";

}
