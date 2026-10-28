<?php

include("../sesion/conexion.php");

if(isset($_POST['id_ticket']) && isset($_POST['tecnico'])){

    $id_ticket = $_POST['id_ticket'];
    $tecnico = $_POST['tecnico'];

    $sql = "UPDATE tickets
            SET tecnico='$tecnico',
                estado='En proceso'
            WHERE id_tickets='$id_ticket'";

    if(mysqli_query($conexion,$sql)){

        header("Location: tickets.php");
        exit();

    }else{

        echo "Error al asignar el técnico: " . mysqli_error($conexion);

    }

}else{

    echo "Datos incompletos.";

}
?>