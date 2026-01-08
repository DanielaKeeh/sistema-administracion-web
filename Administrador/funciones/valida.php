<?php
session_start();
require "conecta.php";
$con = conecta();

$correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
$pass   = isset($_POST['pass']) ? trim($_POST['pass']) : '';

if ($correo === '' || $pass === '') {
    echo 0;
    exit;
}

$passEnc = md5($pass);

$sql = "SELECT id, nombre, apellidos, correo, rol
        FROM empleados
        WHERE correo = '$correo'
          AND pass = '$passEnc'
          AND (eliminar = 0 OR eliminar IS NULL)
        LIMIT 1";

$res = $con->query($sql);

if ($res && $res->num_rows == 1) {
    $row = $res->fetch_assoc();
    $_SESSION['idUser']     = $row['id'];
    $_SESSION['nombreUser'] = $row['nombre'] . ' ' . $row['apellidos'];
    $_SESSION['correoUser'] = $row['correo'];
    $_SESSION['rolUser']    = $row['rol'];
    echo 1;
} else {
    echo 0;
}
