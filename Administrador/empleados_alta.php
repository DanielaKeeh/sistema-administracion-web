<?php
require "funciones/conecta.php";
$con = conecta();

if ($_POST) {
    $nombre    = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo    = $_POST['correo'];
    $pass      = $_POST['pass'];
    $rol       = $_POST['rol'];

    $passEnc = md5($pass);

    $archivo   = $_FILES['imagen']['name'];
    $tmp       = $_FILES['imagen']['tmp_name'];
    $archivo_n = "";

    if ($archivo != "") {
        $archivo_n = uniqid() . "_" . $archivo;
        move_uploaded_file($tmp, "archivos/" . $archivo_n);
    }

    $sql = "INSERT INTO empleados (nombre, apellidos, correo, pass, rol, archivo_file, eliminar)
            VALUES ('$nombre', '$apellidos', '$correo', '$passEnc', $rol, '$archivo_n', 0)";
    $con->query($sql);

    header("Location: empleados_lista.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Alta de empleados</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styleAlta.css">
  <link rel="stylesheet" href="css/styleMenu.css">
  <script src="js/jquery-3.3.1.min.js"></script>
</head>
<body>

<?php include 'menu.php'; ?>

<div class="fila titulo">
  <div>Alta de empleados</div>
</div>

<div class="form-wrap">
  <form id="form_alta" method="post" action="empleados_alta.php" autocomplete="off" enctype="multipart/form-data">
    
    <div class="form-grid">
      <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Escribe el nombre" required>
      </div>

      <div class="campo">
        <label for="apellidos">Apellidos</label>
        <input type="text" id="apellidos" name="apellidos" placeholder="Escribe los apellidos" required>
      </div>

      <div class="campo">
        <label for="correo">Correo</label>
        <input type="email" id="correo" name="correo" placeholder="Usuario@correo.com" onblur="ValidarCorreo();" required>
        <div id="error_correo" class="alerta-correo"></div>
      </div>

      <div class="campo">
        <label for="pass">Contraseña</label>
        <input type="password" id="pass" name="pass" placeholder="Escribe una contraseña" required>
      </div>

      <div class="campo">
        <label for="rol">Rol</label>
        <select id="rol" name="rol" required>
          <option value="">Selecciona una opción</option>
          <option value="1">Gerente</option>
          <option value="2">Ejecutivo</option>
        </select>
      </div>

      <div class="campo">
        <label for="imagen">Imagen</label>
        <input type="file" id="imagen" name="imagen" accept="image/*" required>
      </div>
    </div>

    

    <div class="acciones-form">
      <button type="button" id="btnGuardar" onclick="ValidarCampos();">REGISTRAR EMPLEADO</button>
      <div id="error_general" class="alerta-general"></div>
      <a href="empleados_lista.php" class="btn-secundario">REGRESAR AL LISTADO</a>
    </div>
  </form>
</div>

<script>
var correoInvalido = false;

function ValidarCorreo() {
  var correo = $('#correo').val().trim();
  var div = $('#error_correo');
  div.hide().text('');
  correoInvalido = false;

  if (correo === '') {
    return;
  }

  $.ajax({
    url: 'funciones/validar_correo.php',
    type: 'GET',
    data: { correo: correo },
    success: function (res) {
      res = res.trim();

      if (res === 'existe') {
        correoInvalido = true;
        div.text('El correo ' + correo + ' ya existe.');
        div.show();
        setTimeout(function () {
          div.fadeOut(200);
        }, 5000);
      } else {
        correoInvalido = false;
      }
    }
  });
}

function ValidarCampos() {
  var nombre    = $('#nombre').val().trim();
  var apellidos = $('#apellidos').val().trim();
  var correo    = $('#correo').val().trim();
  var pass      = $('#pass').val().trim();
  var rol       = $('#rol').val().trim();
  var imagen    = $('#imagen').val().trim();
  var divGen    = $('#error_general');

  divGen.hide().text('');

  if (nombre === '' || apellidos === '' || correo === '' || pass === '' || rol === '' || imagen === '') {
    divGen.text('Faltan campos por llenar, incluida la imagen.');
    divGen.show();
    setTimeout(function () {
      divGen.fadeOut(200);
    }, 5000);
    return;
  }

  if (correoInvalido === true) {
    divGen.text('El correo ya existe, escribe uno diferente.');
    divGen.show();
    setTimeout(function () {
      divGen.fadeOut(200);
    }, 5000);
    return;
  }

  $('#form_alta').submit();
}
</script>

</body>
</html>
