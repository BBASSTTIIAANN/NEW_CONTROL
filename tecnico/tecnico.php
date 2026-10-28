<?php

session_start();

include("../sesion/conexion.php");

/* Verificar sesión */

if (!isset($_SESSION["identificacion"]) || $_SESSION["id_perfiles"] != 2) {
    header("Location: ../sesion/login.php");
    exit();
}

/* Datos del técnico */

$nombreTecnico = $_SESSION["nombres"];


/* =========================
   TICKETS ASIGNADOS
========================= */

$sqlAsignados = "
SELECT COUNT(*) AS total
FROM tickets
WHERE id_usuarios = '$nombreTecnico'
";

$resultadoAsignados = mysqli_query($conexion, $sqlAsignados);

$asignados = mysqli_fetch_assoc($resultadoAsignados);


/* =========================
   TICKETS EN PROCESO
========================= */

$sqlProceso = "
SELECT COUNT(*) AS total
FROM tickets
WHERE id_usuarios = '$nombreTecnico'
AND id_estados = '6'
";

$resultadoProceso = mysqli_query($conexion, $sqlProceso);

$proceso = mysqli_fetch_assoc($resultadoProceso);


/* =========================
   TICKETS FINALIZADOS
========================= */

$sqlFinalizados = "
SELECT COUNT(*) AS total
FROM tickets
WHERE id_usuarios = '$nombreTecnico'
AND id_estados = '6'
";

$resultadoFinalizados = mysqli_query($conexion, $sqlFinalizados);

$finalizados = mysqli_fetch_assoc($resultadoFinalizados);


/* =========================
   TICKETS DEL TÉCNICO
========================= */

$sqlTickets = "
SELECT *
FROM tickets
WHERE id_usuarios = '$nombreTecnico'
ORDER BY id_tickets DESC
";

$resultadoTickets = mysqli_query($conexion, $sqlTickets);

?>

<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Panel del Técnico | New Control</title>

<link rel="stylesheet" href="tecnico.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>


<div class="contenedor">


<!-- =========================
     MENU
========================= -->

<aside class="menu">

<div class="logo">

<h2><img src="../logo.png" style="width:120px; height:auto;"></h2>

<p>Técnico</p>

</div>


<ul>

<li class="activo">

<a href="tecnico.php">

<i class="fa-solid fa-house"></i>

Inicio

</a>

</li>


<li>

<a href="mis_tickets.php">

<i class="fa-solid fa-ticket"></i>

Mis Tickets

</a>

</li>


<li>

<a href="../sesion/cerrar_sesion.php">

<i class="fa-solid fa-right-from-bracket"></i>

Cerrar Sesión

</a>

</li>

</ul>

</aside>



<!-- =========================
     CONTENIDO
========================= -->

<main>


<header>

<h1>Panel del Técnico</h1>

<div class="usuario">

<?= htmlspecialchars($nombreTecnico); ?>

</div>

</header>



<!-- =========================
     TARJETAS
========================= -->

<section class="cards">


<div class="card">

<h3>Tickets Asignados</h3>

<h1>

<?= $asignados["total"]; ?>

</h1>

</div>



<div class="card">

<h3>En Proceso</h3>

<h1>

<?= $proceso["total"]; ?>

</h1>

</div>



<div class="card">

<h3>Finalizados</h3>

<h1>

<?= $finalizados["total"]; ?>

</h1>

</div>


</section>



<!-- =========================
     TICKETS
========================= -->

<section class="tabla">

<h2>Mis Tickets</h2>


<table>

<thead>

<tr>

<th>ID</th>

<th>Cliente</th>

<th>Dirección</th>

<th>Tipo de Falla</th>

<th>Estado</th>

<th>Acción</th>

</tr>

</thead>


<tbody>


<?php

if(mysqli_num_rows($resultadoTickets) > 0){

    while($ticket = mysqli_fetch_assoc($resultadoTickets)){

?>


<tr>

<td>

<?= $ticket["id_tickets"]; ?>

</td>


<td>

<?= htmlspecialchars($ticket["id_cliente"]); ?>

</td>


<td>

<?= htmlspecialchars($ticket["direccion"]); ?>

</td>


<td>

<?= htmlspecialchars($ticket["tipo_falla"]); ?>

</td>


<td>

<?= htmlspecialchars($ticket["estado"]); ?>

</td>


<td>

<a href="detalle_ticket.php?id=<?= $ticket["id_tickets"]; ?>">

<button class="ver">

Ver

</button>

</a>

</td>

</tr>


<?php

    }

}else{

?>


<tr>

<td colspan="6">

No tienes tickets asignados.

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



<!-- =========================
     ACTUALIZACIÓN AUTOMÁTICA
========================= -->

<script>

setInterval(function(){

    location.reload();

}, 5000);

</script>


</body>

</html>