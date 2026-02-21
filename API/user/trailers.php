<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location: ../index.php');
    exit;
}

$user=$_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Jarvix Trailers</title>

<style>

body{
background:#0f0f0f;
color:white;
font-family:Arial;
margin:0;
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
font-size:22px;
font-weight:bold;
color:#e50914;
}

/* USER MENU */
.user-menu{
position:relative;
cursor:pointer;
}

.dropdown{
display:none;
position:absolute;
right:0;
top:40px;
background:#1c1c1c;
padding:15px;
border-radius:8px;
width:240px;
box-shadow:0 0 10px rgba(0,0,0,.6);
z-index:100;
}

.dropdown p{
margin:6px 0;
font-size:14px;
}

.dropdown a{
display:block;
margin-top:10px;
color:#e50914;
text-decoration:none;
}

/* GRID TRAILERS */
#trailers{
padding:20px;
display:flex;
flex-wrap:wrap;
}

/* CARD */
.card{
width:220px;
margin:15px;
cursor:pointer;
transition:.3s;
}

.card img{
width:100%;
height:300px;
object-fit:cover;
border-radius:10px;
}

.card:hover{
transform:scale(1.06);
}

.card h4{
margin-top:8px;
}

/* MODAL */
.modal{
display:none;
position:fixed;
top:0;
left:0;
width:100%;
height:100%;
background:rgba(0,0,0,.85);
justify-content:center;
align-items:center;
z-index:999;
}

.modal-content{
background:#181818;
padding:20px;
border-radius:12px;
width:600px;
max-height:90vh;
overflow:auto;
}

.modal img{
width:100%;
height:350px;
object-fit:cover;
border-radius:10px;
}

button{
background:#e50914;
border:none;
color:white;
padding:10px 15px;
margin-top:10px;
cursor:pointer;
border-radius:6px;
font-size:14px;
}

</style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">

<div class="logo">Jarvix</div>

<div class="user-menu" onclick="toggleMenu()">
👤 <?= $user['email'] ?>

<div class="dropdown" id="menu">

<p><b>Correo:</b> <?= $user['email'] ?></p>
<p><b>Plan:</b> <?= $user['plan'] ?></p>

<hr>

<a href="profile.php">Mi perfil</a>
<a href="../logout.php">Cerrar sesión</a>

</div>
</div>

</div>

<h2 style="padding:20px;">Bienvenido a Jarvix</h2>

<div id="trailers"></div>

<!-- MODAL -->
<div class="modal" id="modal">
<div class="modal-content" id="modalContent"></div>
</div>

<script>

/* MENU */
function toggleMenu(){
let m=document.getElementById("menu");
m.style.display=(m.style.display==="block")?"none":"block";
}

/* CERRAR MENU SI CLICK FUERA */
document.addEventListener('click',e=>{
if(!e.target.closest('.user-menu')){
document.getElementById('menu').style.display='none';
}
});

/* CARGAR TRAILERS */
fetch('../api/trailers.php')
.then(r=>r.json())
.then(data=>{

let html='';

data.forEach(t=>{

html+=`
<div class="card"
onclick="openModal(
'${t.title}',
'${t.genre}',
'${t.description}',
'${t.youtube_link}',
'${t.image}'
)">

<img src="../assets/uploads/${t.image}">
<h4>${t.title}</h4>

</div>`;
});

document.getElementById('trailers').innerHTML=html;

});

/* MODAL */
function openModal(title,genre,desc,link,img){

document.getElementById('modal').style.display='flex';

document.getElementById('modalContent').innerHTML=`
<img src="../assets/uploads/${img}">

<h2>${title}</h2>
<p><b>Genero:</b> ${genre}</p>
<p>${desc}</p>

<button onclick="window.open('${link}')">
▶ Ver Trailer
</button>

<br><br>
<button onclick="closeModal()">Cerrar</button>
`;
}

function closeModal(){
document.getElementById('modal').style.display='none';
}

</script>

</body>
</html>
