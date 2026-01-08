<?php
require "conecta.php";

$con = conecta();

if (isset($_GET['correo'])) {
    $correo = $_GET['correo'];

    $sql = "SELECT id FROM empleados WHERE correo = '$correo' AND (eliminar = 0 OR eliminar IS NULL)";
    $res = $con->query($sql);

    if ($res->num_rows > 0) {
        echo "existe";
    } else {
        echo "no_existe";
    }
}

$con->close();
?>
