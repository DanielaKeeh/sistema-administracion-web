<?php
require "conectaP.php";
$con = conectaP();

$id          = intval($_POST['id']);
$nombre      = $_POST['nombre'];
$codigo      = $_POST['codigo'];
$descripcion = $_POST['descripcion'];
$costo       = $_POST['costo'];
$stock       = $_POST['stock'];

$archivo_nombre = '';
$archivo_file   = '';

if (!empty($_FILES['archivo']['name'])) {
    $archivo_nombre = $_FILES['archivo']['name'];
    $archivo_temp   = $_FILES['archivo']['tmp_name'];
    $archivo_file   = uniqid() . "_" . $archivo_nombre;
    $destino        = "../archivos/" . $archivo_file;
    move_uploaded_file($archivo_temp, $destino);
}

$sql = "UPDATE productos
        SET nombre = '$nombre',
            codigo = '$codigo',
            descripcion = '$descripcion',
            costo = $costo,
            stock = $stock";

if ($archivo_file != '') {
    $sql .= ", archivo_nombre = '$archivo_nombre', archivo_file = '$archivo_file'";
}

$sql .= " WHERE id = $id";

$con->query($sql);

header("Location: ../productos_lista.php");
?>
