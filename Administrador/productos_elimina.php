<?php
require "funciones/conectaP.php";
$con = conectaP();

$id = $_REQUEST['id'];

$sql = "UPDATE productos SET eliminar = 1 WHERE id = $id";
$con->query($sql);

header("Location: productos_lista.php");
?>