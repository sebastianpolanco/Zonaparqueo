<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="/zonaDeParqueo/css/logueo.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
  </head>
  <body>
    <div class="login-box">
      <img src="/zonaDeParqueo/img/logo.png" class="logo" alt="Logo">
      <h1>¡Bienvenido!</h1>
      <form id="formLogueo" class="form" action="">
        <label for="usuario">Usuario</label>
        <input type="text" id="usuario" name="usuario" placeholder="Ingrese usuario">
        <label for="contrasena">Contraseña</label>
        <input type="password" id="contrasena" name="contrasena" placeholder="Ingrese contraseña">
        <button type="button" id="ingresar">Ingresar</button>
        <a href="#">¿Olvidaste la contraseña?</a><br>
        <a href="/zonaDeParqueo/vtn/vtnRegistrarUsuario.php">¿Nuevo usuario?</a>
      </form>
      <script type="text/javascript">
        $('#ingresar').click(function(){
          var usuario = document.getElementById('usuario').value;
          var contrasena = document.getElementById('contrasena').value;
          var ruta = "usuario="+usuario+"&contrasena="+contrasena;

          if(usuario.length==0 || contrasena.length==0){
            Swal.fire('Campos Obligatorios', 'Debe llenar todos los campos para ingresar', 'warning')
          }else{
            $.ajax({
                url: '/zonaDeParqueo/eventos/logueo.php',
                type: 'POST',
                data: ruta,
            }).done(function(res){
              $('#respuesta').html(res)
              if(res=="0"){
                Swal.fire('Error', 'Nombre de usuario incorrecto', 'error')
              }
              if(res=="1"){
                location.href="/zonaDeParqueo/vtn/vtnAdminInicio.php";          
              }
              if(res=="2"){
                location.href="/zonaDeParqueo/vtn/vtnVisualizarPuestos.php";          
              }
              if(res=="3"){
                Swal.fire('Error', 'La contraseña es incorrecta', 'error')
              }
            })
          }
        });
      </script>
    </div>
  </body>
  <div id="respuesta"></div>
</html>
