<?php
require "funciones/conectaP.php";
$con = conectaP();

$nombre = $_REQUEST['nombre'];
$codigo = $_REQUEST['codigo'];
$descripcion = $_REQUEST['descripcion'];
$costo = $_REQUEST['costo'];
$stock = $_REQUEST['stock'];

$sql = "INSERT INTO productos
(nombre, codigo, descripcion, costo, stock, status, eliminar)
VALUES ('$nombre', '$codigo', '$descripcion', $costo, $stock, 1, 0)";

$res = $con->query($sql);

header("Location: productos_lista.php");
?>
