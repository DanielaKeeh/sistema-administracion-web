<?php
require "conecta.php";
$con = conecta();

$correo = $_POST['correo'];
$id     = intval($_POST['id']);

$sql = "SELECT id 
        FROM empleados 
        WHERE correo = '$correo' 
          AND id != $id 
          AND (eliminar = 0 OR eliminar IS NULL)";

$res = $con->query($sql);

echo ($res->num_rows > 0) ? 1 : 0;

$con->close();
?>
