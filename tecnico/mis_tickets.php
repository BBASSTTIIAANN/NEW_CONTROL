<?php

session_start();

include("../sesion/conexion.php");

if(!isset($_SESSION["usuario"])){
    header("Location: ../sesion/index.html");
    exit();
}

$nombreTecnico = $_SESSION["nombre"];

$sql = "SELECT *
        FROM tickets
        WHERE tecnico = '$nombreTecnico'
        ORDER BY id_tickets DESC";

$resultado = mysqli_query($conexion, $sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Mis Tickets | New Control</title>

<link rel="stylesheet" href="mis_tickets.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<div class="contenedor">

<aside class="menu">

<div class="logo">

<h2>NEW CONTROL</h2>

<p>Técnico</p>

</div>

<ul>

<li>

<a href="tecnico.php">

<i class="fa-solid fa-house"></i>

Inicio

</a>

</li>

<li class="activo">

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


<main>

<header>

<h1>Mis Tickets</h1>

<div class="usuario">

<?= htmlspecialchars($nombreTecnico); ?>

</div>

</header>


<section class="tabla">

<h2>Tickets Asignados</h2>

<table>

<thead>

<tr>

<th>ID</th>

<th>Cliente</th>

<th>Dirección</th>

<th>Tipo de Falla</th>

<th>Prioridad</th>

<th>Estado</th>

<th>Fecha</th>

<th>Acción</th>

</tr>

</thead>

<tbody>

<?php

if(mysqli_num_rows($resultado) > 0){

    while($ticket = mysqli_fetch_assoc($resultado)){

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
<?= htmlspecialchars($ticket["prioridad"]); ?>
</td>

<td>
<?= htmlspecialchars($ticket["estado"]); ?>
</td>

<td>
<?= htmlspecialchars($ticket["fecha"]); ?>
</td>

<td>

<a href="detalle_ticket.php?id=<?= $ticket["id_tickets"]; ?>">

<button class="ver">

<i class="fa-solid fa-eye"></i>

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

<td colspan="8">

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


<script>

setInterval(function(){

    location.reload();

},5000);

</script>

</body>

</html>