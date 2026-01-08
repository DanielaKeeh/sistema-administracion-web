<?php
require "conectaP.php";
$con = conectaP();

if (!isset($_GET['codigo'])) {
    echo "no_existe";
    $con->close();
    exit;
}

$codigo = $con->real_escape_string($_GET['codigo']);

$sql = "SELECT id FROM productos WHERE codigo = '$codigo' AND (eliminar = 0 OR eliminar IS NULL) LIMIT 1";
$res = $con->query($sql);

if ($res && $res->num_rows > 0) {
    echo "existe";
} else {
    echo "no_existe";
}

$con->close();
?>
