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
mysqli_query($conexion,"SELECT COUNT(*) AS total FROM tickets WHERE estado='Pendiente'"));

/*=========================
EN PROCESO
=========================*/

$proceso=mysqli_fetch_assoc(
mysqli_query($conexion,"SELECT COUNT(*) AS total FROM tickets WHERE estado='En proceso'"));

/*=========================
FINALIZADOS
=========================*/

$finalizados=mysqli_fetch_assoc(
mysqli_query($conexion,"SELECT COUNT(*) AS total FROM tickets WHERE estado='Finalizado'"));

/*=========================
TECNICOS
=========================*/

$tecnicos=mysqli_fetch_assoc(
mysqli_query($conexion,"SELECT COUNT(*) AS total FROM tecnicos WHERE estado='Activo'"));

/*=========================
CLIENTES
=========================*/

$clientes=mysqli_fetch_assoc(
mysqli_query($conexion,"SELECT COUNT(*) AS total FROM clientes"));

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
clientes.nombre,
tickets.tipo_falla,
tickets.telefono,
tickets.fecha,
tickets.descripcion,
tickets.direccion
FROM tickets
INNER JOIN clientes 
ON tickets.id_cliente = clientes.id_cliente
ORDER BY tickets.fecha DESC
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
<?php echo $fila['tipo_falla']; ?>
</td>

<td>
<?php echo $fila['estado']; ?>
</td>

<td>
<?php echo $fila['fecha_reporte']; ?>
</td>

</tr>

<?php
}
?>


</table>


</div>


</body>

</html>