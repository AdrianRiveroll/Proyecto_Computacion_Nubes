<?php
session_start();
require '../api/db.php';

if(!isset($_SESSION['user']) || $_SESSION['user']['role']!='admin'){
header('Location: ../index.php');
exit;
}

$id=$_GET['id'];

$conn->query("
UPDATE users 
SET active = IF(active=1,0,1)
WHERE id=$id
");

header("Location: users.php");
