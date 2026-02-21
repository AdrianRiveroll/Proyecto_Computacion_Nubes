<?php
session_start();
require '../api/db.php';

if(!isset($_SESSION['user']) || $_SESSION['user']['role']!='admin'){
header('Location: ../index.php');
exit;
}

$id=$_GET['id'];

$conn->query("DELETE FROM users WHERE id=$id");

header("Location: users.php");
