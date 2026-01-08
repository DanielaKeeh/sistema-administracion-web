<?php
require "funciones/conectaP.php";
$con = conectaP();

$id = $_REQUEST['id'];

$sql = "SELECT * FROM productos WHERE id = $id";
$res = $con->query($sql);
?>
<html>
<head>
    <title>Detalle de producto</title>
    <link rel="stylesheet" href="css/styleVer.css">
    <link rel="stylesheet" href="css/styleMenu.css">
</head>
<body>

<?php include 'menu.php'; ?>

<div class="fila titulo">
  <div>Detalle de producto</div>
</div>

<div class="detalle-contenedor">

<?php
if ($res && $res->num_rows > 0) {
    $row        = $res->fetch_array();
    $id         = $row["id"];
    $codigo     = $row["codigo"];
    $nombre     = $row["nombre"];
    $descripcion= $row["descripcion"];
    $costo      = $row["costo"];
    $stock      = $row["stock"];
    $status     = ($row["eliminar"] == 0 || $row["eliminar"] == NULL) ? "Disponible" : "Indisponible";

    echo "<h2>Producto #$id</h2>";
    echo "<div class='detalle-item'><strong>Código:</strong> $codigo</div>";
    echo "<div class='detalle-item'><strong>Nombre:</strong> $nombre</div>";
    echo "<div class='detalle-item'><strong>Descripción:</strong> $descripcion</div>";
    echo "<div class='detalle-item'><strong>Costo:</strong> $$costo</div>";
    echo "<div class='detalle-item'><strong>Stock:</strong> $stock unidades</div>";
    echo "<div class='detalle-item'><strong>Status:</strong> $status</div>";

    if (!empty($row['archivo_file'])) {
        echo "<div class='detalle-imagen'>
                <img src='archivos/" . $row['archivo_file'] . "' alt='Imagen del producto'>
              </div>";
    }

    echo "<div class='btn-regresar-container'>
            <a href='productos_lista.php' class='btn-regresar'>REGRESAR AL LISTADO</a>
          </div>";

} else {
    echo "<p class='error'>Producto no encontrado.</p>";
}
?>

</div>

</body>
</html>
