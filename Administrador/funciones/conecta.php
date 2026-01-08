<?php
define("HOST", 'localhost:3306');
define("BD", 'empresa');
define("USER_DB", 'root');
define("PASS_DB", '');

function conecta() {
    $con = new mysqli( HOST, USER_DB, PASS_DB, BD );
    return $con;
}