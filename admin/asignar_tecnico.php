<?php
include("../sesion/conexion.php");

if (!isset($_GET['id'])) {
    die("No se recibió el ID del ticket.");
}

$id_ticket = $_GET['id'];

// Buscar el ticket
$sqlTicket = "SELECT * FROM tickets WHERE id_tickets='$id_ticket'";
$resultadoTicket = mysqli_query($conexion, $sqlTicket);

if(mysqli_num_rows($resultadoTicket)==0){
    die("El ticket no existe.");
}

$ticket = mysqli_fetch_assoc($resultadoTicket);

// Obtener técnicos activos
$sqlTecnicos = "SELECT * FROM tecnicos
                WHERE estado='Activo'
                ORDER BY nombre ASC";

$resultadoTecnicos = mysqli_query($conexion, $sqlTecnicos);
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Asignar Técnico</title>

<link rel="stylesheet" href="asignar_tecnico.css">

</head>

<body>

<div class="contenedor">

<div class="card">

<h2>Asignar Técnico</h2>

<form action="guardar_asignacion.php" method="POST">

<input type="hidden"
name="id_ticket"
value="<?php echo $ticket['id_tickets']; ?>">

<label>Cliente</label>

<input
type="text"
value="<?php echo $ticket['cliente']; ?>"
readonly>

<label>Tipo de falla</label>

<input
type="text"
value="<?php echo $ticket['tipo_falla']; ?>"
readonly>

<label>Prioridad</label>

<input
type="text"
value="<?php echo $ticket['prioridad']; ?>"
readonly>

<label>Seleccione un Técnico</label>
<label>Estado</label>

<input
type="text"
value="<?php echo $ticket['estado']; ?>"
readonly>
<select name="tecnico" required>

<option value="">Seleccione...</option>

<?php while($tecnico=mysqli_fetch_assoc($resultadoTecnicos)){ ?>

<option value="<?php echo $tecnico['nombre']; ?>">

<?php echo $tecnico['nombre']; ?>

</option>

<?php } ?>

</select>

<br><br>

<button type="submit">

Asignar Técnico

</button>
<br><br>

<a href="tickets.php">
    <button type="button" class="volver">
        Volver
    </button>
</a>

</form>

</div>

</div>

</body>

</html>