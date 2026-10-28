<?php

include("../sesion/conexion.php");

/*=========================
TOTAL TICKETS
=========================*/

$totaltickets=mysqli_fetch_assoc(
mysqli_query($conexion,"SELECT COUNT(*) AS total FROM tickets"));

/*=========================
PENDIENTES
=========================*/

$pendientes=mysqli_fetch_assoc(
mysqli_query($conexion,"SELECT COUNT(*) AS total FROM tickets WHERE id_estados='4'"));

/*=========================
EN PROCESO
=========================*/

$proceso=mysqli_fetch_assoc(
mysqli_query($conexion,"SELECT COUNT(*) AS total FROM tickets WHERE id_estados='5'"));

/*=========================
FINALIZADOS
=========================*/

$finalizados=mysqli_fetch_assoc(
mysqli_query($conexion,"SELECT COUNT(*) AS total FROM tickets WHERE id_estados='6'"));

/*=========================
TECNICOS
=========================*/

$tecnicos=mysqli_fetch_assoc(
mysqli_query($conexion,"SELECT COUNT(*) AS total FROM usuarios WHERE id_estados='1'"));

/*=========================
CLIENTES
=========================*/

$clientes=mysqli_fetch_assoc(
mysqli_query($conexion,"SELECT COUNT(*) AS total FROM usuarios"));

?>

<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Reportes</title>

<link rel="stylesheet" href="reprotes.css">

</head>

<body>

<div class="contenedor">

<h1>Reportes del Sistema</h1>

<div class="cards">

<div class="card">
<h3>Total Tickets</h3>
<h1><?php echo $totaltickets['total']; ?></h1>
<?php

$ultimostickets = mysqli_query($conexion,
"
SELECT 
tickets.id_tickets,
tickets.id_usuarios,
tickets.id_fallas,
tickets.fecha_registro,
tickets.observaciones,
tickets.id_contratos,
tickets.obs_tecnico,
tickets.id_prioridades,
tickets.id_perfiles,
tickets.fecha_asignacion

FROM tickets
INNER JOIN usuarios 
ON tickets.id_usuarios = usuarios.id_usuarios
ORDER BY tickets.fecha_registro DESC
LIMIT 10
");

?>


<div class="card">
    <h3>Pendientes</h3>
<h1><?php echo $pendientes['total']; ?></h1>
</div>

<div class="card">
<h3>En Proceso</h3>
<h1><?php echo $proceso['total']; ?></h1>
</div>

<div class="card">
<h3>Finalizados</h3>
<h1><?php echo $finalizados['total']; ?></h1>
</div>

<div class="card">
<h3>Técnicos</h3>
<h1><?php echo $tecnicos['total']; ?></h1>
</div>

<div class="card">
<h3>Clientes</h3>
<h1><?php echo $clientes['total']; ?></h1>
</div>

</div>

</div>
<div class="tabla">

<h2>Últimos Tickets Generados</h2>

<table>

<tr>
    <th>ID</th>
    <th>Cliente</th>
    <th>Falla</th>
    <th>Estado</th>
    <th>Fecha</th>
</tr>


<?php while($fila=mysqli_fetch_assoc($ultimostickets)){ ?>

<tr>

<td>
<?php echo $fila['id_ticket']; ?>
</td>

<td>
<?php echo $fila['nombre']; ?>
</td>

<td>
<?php echo $fila['id_fallas']; ?>
</td>

<td>
<?php echo $fila['id_estados']; ?>
</td>

<td>
<?php echo $fila['fecha_registro']; ?>
</td>

</tr>

<?php
}
?>


</table>


</div>


</body>

</html>