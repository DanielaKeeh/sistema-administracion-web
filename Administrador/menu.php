<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<div id="menu">
    <nav>
        <a href="bienvenida.php">INICIO</a>
        <a href="empleados_lista.php">EMPLEADOS</a>
        <a href="productos_lista.php">PRODUCTOS</a>
        <a href="#">PROMOCIONES</a>
        <a href="#">PEDIDOS</a>
        <span class="bienvenido">
            BIENVENIDO <?php echo isset($_SESSION['nombreUser']) ? htmlspecialchars($_SESSION['nombreUser']) : 'INVITADO'; ?>
        </span>
        <a href="logout.php" class="cerrar">CERRAR SESIÓN</a>
    </nav>
</div>
