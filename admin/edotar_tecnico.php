<?php

include("conexion.php");

$id = $_GET["id"];

// Buscar el técnico
$sql = "SELECT * FROM tecnicos WHERE id='$id'";
$resultado = mysqli_query($conexion, $sql);

$fila = mysqli_fetch_assoc($resultado);

// Si no existe el técnico
if(!$fila){
    echo "Técnico no encontrado.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Editar Técnico</title>

<link rel="stylesheet" href="tecnicos.css">

</head>

<body>

<div class="contenedor">

<div class="formulario">

<h2>Editar Técnico</h2>

<form action="actualizar_tecnico.php" method="POST">

<input type="hidden" name="id" value="<?php echo $fila["id"]; ?>">

<label>Nombre</label>
<input type="text" name="nombre" value="<?php echo $fila["nombre"]; ?>" required>

<label>Apellido</label>
<input type="text" name="apellido" value="<?php echo $fila["apellido"]; ?>" required>

<label>Cédula</label>
<input type="text" name="cedula" value="<?php echo $fila["cedula"]; ?>" required>

<label>Teléfono</label>
<input type="text" name="telefono" value="<?php echo $fila["telefono"]; ?>" required>

<label>Correo</label>
<input type="email" name="correo" value="<?php echo $fila["correo"]; ?>" required>

<label>Usuario</label>
<input type="text" name="usuario" value="<?php echo $fila["usuario"]; ?>" required>

<label>Contraseña</label>
<input type="text" name="clave" value="<?php echo $fila["clave"]; ?>" required>

<label>Especialidad</label>

<select name="especialidad">

<option <?php if($fila["especialidad"]=="FTTH") echo "selected"; ?>>FTTH</option>

<option <?php if($fila["especialidad"]=="HFC") echo "selected"; ?>>HFC</option>

<option <?php if($fila["especialidad"]=="Redes") echo "selected"; ?>>Redes</option>

<option <?php if($fila["especialidad"]=="Fibra Óptica") echo "selected"; ?>>Fibra Óptica</option>

</select>

<label>Estado</label>

<select name="estado">

<option <?php if($fila["estado"]=="Activo") echo "selected"; ?>>Activo</option>

<option <?php if($fila["estado"]=="Inactivo") echo "selected"; ?>>Inactivo</option>

</select>

<br><br>

<button type="submit">

Actualizar Técnico

</button>

</form>

</div>

</div>

</body>

</html>