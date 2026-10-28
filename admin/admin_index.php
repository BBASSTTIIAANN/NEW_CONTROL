<?php
session_start();

include("../sesion/conexion.php");
$Clientes = mysqli_fetch_assoc(
    mysqli_query($conexion, "SELECT COUNT(*) AS total FROM clientes")
);

$tickets = mysqli_fetch_assoc(
    mysqli_query($conexion, "SELECT COUNT(*) AS total FROM tickets")
);

$tecnicos = mysqli_fetch_assoc(
    mysqli_query($conexion, "SELECT COUNT(*) AS total FROM usuarios WHERE rol='tecnico'")
);

$Pendientes = mysqli_fetch_assoc(
    mysqli_query($conexion, "SELECT COUNT(*) AS total FROM tickets WHERE estado='Pendiente'")
);
?>


<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Administrador | New Control</title>

<link rel="stylesheet" href="administrador.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<div class="contenedor">

<!-- MENU -->

<aside class="menu">
    

<div class="logo">

<h2><img src="../logo.png" style="width:120px; height:auto;">

<p>Administrador</p>

</div>

<ul>

<li class="activo">
<i class="fa-solid fa-house"></i>
Dashboard
</li>

<li>
<i class="fa-solid fa-users"></i>
Clientes
</li>

<li>
<a href="tickets.php">
<i class="fa-solid fa-ticket"></i>
Tickets
</a>
</li>

<li>
    <a href="tecnicos.php">
<i  class="fa-solid fa-user-gear"></i>
Técnicos
</a>
</li>

<li>
    <a href="reportes.php">
<i class="fa-solid fa-chart-line"></i>
Reportes
</a>
</li>



<li>
    <a href="/NEW%20CONTROL/sesion/cerrar_sesion.php">
<i class="fa-solid fa-right-from-bracket"></i>
Cerrar Sesión
</a>
</li>

</ul>

</aside>

<!-- CONTENIDO -->

<main>

<header>

<h1>Panel del Administrador</h1>

<div class="usuario">

Administrador

</div>

</header>

<!-- TARJETAS -->

<section class="cards">

<div class="card">

<h3>Clientes</h3>

<h1><?=$Clientes["total"];?></h1>

</div>

<div class="card">

<h3>Tickets</h3>

<h1><?=$tickets["total"];?></h1>

</div>

<div class="card">

<h3>Técnicos</h3>

<h1><?=$tecnicos["total"];?></h1>

</div>

<div class="card">

<h3>Pendientes</h3>

<h1><?=$Pendientes["total"];?></h1>

</div>

</section>

<!-- TABLA -->

<section class="tabla">

<h2>Tickets Generados</h2>

<table>

<thead>

<tr>

<th>ID</th>

<th>Cliente</th>

<th>Falla</th>

<th>Estado</th>

<th>Técnico</th>

<th>Acciones</th>

</tr>

</thead>

<tbody>
<?php

$sql = "SELECT * FROM tickets ORDER BY id_tickets DESC";

$resultado = mysqli_query($conexion,$sql);

while($fila=mysqli_fetch_assoc($resultado)){

?>

<tr>

<td><?= $fila["id_tickets"] ?></td>

<td><?= $fila["id_cliente"] ?></td>

<td><?= $fila["tipo_falla"] ?></td>

<td><?= $fila["estado"] ?></td>

<td><?= $fila["id"] ?></td>

<td>

<button class="ver">Ver</button>

<button class="editar">Editar</button>

<button class="eliminar">Eliminar</button>

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