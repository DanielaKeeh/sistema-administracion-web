<?php
require "funciones/conectaP.php";
$con = conectaP();

if ($_POST) {
    $nombre      = $_POST['nombre'];
    $codigo      = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];
    $costo       = $_POST['costo'];
    $stock       = $_POST['stock'];

  
    $archivo      = $_FILES['imagen']['name'];
    $tmp          = $_FILES['imagen']['tmp_name'];
    $archivo_file = "";

    if ($archivo != "") {
        $archivo_file = uniqid() . "_" . $archivo;
        move_uploaded_file($tmp, "archivos/" . $archivo_file);
    }

    
    $sql = "INSERT INTO productos 
            (nombre, codigo, descripcion, costo, stock, archivo_nombre, archivo_file, eliminar)
            VALUES ('$nombre', '$codigo', '$descripcion', $costo, $stock, '$archivo', '$archivo_file', 0)";
    
    $res = $con->query($sql);

    
    if (!$res) {
        echo "ERROR EN QUERY: " . $con->error;
        exit;
    }

    header("Location: productos_lista.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Alta de productos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styleAltaP.css">
  <link rel="stylesheet" href="css/styleMenu.css">
  <script src="js/jquery-3.3.1.min.js"></script>
</head>
<body>

<?php include 'menu.php'; ?>

<div class="fila titulo">
  <div>Alta de productos</div>
</div>

<div class="form-wrap">
  <form id="form_alta" method="post" action="productos_alta.php" autocomplete="off" enctype="multipart/form-data">
    
    <div class="form-grid">

      <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Nombre del producto" required>
      </div>

      <div class="campo">
        <label for="codigo">Código</label>
        <input type="text" id="codigo" name="codigo" placeholder="Código único" onblur="ValidarCodigo();" required>
        <div id="error_codigo" class="alerta-general"></div>
      </div>

      <div class="campo">
        <label for="costo">Costo</label>
        <input type="number" step="0.01" id="costo" name="costo" placeholder="Ej. 99.50" required>
      </div>

      <div class="campo">
        <label for="stock">Stock</label>
        <input type="number" id="stock" name="stock" placeholder="Cantidad en inventario" required>
      </div>

      <div class="campo" >
        <label for="descripcion">Descripción</label>
        <input type="text" id="descripcion" name="descripcion" placeholder="Descripción del producto" required>
      </div>

      <div class="campo" >
        <label for="imagen">Imagen</label>
        <input type="file" id="imagen" name="imagen" accept="image/*" required>
      </div>

    </div>

    

    <div class="acciones-form">
      <button type="button" id="btnGuardar" onclick="ValidarCampos();">REGISTRAR PRODUCTO</button>
      <div id="error_general" class="alerta-general"></div>
      <a href="productos_lista.php" class="btn-secundario">REGRESAR AL LISTADO</a>
    </div>
  </form>
</div>

<script>
var codigoInvalido = false;

function ValidarCodigo() {
  var codigo = $('#codigo').val().trim();
  var div = $('#error_codigo');
  div.hide().text('');
  codigoInvalido = false;

  if (codigo === '') return;

  $.ajax({
    url: 'funciones/validar_codigo.php',
    type: 'GET',
    data: { codigo: codigo },
    success: function (res) {
      res = res.trim();

      if (res === 'existe') {
        codigoInvalido = true;
        div.text('El código ' + codigo + ' ya existe.');
        div.show();
        setTimeout(() => div.fadeOut(200), 5000);
      } else {
        codigoInvalido = false;
      }
    }
  });
}

function ValidarCampos() {
  var nombre = $('#nombre').val().trim();
  var codigo = $('#codigo').val().trim();
  var costo  = $('#costo').val().trim();
  var stock  = $('#stock').val().trim();
  var desc   = $('#descripcion').val().trim();
  var imagen = $('#imagen').val().trim();
  var divGen = $('#error_general');

  divGen.hide().text('');

  if (nombre === '' || codigo === '' || costo === '' || stock === '' || desc === '' || imagen === '') {
    divGen.text('Faltan campos por llenar, incluida la imagen.');
    divGen.show();
    setTimeout(() => divGen.fadeOut(200), 5000);
    return;
  }

  if (codigoInvalido === true) {
    divGen.text('El código ya existe, escribe uno diferente.');
    divGen.show();
    setTimeout(() => divGen.fadeOut(200), 5000);
    return;
  }

  $('#form_alta').submit();
}
</script>

</body>
</html>
