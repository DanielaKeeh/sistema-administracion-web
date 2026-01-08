<?php
require "funciones/conecta.php";
$con = conecta();
if(isset($_POST['id'])){
    $id = (int)$_POST['id'];
    $sql = "UPDATE empleados SET eliminado = 1 WHERE id = $id";
    $res = $con->query($sql);
    echo $res ? "1" : "0";
} else {
    echo "0";
}
