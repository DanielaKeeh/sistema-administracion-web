<?php
require "funciones/conecta.php";
$con = conecta();

$id = $_REQUEST['id'];

$sql = "UPDATE empleados SET eliminar = 1 WHERE id = $id";
$con->query($sql);

header("Location: empleados_lista.php");
?>
