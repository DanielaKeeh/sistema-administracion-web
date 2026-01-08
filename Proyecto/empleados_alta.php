<html>
  <head>
    <title>Formularios</title>
    <script>
        function validar(){
            var nombre = document.Forma01.nombre.value;
            var apellido = document.Forma01.apellido.value;
            var correo = document.Forma01.correo.value;
            var contraseña = document.Forma01.pass.value;
            var role = document.Forma01.rol.value;
            if(correo === '' || contraseña === '' || role === '0' || nombre === '' || apellido === '') {
              alert("Faltan campos por llenar");
            } else {
              alert("Campos llenos");
              document.Forma01.submit();
            }
        }
    </script>
  </head>
  <body>
    Nuevo empleado<br>
    <a href="empleados_lista.php">Regresar</a><br><br>
    <form name="Forma01" method="post" action="empleados_salva.php"  >
            <input style="margin-top:10px"
              type="text"
              name="nombre"
              placeholder="Nombre"
            /><br />

            <input style="margin-top:10px"
              type="text"
              name="apellido"
              placeholder="Apellido"
            /><br />

            <input style="margin-top:10px"
              type="text"
              name="correo"
              value=""
              placeholder="Escribe tu correo"
            /><br />

            <input style="margin-top:10px" 
              type= "password"
              name="pass"
              value=""
              placeholder= "escribe tu contraseña"
            /><br />

            <select style="margin-top:10px" name="rol">
                <option value="0">Selecciona</option>
                <option value="1">Gerente</option>
                <option value="2">Ejecutivo</option>
            </select><br>
            
            <input style="margin-top:10px" onclick="validar(); return false;" type="submit" value="Enviar" />
    </form>
  </body>
</html>
