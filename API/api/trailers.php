<?php

header("Content-Type: application/json");
require 'db.php';

$res=$conn->query("SELECT * FROM trailers WHERE active=1");


$data=[];

while($row=$res->fetch_assoc()){
$data[]=$row;
}

echo json_encode($data);
