<?php
session_start();
if (isset($_SESSION['nombreUser'])) {
    header("Location: bienvenida.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="css/styleIndex.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script>
    function validar() {
        var correo  = $('#correo').val().trim();
        var pass    = $('#pass').val().trim();
        var mensaje = $('#mensaje');

        mensaje.text('');

        if (correo === '' || pass === '') {
            mensaje.text('Faltan campos por llenar.');
            return false;
        }

        $.ajax({
            type: 'POST',
            url: 'funciones/valida.php',
            data: { correo: correo, pass: pass },
            success: function(res) {
                res = res.trim();
                if (res === '1') {
                    window.location.href = 'bienvenida.php';
                } else {
                    mensaje.text('Datos incorrectos o usuario inactivo.');
                }
            },
            error: function() {
                mensaje.text('Error al enviar datos.');
            }
        });

        return false;
    }
    </script>
</head>
<body>

<div class="fila titulo">
  <div>Iniciar sesión</div>
</div>

<div class="login-wrap">
    <form name="forma01" method="post" onsubmit="return validar();" autocomplete="off">
        <div class="campo">
            <label for="correo">Correo electrónico</label>
            <input type="text" name="correo" id="correo" placeholder="Usuario@correo.com">
        </div>

        <div class="campo">
            <label for="pass">Contraseña</label>
            <input type="password" name="pass" id="pass" placeholder="Escribe tu contraseña">
        </div>

        <div id="mensaje" class="alerta"></div>

        <div class="acciones-form">
            <input type="submit" value="Ingresar" class="btn-login">
        </div>
    </form>
</div>

</body>
</html>
