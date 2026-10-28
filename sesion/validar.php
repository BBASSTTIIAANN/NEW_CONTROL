

<?php
session_start();

include("conexion.php");

// Verificar que lleguen los datos del formulario
if (!isset($_POST["usuario"]) || !isset($_POST["clave"])) {
    header("Location: login.php?error=1");
    exit();
}

$usuario = $_POST["usuario"];
$clave = $_POST["clave"];

// Buscar el usuario en la base de datos
$sql = "SELECT * FROM usuarios
        WHERE identificacion = '$usuario'
        AND clave = '$clave'";

$resultado = mysqli_query($conexion, $sql);

// Verificar si existe el usuario
if (mysqli_num_rows($resultado) > 0) {

    $fila = mysqli_fetch_assoc($resultado);

    // Verificar si la cuenta está activa
    if ($fila["id_estados"] != 1) {
        header("Location: login.php?error=cuenta");
        exit();
    }

    // Guardar datos en la sesión
    $_SESSION["identificacion"] = $fila["identificacion"];
    $_SESSION["nombres"] = $fila["nombres"];
    $_SESSION["id_perfiles"] = $fila["id_perfiles"];

    // Redirigir según el perfil
    if ($fila["id_perfiles"] == 1) {

        header("Location: /NEW%20CONTROL/admin/admin_index.php");

    } elseif ($fila["id_perfiles"] == 2) {

        header("Location: /NEW%20CONTROL/tecnico/tecnico.php");

    } elseif ($fila["id_perfiles"] == 3) {

        header("Location: /NEW%20CONTROL/cliente/cliente.php");

    } else {

        echo "Perfil no válido.";
        exit();
    }

} else {

    header("Location: login.php?error=1");
    exit();
}

exit();
?>
