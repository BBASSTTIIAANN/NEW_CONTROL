<?php
include("../sesion/conexion.php"); // Cambia la ruta si tu conexion.php está en otro lugar

$sql = "SELECT * FROM tickets ORDER BY id_tickets DESC";
$resultado = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tickets</title>

    <link rel="stylesheet" href="tickets..css">
</head>

<body>

<div class="contenedor">

    <header>

        <h1>Tickets Recibidos desde WhatsApp</h1>

        <div class="usuario">
            Administrador
        </div>

    </header>

    <section class="busqueda">

        <input type="text" placeholder="Buscar ticket...">

        <select>
            <option>Todos</option>
            <option>Pendiente</option>
            <option>En proceso</option>
            <option>Finalizado</option>
        </select>

    </section>

    <section class="tabla">

        <table>

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Tipo de Falla</th>
                    <th>Prioridad</th>
                    <th>Estado</th>
                    <th>Acciones</th>

                </tr>

            </thead>

            <tbody>

            <?php
            if(mysqli_num_rows($resultado) > 0){

                while($fila = mysqli_fetch_assoc($resultado)){
            ?>

                <tr>

                    <td><?php echo $fila['id_tickets']; ?></td>

                    <td><?php echo $fila['usuarios']; ?></td>

                    <td><?php echo $fila['id_fallas']; ?></td>

                    <td><?php echo $fila['id_prioridades']; ?></td>

                    <td><?php echo $fila['id_estados']; ?></td>

                    <td>

                        <a href="detalle_ticket.php?id=<?php echo $fila['id_tickets']; ?>">

                            <button class="ver">
                                Ver
                            </button>

                        </a>

                        <a href="asignar_tecnico.php?id=<?php echo $fila['id_tickets']; ?>">

                            <button class="ver">
                                Asignar
                            </button>

                        </a>

                    </td>

                </tr>

            <?php

                }

            }else{

                echo "<tr><td colspan='6'>No hay tickets registrados.</td></tr>";

            }

            ?>

            </tbody>

        </table>

    </section>

</div>

</body>
</html>