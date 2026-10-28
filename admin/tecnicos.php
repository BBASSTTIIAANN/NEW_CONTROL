<?php
session_start();

include("../sesion/conexion.php");

if(!isset($_SESSION["nombres"])){
    header("Location: ../index.php");
    exit();
}

$buscar = "";

if(isset($_GET['buscar'])){
    $buscar = $_GET['buscar'];

    $sql = "SELECT * FROM usuarios
            WHERE rol='tecnico'
            AND (nombre LIKE '%$buscar%' OR usuario LIKE '%$buscar%')
            ORDER BY nombre ASC";
}else{

    $sql = "SELECT * FROM usuarios
            WHERE id_perfiles='2'
            ORDER BY nombres ASC";
}

$resultado = mysqli_query($conexion,$sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Técnicos</title>

<link rel="stylesheet" href="administrador.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<div class="contenedor">

<aside class="menu">

<div class="logo">

<h2><img src="../logo.png" style="width:120px; height:auto;">

<p>Administrador</p>

</div>

<ul>

<li><a href="administrador.php"><i class="fa-solid fa-house"></i> Dashboard</a></li>

<li><a href="tecnicos.php" class="activo"><i class="fa-solid fa-user-gear"></i> Técnicos</a></li>

<li><a href="reportes.php"><i class="fa-solid fa-chart-line"></i> Reportes</a></li>

<li><a href="../sesion/cerrar_sesion.php"><i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión</a></li>

</ul>

</aside>

<main>

<header>

<h1>Técnicos Registrados</h1>

</header>

<section class="tabla">

<form method="GET">

<input
type="text"
name="buscar"
placeholder="Buscar técnico..."
value="<?php echo $buscar;?>">

<button type="submit">

<i class="fa-solid fa-magnifying-glass"></i>

Buscar

</button>

</form>

<br>

<table>

<thead>

<tr>

<th>ID</th>

<th>Nombre</th>

<th>Usuario</th>

<th>Acción</th>

</tr>

</thead>

<tbody>

<?php

while($fila=mysqli_fetch_assoc($resultado)){

?>

<tr>

<td><?php echo $fila['id_usuarios']; ?></td>

<td><?php echo $fila['nombres']; ?></td>

<td><?php echo $fila['identificacion']; ?></td>

<td>

<a href="ver_tecnico.php?id=<?php echo $fila['3']; ?>">

<button class="ver">

<i class="fa-solid fa-eye"></i>

Ver

</button>

</a>

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</section>

</main>

</div>

</body>

</html>