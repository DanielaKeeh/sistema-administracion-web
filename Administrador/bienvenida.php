<?php
session_start();
if (!isset($_SESSION['nombreUser'])) {
    header("Location: index1.php");
    exit();
}

$nombreUser = $_SESSION['nombreUser'];
$correoUser = $_SESSION['correoUser'];
$rol = ($_SESSION['rolUser'] == 1) ? "Gerente" : "Ejecutivo";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de administración</title>
    <link rel="stylesheet" href="css/styleBienvenida.css">
    <link rel="stylesheet" href="css/styleMenu.css">
</head>
<body>

<?php include 'menu.php'; ?>

<div class="fila titulo">
  <div>Panel de inicio</div>
</div>

<div class="contenedor-bienvenida">
    <h2>Hola, bienvenido al sistema, <?php echo htmlspecialchars($nombreUser); ?>.</h2>
    <p><strong>Correo:</strong> <?php echo htmlspecialchars($correoUser); ?></p>
    <p><strong>Rol:</strong> <?php echo $rol; ?></p>
</div>

</body>
</html>
