<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>New Control - Inicio de Sesión</title>

<link rel="stylesheet" href="login.css">

</head>

<body>

<div class="login">

<h1><img src="../logo.png" style="width:120px; height:auto;">

<p>Iniciar Sesión</p>

<form action="sesion/validar.php" method="POST"></form><form action="validar.php" method="POST">

<label>Usuario</label>

<input type="text"
name="usuario"
placeholder="Ingrese su usuario"
required>

<label>Contraseña</label>

<input
type="password"
name="clave"
placeholder="Ingrese su contraseña"
required>

<?php
if(isset($_GET["error"])){
?>
<p class="error">
Usuario o contraseña incorrectos
</p>
<?php
}
?>

<button type="submit">

Ingresar

</button>

</form>

</div>

</body>

</html>