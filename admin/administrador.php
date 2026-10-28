<?php
session_start();
include("../sesion/conexion.php");

// Total de tickets
$totalTickets = mysqli_fetch_assoc(
    mysqli_query($conexion, "SELECT COUNT(*) AS total FROM tickets")
);

// Total de técnicos
$totalTecnicos = mysqli_fetch_assoc(
    mysqli_query($conexion, "SELECT COUNT(*) AS total FROM tecnicos")
);

// Tickets pendientes
$pendientes = mysqli_fetch_assoc(
    mysqli_query($conexion, "SELECT COUNT(*) AS total FROM tickets WHERE estado='Pendiente'")
);

// Tickets en proceso
$proceso = mysqli_fetch_assoc(
    mysqli_query($conexion, "SELECT COUNT(*) AS total FROM tickets WHERE estado='En proceso'")
);

// Tickets finalizados
$finalizados = mysqli_fetch_assoc(
    mysqli_query($conexion, "SELECT COUNT(*) AS total FROM tickets WHERE estado='Finalizado'")
);

// Total de clientes
$totalClientes = mysqli_fetch_assoc(
    mysqli_query($conexion, "SELECT COUNT(*) AS total FROM clientes")
);

// Listado de tickets
$where = "";

if(isset($_GET['buscar']) && $_GET['buscar']!=""){

    $buscar=mysqli_real_escape_string($conexion,$_GET['buscar']);

    $where.=" cliente LIKE '%$buscar%' ";

}

if(isset($_GET['estado']) && $_GET['estado']!=""){

    if($where!=""){

        $where.=" AND ";

    }

    $estado=mysqli_real_escape_string($conexion,$_GET['estado']);

    $where.=" estado='$estado' ";

}

$sql="SELECT * FROM tickets";

if($where!=""){

    $sql.=" WHERE ".$where;

}

$sql.=" ORDER BY id_tickets DESC";

$tickets=mysqli_query($conexion,$sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Administrador</title>

<link rel="stylesheet" href="administrador.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<div class="contenedor">

<aside class="menu">

<div class="logo">

<h2>NEW CONTROL</h2>

<p>Administrador</p>

</div>

<ul>

<li class="activo"><i class="fa-solid fa-house"></i> Dashboard</li>

<li><a href="clientes.php"><i class="fa-solid fa-users"></i> Clientes</a></li>

<li>
<a href="tickets.php">
<i class="fa-solid fa-ticket"></i>
Tickets
</a>
</li>

<li><a href="tecnico_idex.html"><i class="fa-solid fa-user-gear"></i> Técnicos</a></li>

<li><a href="reportes.php"><i class="fa-solid fa-chart-line"></i> Reportes</a></li>

<li><a href="cerrar_sesion.php"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a></li>

</ul>

</aside>

<main>

<header>

<h1>Panel del Administrador</h1>

<div class="usuario">

<?php
if(isset($_SESSION["usuario"])){
    echo $_SESSION["usuario"];
}else{
    echo "Administrador";
}
?>

</div>

</header>

<section class="cards">

<div class="card">
    <h3>Clientes</h3>
    <h1><?php echo $totalClientes['total']; ?></h1>
</div>

<div class="card">
    <h3>Tickets</h3>
    <h1><?php echo $totalTickets['total']; ?></h1>
</div>

<div class="card">
    <h3>Técnicos</h3>
    <h1><?php echo $totalTecnicos['total']; ?></h1>
</div>

<div class="card">
    <h3>Pendientes</h3>
    <h1><?php echo $pendientes['total']; ?></h1>
<div class="card">
    <h3>En Proceso</h3>
    <h1><?php echo $proceso['total']; ?></h1>
</div>
<div class="card">
    <h3>Finalizados</h3>
    <h1><?php echo $finalizados['total']; ?></h1>
</div>

<?php

$proceso=mysqli_fetch_assoc(
mysqli_query($conexion,
"SELECT COUNT(*) AS total
FROM tickets
WHERE estado='En proceso'"));

echo $proceso['total'];

?>

</h1>
</div>

<div class="card">
<h3>Finalizados</h3>
<h1>

<?php

$finalizados=mysqli_fetch_assoc(
mysqli_query($conexion,
"SELECT COUNT(*) AS total
FROM tickets
WHERE estado='Finalizado'"));

echo $finalizados['total'];

?>

</h1>
</div>

</section>

<section class="tabla">

<div class="encabezado-tabla">

<h2>Tickets Registrados</h2>

<a href="tickets.php" class="btn-nuevo">
    <i class="fa-solid fa-plus"></i>
    Nuevo Ticket
</a>

</div>
<div class="barra-superior">

<form method="GET">

<input
type="text"
name="buscar"
placeholder="🔍 Buscar cliente">

<button>

Buscar

</button>

<select name="estado">

<option value="">Todos los estados</option>

<option>Pendiente</option>

<option>En proceso</option>

<option>Finalizado</option>

</select>

<button>

Filtrar

</button>

</form>

</div>

</div>

<table>

<thead>

<tr>

<th>ID</th>

<th>Cliente</th>

<th>Falla</th>

<th>Prioridad</th>

<th>Estado</th>

<th>Acciones</th>

<th>Fecha</th>

</tr>

</thead>

<tbody>

<?php
while($fila = mysqli_fetch_assoc($tickets)){
?>

<tr>
    <td><?php echo date("d/m/Y H:i", strtotime($fila["fecha"])); ?></td>

<td><?php echo $fila["id_tickets"]; ?></td>

<td><?php echo $fila["cliente"]; ?></td>

<td><?php echo $fila["tipo_falla"]; ?></td>

<td><?php echo $fila["prioridad"]; ?></td>

<td>

<?php

if($fila["estado"]=="Pendiente"){

    echo "<span class='pendiente'>Pendiente</span>";

}elseif($fila["estado"]=="En proceso"){

    echo "<span class='proceso'>En proceso</span>";

}else{

    echo "<span class='finalizado'>Finalizado</span>";

}

?>

</td>
<td>

<a href="detalle_ticket.php?id=<?php echo $fila['id_tickets']; ?>">
<button class="ver">Ver</button>
</a>

<a href="asignar_tecnico.php?id=<?php echo $fila['id_tickets']; ?>">
<button class="editar">Asignar</button>
</a>

<a href="eliminar_ticket.php?id=<?php echo $fila['id_tickets']; ?>" onclick="return confirm('¿Desea eliminar este ticket?')">
<button class="eliminar">Eliminar</button>
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