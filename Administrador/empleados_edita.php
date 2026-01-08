<?php 
require "funciones/conecta.php";
$con = conecta();

$id = intval($_REQUEST['id']);

$sql = "SELECT * FROM empleados WHERE (eliminar = 0 OR eliminar IS NULL) AND id = $id";
$res = $con->query($sql);
$row = $res->fetch_array();
?>
<html>
<head>
    <title>Edición de empleados</title>
    <link rel="stylesheet" href="css/styleEdicion.css">
    <link rel="stylesheet" href="css/styleMenu.css">
    <script src="js/jquery-3.3.1.min.js"></script>
</head>
<body>

<?php include 'menu.php'; ?>

<div class="fila titulo">
  <div>Edición de empleado #<?php echo $row['id']; ?></div>
</div>

<div class="form-wrap">
    <form name="formulario" method="post" enctype="multipart/form-data" action="funciones/validar_cambios.php" onsubmit="return validaCampos();" autocomplete="off">

        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <div class="form-columns">

            <div class="col">
                <div class="campo">
                    <label>Nombre:</label>
                    <input type="text" name="nombre" value="<?php echo htmlspecialchars($row['nombre']); ?>" placeholder="Escribe el nombre">
                </div>

                <div class="campo">
                    <label>Apellidos:</label>
                    <input type="text" name="apellidos" value="<?php echo htmlspecialchars($row['apellidos']); ?>" placeholder="Escribe los apellidos">
                </div>

                <div class="campo">
                    <label>Correo:</label>
                    <input type="email" name="correo" id="correo" value="<?php echo htmlspecialchars($row['correo']); ?>" placeholder="Usuario@correo.com" onblur="verificaCorreo();">
                    <div id="mensajeCorreo" class="alerta-correo"></div>
                </div>

                <div class="campo">
                    <label>Contraseña:</label>
                    <input type="password" name="pass" placeholder="Nueva contraseña (opcional)">
                </div>
            </div>

            <div class="col">
                <div class="campo">
                    <label>Rol:</label>
                    <select name="rol">
                        <option value="1" <?php if ($row['rol'] == 1) echo 'selected'; ?>>Gerente</option>
                        <option value="2" <?php if ($row['rol'] == 2) echo 'selected'; ?>>Ejecutivo</option>
                    </select>
                </div>

                <div class="campo">
                    <label>Foto actual:</label>
                    <?php
                    if ($row['archivo_file'] != '') {
                        echo "<img src='archivos/" . htmlspecialchars($row['archivo_file']) . "' class='foto-actual'>";
                    } else {
                        echo "<span>Sin imagen</span>";
                    }
                    ?>
                </div>

                <div class="campo">
                    <label>Nueva foto:</label>
                    <input type="file" name="archivo" accept="image/*">
                </div>
            </div>

        </div>

        <div id="mensaje" class="alerta-general"></div>

        <div class="acciones-form">
            <button type="submit" class="btn-guardar" id="btnGuardar">GUARDAR CAMBIOS</button>
            <a href="empleados_lista.php" class="btn-secundario">REGRESAR AL LISTADO</a>
        </div>
    </form>
</div>

<script>
function validaCampos() {
    var nombre    = document.formulario.nombre.value.trim();
    var apellidos = document.formulario.apellidos.value.trim();
    var correo    = document.formulario.correo.value.trim();
    var rol       = document.formulario.rol.value;
    var msg       = document.getElementById("mensaje");

    msg.style.display = 'none';
    msg.innerHTML = '';

    if (nombre === '' || apellidos === '' || correo === '' || rol === '') {
        msg.innerHTML = "Faltan campos por llenar.";
        msg.style.display = 'block';
        setTimeout(function(){ msg.style.display = 'none'; }, 5000);
        return false;
    }
    return true;
}

function verificaCorreo() {
    var correo = $('#correo').val().trim();
    var id = <?php echo $row['id']; ?>;
    var div = $('#mensajeCorreo');

    div.hide().text('');

    if (correo === '') {
        return;
    }

    $.ajax({
        url: 'funciones/validar_correo2.php',
        type: 'POST',
        data: { correo: correo, id: id },
        success: function(response) {
            if (response == 1) {
                div.text("El correo " + correo + " ya existe.");
                div.show();
                setTimeout(function(){ div.fadeOut(200); }, 5000);
                $('#correo').val('');
            }
        }
    });
}
</script>

</body>
</html>
