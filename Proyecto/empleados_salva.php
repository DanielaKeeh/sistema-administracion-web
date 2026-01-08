<?php

require "funciones/conecta.php";
$con = conecta();

$nombre = $_REQUEST['nombre'];
$apellido = $_REQUEST['apellido'];
$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pass'];
$rol = $_REQUEST['rol'];
$passEnc = md5($pass);
$imagen = '';

$sql = "INSERT INTO empleados
 (nombre, apellido, correo, pass, rol,imagen)
  VALUES ('$nombre', '$apellido', '$correo', '$passEnc', $rol,'$imagen')";
$res = $con->query($sql);

header("Location: empleados_lista.php");
?>
