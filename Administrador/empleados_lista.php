<?php 
require "funciones/conecta.php";
$con = conecta();

$sql = "SELECT * FROM empleados WHERE eliminar = 0 OR eliminar IS NULL";
$res = $con->query($sql);
$num = $res->num_rows;
?>
<html>
<head>
  <title>Lista de empleados</title>
  <link rel="stylesheet" href="css/style.css">
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
  <div>Lista de empleados (<?php echo $num; ?>)</div>
</div>

<div class="tabla">

  <div class="fila crear" style="padding:18px;">
    <div>
      <div class="cuadro">
        <a href="empleados_alta.php">Crear nuevo registro</a>
      </div>
    </div>
  </div>

  <div class="fila encabezado">
    <div>ID</div>
    <div>Foto</div>
    <div>Nombre</div>
    <div>Apellidos</div>
    <div>Correo</div>
    <div>Rol</div>
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
      <div><?php echo $row["apellidos"]; ?></div>
      <div><?php echo $row["correo"]; ?></div>
      <div><?php echo ($row["rol"] == 1) ? "Gerente" : "Ejecutivo"; ?></div>

      <div>
        <a href="empleados_ver.php?id=<?php echo $row['id']; ?>">
          <img src="img/lupa.png" class="icono">
        </a>
      </div>
      <div>
        <a href="empleados_edita.php?id=<?php echo $row['id']; ?>">
          <img src="img/editar.png" class="icono">
        </a>
      </div>
      <div>
        <a href="empleados_elimina.php?id=<?php echo $row['id']; ?>">
          <img src="img/bote.png" class="icono">
        </a>
      </div>
    </div>
  <?php } ?>

</div>

</body>
</html>
