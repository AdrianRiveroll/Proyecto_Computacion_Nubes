<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Jarvix Login</title>

<style>

body{
margin:0;
font-family:Arial, Helvetica, sans-serif;
background:#0f0f0f;
color:white;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

/* CONTENEDOR LOGIN */
.login-box{
background:#181818;
padding:40px;
border-radius:12px;
width:320px;
box-shadow:0 0 25px rgba(0,0,0,.8);
text-align:center;
}

.logo{
color:#e50914;
font-size:32px;
font-weight:bold;
margin-bottom:25px;
}

/* INPUTS */
input{
width:100%;
padding:12px;
margin:10px 0;
border-radius:6px;
border:none;
background:#222;
color:white;
font-size:14px;
}

/* BOTON */
button{
width:100%;
padding:12px;
background:#e50914;
border:none;
color:white;
border-radius:6px;
font-size:16px;
cursor:pointer;
transition:.3s;
}

button:hover{
background:#ff1f1f;
}

/* LINKS */
.links{
margin-top:15px;
font-size:13px;
}

.links a{
color:#e50914;
text-decoration:none;
display:block;
margin-top:6px;
}

.links a:hover{
text-decoration:underline;
}

</style>
</head>

<body>

<div class="login-box">

<div class="logo">Jarvix</div>

<form id="loginForm">
<input type="email" id="email" placeholder="Correo" required>
<input type="password" id="password" placeholder="Contraseña" required>

<button type="submit">Iniciar sesión</button>
</form>

<div class="links">
<a href="forgot_password.php">¿Olvidaste contraseña?</a>
<a href="register.php">Crear cuenta</a>
</div>

</div>

<script>
document.getElementById('loginForm').addEventListener('submit',e=>{
 e.preventDefault();

 fetch('api/auth.php',{
 method:'POST',
 body:JSON.stringify({
 email:email.value,
 password:password.value
 })
 })
 .then(r=>r.json())
 .then(res=>{
 if(res.status==='ok'){
  if(res.role==='admin')
   window.location='admin/dashboard.php';
  else
   window.location='user/trailers.php';
 }else alert('Datos incorrectos');
 });
});
</script>

</body>
</html>
