<?php
define("HOST", '127.0.0.1');
define("PORT", 3306);
define("BD", 'empresa');
define("USER_DB", 'root');
define("PASS_DB", '');

function conecta() {
    $con = new mysqli(HOST, USER_DB, PASS_DB, BD, PORT);
    if ($con->connect_errno) { die('Error de conexión'); }
    $con->set_charset('utf8mb4');
    return $con;
}
