<?php 
require "funciones/conectaP.php";
$con = conectaP();

$sql = "SELECT * FROM productos WHERE eliminar = 0 OR eliminar IS NULL";
$res = $con->query($sql);
$num = $res->num_rows;
?>
<html>
<head>
  <title>Lista de productos</title>
  <link rel="stylesheet" href="css/styleLP.css">
  <link rel="stylesheet" href="css/styleMenu.css">
  <style>
    .fotoMini{
      width:45px;
      height:45px;
      border-radius:8px;
      object-fit:cover;
      background:#ccc;
      display:block;
      margin:auto;
    }
  </style>
</head>

<body>

<?php include 'menu.php'; ?>

<div class="fila titulo">
  <div>Lista de productos (<?php echo $num; ?>)</div>
</div>

<div class="tabla">

  <div class="fila crear" style="padding:18px;">
    <div>
      <div class="cuadro">
        <a href="productos_alta.php">Crear nuevo producto</a>
      </div>
    </div>
  </div>

  <div class="fila encabezado">
    <div>ID</div>
    <div>Imagen</div>
    <div>Nombre</div>
    <div>Código</div>
    <div>Costo</div>
    <div>Stock</div>
    <div>Ver</div>
    <div>Editar</div>
    <div>Eliminar</div>
  </div>

  <?php while ($row = $res->fetch_array()) { ?>
    <div class="fila">
      <div><?php echo $row["id"]; ?></div>

      <div>
        <?php 
        if ($row["archivo_file"] != "") {
            echo "<img class='fotoMini' src='archivos/" . $row["archivo_file"] . "'>";
        } else {
            echo "<img class='fotoMini' src='archivos/default.png'>";
        }
        ?>
      </div>

      <div><?php echo $row["nombre"]; ?></div>
      <div><?php echo $row["codigo"]; ?></div>
      <div>$<?php echo number_format($row["costo"],2); ?></div>
      <div><?php echo $row["stock"]; ?></div>

      <div>
        <a href="productos_ver.php?id=<?php echo $row['id']; ?>">
          <img src="img/lupa.png" class="icono">
        </a>
      </div>
      <div>
        <a href="productos_edita.php?id=<?php echo $row['id']; ?>">
          <img src="img/editar.png" class="icono">
        </a>
      </div>
      <div>
        <a href="productos_elimina.php?id=<?php echo $row['id']; ?>">
          <img src="img/bote.png" class="icono">
        </a>
      </div>
    </div>
  <?php } ?>

</div>

</body>
</html>
