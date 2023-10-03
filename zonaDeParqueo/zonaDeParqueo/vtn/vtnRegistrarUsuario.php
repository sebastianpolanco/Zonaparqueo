<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="/zonaDeParqueo/css/vtnRegistrarUsuario.css">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
  <title>Formulario Registro</title>
</head>
<body>
  <section class="form-registrar">
    <h4>Formulario De Registro</h4>
    <form id="formRegistro" class="form" action="/zonaDeParqueo/vtn/vtnRegistrarUsuario.php" method="POST">
      <input type="text" name="nombreUsuario" id="nombreUsuario" placeholder="Ingrese Nombre de Usuario">
      <input type="text" name="nombre" id="nombre" placeholder="Ingrese su Nombre">
      <input type="text" name="apellido" id="apellido" placeholder="Ingrese su Apellido">
      <input type="password" name="contrasena" id="contrasena" placeholder="Ingrese su Contraseña">
      <p>Estoy de acuerdo con <a href="#">Terminos y Condiciones</a></p>
      <button type="button" id="registrar" name="registrar">Registrar</button>
      <p><a href="/zonaDeParqueo/index.php">¿Ya tengo Cuenta?</a></p>
    </form>
    <?php
      if(isset($_POST["registrar"])){
        $contrasena = $_POST['contrasena'];
        $contrasenaCD = md5($contrasena);
      }
    ?>
    <script src="/zonaDeParqueo/js/md5.js"></script>
    <script type="text/javascript">
        $('#registrar').click(function(){
          var nombreUsuario = document.getElementById('nombreUsuario').value;
          var nombre = document.getElementById('nombre').value;
          var apellido = document.getElementById('apellido').value;
          var contrasena = document.getElementById('contrasena').value;
          var ruta = "nombreUsuario="+nombreUsuario+"&nombre="+nombre+"&apellido="+apellido+"&contrasena="+contrasena;

          if(nombreUsuario.length==0 || nombre.length==0 || apellido.length==0 || contrasena.length==0){
            Swal.fire('Campos Obligatorios', 'Debe llenar todos los campos para ingresar', 'warning')
          }else{
            //var contrasenaCD = md5(contrasena);
            var contrasenaCD = '<?$contrasenaCD?>';
            $.ajax({
                url: '/zonaDeParqueo/eventos/registrarUsuario.php',
                type: 'POST',
                data: ruta,
            }).done(function(res){
              $('#respuesta').html(res)
              if(res=="0"){
                Swal.fire('Registro de Usuario', 'El nombre de usuario ya existe', 'warning')
              }
              if(res=="1"){
                Swal.fire({
                      title: '¡Bienvenido!',
                      icon: 'question',
                      backdrop: true,
                      text: '¿Deseas Iniciar Sesión?',
                      showConfirmButton:  true,
                      confirmButtonText: "Aceptar",
                      confirmButtonColor: "#24B379",
                      showCancelButton: true,
                      cancelButtonText: "Cancelar",
                      cancelButtonColor: "#C92B43",
                      closeOnConfirm: true,
                      timer: 20000
                }).then((result) => {
                    if (result.isConfirmed) {
                      $.ajax({
                        url: '/zonaDeParqueo/eventos/logueo.php',
                        type: 'POST',
                        data: 'usuario='+nombreUsuario+'&contrasena='+contrasena, 
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
                      //location.href="/zonaDeParqueo/index.php";
                    }else{
                      location.reload();
                    }
                })       
              }
              if(res=="2"){
                Swal.fire('Registro de Usuario', 'La contraseña es incorrecta', 'error')
              }
            })
          }
        });
      </script>
  </section>
</body>
</html>
