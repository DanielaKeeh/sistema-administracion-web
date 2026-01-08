<?php
require "funciones/conecta.php";
$con = conecta();
$sql = "SELECT id,nombre,correo,rol FROM empleados WHERE eliminado = 0";
$res = $con->query($sql);
$num = $res ? $res->num_rows : 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Lista de empleados</title>
<link rel="stylesheet" href="style.css">
<script src="js/jquery-3.3.1.min.js"></script>
<script>
function borrar(id){
    if(confirm('¿Quieres eliminar este empleado?')){
        $.ajax({
            url:'empleados_elimina.php',
            type:'POST',
            data:{id:id},
            success:function(r){
                if(r==="1"){ $('#fila_'+id).remove(); }
                else{ alert('Error'); }
            },
            error:function(){ alert('Error'); }
        });
    }
}
</script>
</head>
<body>
<div class="page">
  <h1 class="titulo">Lista de empleados (<?php echo $num; ?>)</h1>
  <div class="tabla">
    <div class="fila encabezado">
      <div>ID</div>
      <div>Nombre</div>
      <div>Correo</div>
      <div>Rol</div>
      <div>Ver</div>
      <div>Editar</div>
      <div>Eliminar</div>
    </div>
    <?php if($res){ while($row = $res->fetch_assoc()){ ?>
    <div class="fila" id="fila_<?php echo $row['id']; ?>">
      <div><?php echo $row["id"]; ?></div>
      <div><?php echo htmlspecialchars($row["nombre"]); ?></div>
      <div><?php echo htmlspecialchars($row["correo"]); ?></div>
      <div><?php echo ($row["rol"]==1)?"Gerente":"Ejecutivo"; ?></div>
      <div><a href="#"><img src="img2/ojo.svg" class="icono" alt=""></a></div>
      <div><a href="#"><img src="img2/lupa.svg" class="icono" alt=""></a></div>
      <div><a href="#" onclick="borrar(<?php echo (int)$row['id']; ?>)"><img src="img2/bote.svg" class="icono" alt=""></a></div>
    </div>
    <?php } } ?>
    <div class="fila crear">
      <div class="crear_full">
        <a class="btn_crear" href="empleados_alta.php">Crear nuevo registro</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>
