<?php
require "funciones/conecta.php";
$con = conecta();

$id = $_REQUEST['id'];

$sql = "SELECT * FROM empleados WHERE id = $id";
$res = $con->query($sql);
?>
<html>
<head>
    <title>Detalle de empleado</title>
    <link rel="stylesheet" href="css/styleVer.css">
    <link rel="stylesheet" href="css/styleMenu.css">
</head>
<body>

<?php include 'menu.php'; ?>

<div class="fila titulo">
  <div>Detalle de empleado</div>
</div>

<div class="detalle-contenedor">

<?php
if ($res && $res->num_rows > 0) {
    $row    = $res->fetch_array();
    $id     = $row["id"];
    $nombre = $row["nombre"] . " " . $row["apellidos"];
    $correo = $row["correo"];
    $rol    = ($row["rol"] == 1) ? "Gerente" : "Ejecutivo";
    $status = ($row["eliminar"] == 0 || $row["eliminar"] == NULL) ? "Activo" : "Inactivo";

    echo "<h2>Empleado #$id</h2>";
    echo "<div class='detalle-item'><strong>Nombre:</strong> $nombre</div>";
    echo "<div class='detalle-item'><strong>Correo:</strong> $correo</div>";
    echo "<div class='detalle-item'><strong>Rol:</strong> $rol</div>";
    echo "<div class='detalle-item'><strong>Status:</strong> $status</div>";

    if (!empty($row['archivo_file'])) {
        echo "<div class='detalle-imagen'><img src='archivos/" . $row['archivo_file'] . "' alt='Foto de $nombre'></div>";
    }

    echo "<div class='btn-regresar-container'><a href='empleados_lista.php' class='btn-regresar'>REGRESAR AL LISTADO</a></div>";

} else {
    echo "<p class='error'>Empleado no encontrado.</p>";
}
?>

</div>

</body>
</html>
