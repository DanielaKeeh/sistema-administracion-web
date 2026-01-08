<?php
require "conectaP.php";
$con = conectaP();

$id          = intval($_POST['id']);
$codigo      = trim($_POST['codigo']);
$nombre      = trim($_POST['nombre']);
$descripcion = trim($_POST['descripcion']);
$costo       = floatval($_POST['costo']);
$precio      = floatval($_POST['precio']);

$archivo_name = '';
if ($_FILES['archivo']['name'] != '') {
    $archivo_tmp  = $_FILES['archivo']['tmp_name'];
    $archivo_name = time() . '_' . basename($_FILES['archivo']['name']);
    move_uploaded_file($archivo_tmp, "../archivos/$archivo_name");
}

$sql = "UPDATE productos 
        SET codigo = '$codigo',
            nombre = '$nombre',
            descripcion = '$descripcion',
            costo = $costo,
            precio = $precio'";

if ($archivo_name != '') {
    $sql .= ", archivo_file = '$archivo_name'";
}

$sql .= " WHERE id = $id";

$con->query($sql);

header("Location: ../productos_lista.php");
?>
