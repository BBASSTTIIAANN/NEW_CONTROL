<?php
session_start();

include("conexion.php");

$usuario = $_POST["usuario"];
$clave = $_POST["clave"];

$sql = "SELECT * FROM usuarios
        WHERE usuario='$usuario'
        AND clave='$clave'";

$resultado = mysqli_query($conexion, $sql);

if(mysqli_num_rows($resultado) > 0){

    $fila = mysqli_fetch_assoc($resultado);

    $_SESSION["usuario"] = $fila["usuario"];
    $_SESSION["nombre"] = $fila["nombre"];
    $_SESSION["rol"] = $fila["rol"];

    if($fila["rol"] == "administrador"){

    header("Location: /NEW%20CONTROL/admin/admin_index.php");

}elseif($fila["rol"] == "tecnico"){

    header("Location: /NEW%20CONTROL/tecnico/tecnico.php");

}else{

    echo "Rol no válido: " . $fila["rol"];

}

exit();
}else{

    header("Location: login.php?error=1");

}

exit();
?>