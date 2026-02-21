<?php

session_start();
require 'db.php';

$data=json_decode(file_get_contents("php://input"));

$email=$data->email ?? '';
$password=$data->password ?? '';

$stmt=$conn->prepare("SELECT * FROM users 
WHERE email=? AND active=1");

$stmt->bind_param("s",$email);
$stmt->execute();

$res=$stmt->get_result();

if($user=$res->fetch_assoc()){

    if(password_verify($password,$user['password'])){

        $_SESSION['user']=$user;

        echo json_encode([
            "status"=>"ok",
            "role"=>$user['role']
        ]);

    } else {

        echo json_encode([
            "status"=>"error",
            "msg"=>"Password incorrecto"
        ]);
    }

} else {

    echo json_encode([
        "status"=>"error",
        "msg"=>"Usuario no existe o desactivado"
    ]);
}
