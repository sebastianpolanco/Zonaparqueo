<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
  <html>
    <head>
      <title> Página de Inicio Sistema de Monitoreo del agua
		  </title>
      <meta charset="utf-8">
      <meta http-equiv="refresh" content="15" />
      <!-- HOJA DE ESTILOS-->
      <link rel="stylesheet" type="text/css" href="assets/css/styles.css"/>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
      <div id="logueo">
        <header id="header_logueo">
          <div class="logueo-wrap">
            <div class="text-center">
              <h1 class="title_logueo">Sistema de Monitoreo del Cloro para Plantas de Tratamiento </h1>
            </div>
          </div>
        </header>      

        <div class="content">
            <section class="card">   
                <h2 class="card-header">Ingreso de Usuarios</h2>

                <form class="card-body" method="POST" action="validar.php">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">User</label>
                    <input type="text" class="form-control" name="login1" require>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="passwd1" required>
                  </div>                  
                  <input type=submit value="Enviar" name="Enviar"> 

                <?php
                  if (isset($_GET["mensaje"]))
                  {
                  $mensaje = $_GET["mensaje"];
                      if ($_GET["mensaje"]!=""){
                ?>
                  <div>
                    <div width="25%" height="20%" align="center" 				
                      bgcolor="#FFCCCC" class="_espacio_celdas_p" 					
                      style="color: #FF0000; 
                    font-weight: bold">
                      <u>Datos Incorrectos:</u>
                    </div>
                    <div width="25%" height="20%" align="center" 				
                      bgcolor="#FFDDDD" class="_espacio_celdas_p" 					
                      style="color: #FF0000; 
                    font-weight: bold">
                      <?php 
                        if ($mensaje == 1)
                          echo "El password del usuario no coincide.";
                        if ($mensaje == 2)
                          echo "No hay usuarios con el login (usuario) ingresado o est� inactivo.";
                        if ($mensaje == 3)
                          echo "No se ha logueado en el Sistema. Por favor ingrese los datos.";
                        if ($mensaje == 4)
                          echo "Su tipo de usuario, no tiene las credenciales suficientes para ingresar a esta opci�n.";
                      ?>                         
                    </div>
                </div>  
                <?php 
                    }
                  }
                ?>

              </form>                
          </section>
        </div>
      </div>
     </body>
   </html>