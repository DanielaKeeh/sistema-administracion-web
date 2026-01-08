<?php
require "conecta.php";
$con = conecta();

$id        = intval($_POST['id']);
$nombre    = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$correo    = $_POST['correo'];
$pass      = $_POST['pass'];
$rol       = $_POST['rol'];

$passEnc = ($pass != '') ? md5($pass) : '';

$archivo_nombre = '';
$archivo_file   = '';

if (!empty($_FILES['archivo']['name'])) {
    $archivo_nombre = $_FILES['archivo']['name'];
    $archivo_temp   = $_FILES['archivo']['tmp_name'];
    $archivo_file   = uniqid() . "_" . $archivo_nombre;
    $destino        = "../archivos/" . $archivo_file;
    move_uploaded_file($archivo_temp, $destino);
}

$sql = "UPDATE empleados 
        SET nombre = '$nombre',
            apellidos = '$apellidos',
            correo = '$correo',
            rol = $rol";

if ($passEnc != '') {
    $sql .= ", pass = '$passEnc'";
}

if ($archivo_file != '') {
    $sql .= ", archivo_nombre = '$archivo_nombre', archivo_file = '$archivo_file'";
}

$sql .= " WHERE id = $id";

$con->query($sql);

header("Location: ../empleados_lista.php");
?>
