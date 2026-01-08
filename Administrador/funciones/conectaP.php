<?php
define("HOSTP", 'localhost:3306');
define("BDP", 'empresa'); 
define("USER_DBP", 'root');
define("PASS_DBP", '');

function conectaP() {
    $con = new mysqli(HOSTP, USER_DBP, PASS_DBP, BDP);
    return $con;
}
?>
