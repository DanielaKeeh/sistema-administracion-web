<?php
require "conectaP.php";
$con = conectaP();

$codigo = $_POST['codigo'];
$id     = intval($_POST['id']);

$sql = "SELECT id
        FROM productos
        WHERE codigo = '$codigo'
          AND id != $id
          AND (eliminar = 0 OR eliminar IS NULL)";

$res = $con->query($sql);

echo ($res->num_rows > 0) ? 1 : 0;

$con->close();
?>
