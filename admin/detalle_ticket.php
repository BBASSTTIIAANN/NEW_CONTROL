<?php
include("../sesion/conexion.php");

if(!isset($_GET['id'])){
    echo "Ticket no encontrado.";
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM tickets WHERE id_tickets='$id'";
$resultado = mysqli_query($conexion,$sql);

if(mysqli_num_rows($resultado)==0){
    echo "El ticket no existe.";
    exit();
}

$ticket = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Detalle del Ticket</title>

<link rel="stylesheet" href="detalle_ticket.css">

</head>

<body>

<div class="contenedor">

    <div class="card">

        <h1>Detalle del Ticket</h1>

        <hr>

        <div class="grupo">

            <label>ID Ticket</label>

            <input type="text" value="<?php echo $ticket['id_tickets']; ?>" readonly>

        </div>

        <div class="grupo">

            <label>Cliente</label>

            <input type="text" value="<?php echo $ticket['cliente']; ?>" readonly>

        </div>

        <div class="grupo">

            <label>Tipo de Falla</label>

            <input type="text" value="<?php echo $ticket['tipo_falla']; ?>" readonly>

        </div>

        <div class="grupo">

            <label>Prioridad</label>

            <input type="text" value="<?php echo $ticket['prioridad']; ?>" readonly>

        </div>

        <div class="grupo">

            <label>Estado</label>

            <input type="text" value="<?php echo $ticket['estado']; ?>" readonly>

        </div>

<?php if(isset($ticket['telefono'])){ ?>

        <div class="grupo">

            <label>Teléfono</label>

            <input type="text" value="<?php echo $ticket['telefono']; ?>" readonly>

        </div>

<?php } ?>

<?php if(isset($ticket['direccion'])){ ?>

        <div class="grupo">

            <label>Dirección</label>

            <input type="text" value="<?php echo $ticket['direccion']; ?>" readonly>

        </div>

<?php } ?>

<?php if(isset($ticket['descripcion'])){ ?>

        <div class="grupo">

            <label>Descripción</label>

            <textarea readonly><?php echo $ticket['descripcion']; ?></textarea>

        </div>

<?php } ?>

<?php if(isset($ticket['tecnico'])){ ?>

        <div class="grupo">

            <label>Técnico Asignado</label>

            <input type="text" value="<?php echo $ticket['tecnico']; ?>" readonly>

        </div>

<?php } ?>

<?php if(isset($ticket['fecha'])){ ?>

        <div class="grupo">

            <label>Fecha</label>

            <input type="text" value="<?php echo $ticket['fecha']; ?>" readonly>

        </div>

<?php } ?>

        <div class="botones">

            <a href="asignar_tecnico.php?id=<?php echo $ticket['id_tickets']; ?>">

                <button class="asignar">
                    Asignar Técnico
                </button>

            </a>

            <a href="tickets.php">

                <button class="volver">
                    Volver
                </button>

            </a>

        </div>

    </div>

</div>

</body>

</html>