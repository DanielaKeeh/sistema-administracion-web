<?php 
require "funciones/conectaP.php";
$con = conectaP();

$id = intval($_REQUEST['id']);

$sql = "SELECT * FROM productos WHERE (eliminar = 0 OR eliminar IS NULL) AND id = $id";
$res = $con->query($sql);
$row = $res->fetch_array();
?>
<html>
<head>
    <title>Edición de producto</title>
    <link rel="stylesheet" href="css/styleEdicionP.css">
    <link rel="stylesheet" href="css/styleMenu.css">
    <script src="js/jquery-3.3.1.min.js"></script>
</head>
<body>

<?php include 'menu.php'; ?>

<div class="fila titulo">
  <div>Edición de producto #<?php echo $row['id']; ?></div>
</div>

<div class="form-wrap">

    <form name="formulario" method="post" enctype="multipart/form-data" 
          action="funciones/valida_cambiosP.php" 
          onsubmit="return validaCampos();" autocomplete="off">

        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <div class="form-columns">

            <div class="col">

                <div class="campo">
                    <label>Código:</label>
                    <input type="text" name="codigo" id="codigo"
                           value="<?php echo htmlspecialchars($row['codigo']); ?>"
                           onblur="verificaCodigo();">
                    <div id="mensajeCodigo" class="alerta-general"></div>
                </div>

                <div class="campo">
                    <label>Nombre:</label>
                    <input type="text" name="nombre"
                           value="<?php echo htmlspecialchars($row['nombre']); ?>">
                </div>

                <div class="campo">
                    <label>Descripción:</label>
                    <textarea name="descripcion"><?php echo htmlspecialchars($row['descripcion']); ?></textarea>
                </div>

                <div class="campo">
                    <label>Stock:</label>
                    <input type="number" name="stock" value="<?php echo $row['stock']; ?>">
                </div>

            </div>

            <div class="col">

                <div class="campo">
                    <label>Costo:</label>
                    <input type="number" step="0.01" name="costo" value="<?php echo $row['costo']; ?>">
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

                <div class="campo imagen">
                    <label>Nueva foto:</label>
                    <input type="file" name="archivo" accept="image/*">
                </div>

            </div>

        </div>

        

        <div class="acciones-form">
            <button type="submit" class="btn-guardar" id="btnGuardar">GUARDAR CAMBIOS</button>
            <div id="mensaje" class="alerta-general"></div>
            <a href="productos_lista.php" class="btn-secundario">REGRESAR AL LISTADO</a>
        </div>

    </form>

</div>

<script>
function validaCampos() {
    var codigo = document.formulario.codigo.value.trim();
    var nombre = document.formulario.nombre.value.trim();
    var costo  = document.formulario.costo.value.trim();
    var stock  = document.formulario.stock.value.trim();
    var msg    = document.getElementById("mensaje");

    msg.style.display = 'none';
    msg.innerHTML = '';

    if (codigo === '' || nombre === '' || costo === '' || stock === '') {
        msg.innerHTML = "Faltan campos por llenar.";
        msg.style.display = 'block';
        setTimeout(function(){ msg.style.display = 'none'; }, 5000);
        return false;
    }
    return true;
}

function verificaCodigo() {
    var codigo = $('#codigo').val().trim();
    var id = <?php echo $row['id']; ?>;
    var div = $('#mensajeCodigo');

    div.hide().text('');

    if (codigo === '') return;

    $.ajax({
        url: 'funciones/validar_codigo2.php',
        type: 'POST',
        data: { codigo: codigo, id: id },
        success: function(response) {
            if (response == 1) {
                div.text("El código " + codigo + " ya existe.");
                div.show();
                setTimeout(function(){ div.fadeOut(200); }, 5000);
                $('#codigo').val('');
            }
        }
    });
}
</script>

</body>
</html>
