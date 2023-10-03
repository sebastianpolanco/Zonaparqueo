<?php

// PROGRAMA DE MENU ADMINISTRADOR
include "conexion.php";
                                                 
session_start();
if ($_SESSION["autenticado"] != "SIx3")
    {
      header('Location: index.php?mensaje=3');
    }
else
    {      
        $mysqli = new mysqli($host, $user, $pw, $db);
  	    $sqlusu = "SELECT * from tipo_usuario where id='1'"; //CONSULTA EL TIPO DE USUARIO CON ID=1, ADMINISTRADOR
        $resultusu = $mysqli->query($sqlusu);
        $rowusu = $resultusu->fetch_array(MYSQLI_NUM);
  	    $desc_tipo_usuario = $rowusu[1];
        if ($_SESSION["tipo_usuario"] != $desc_tipo_usuario)
          header('Location: index.php?mensaje=4');
    }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
     <html>
       <head>
           <title> Gestion De Usuarios </title>
           <link rel="stylesheet" type="text/css" href="assets/css/styles.css"/>
           <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        </head>
       <body>
        <header id="header">
            <nav class="navbar">
              <h1 class="title">Sistema de Monitoreo del Cloro para Plantas de Tratamiento </h1>                   
              <div class="user-wrap">
                    <span FACE="arial" SIZE=2 color="#000000"> <u><?php  echo "Nombre Usuario</u>:   ".$_SESSION["nombre_usuario"];?> </span><br>
                    <span FACE="arial" SIZE=2 color="#000000"> <u><?php  echo "Tipo Usuario</u>:   ".$desc_tipo_usuario;?> </span><br>  
                    <span FACE="arial" SIZE=2 color="#00FFFF"> <u> <a  href="cerrar_sesion.php"> Cerrar Sesion </a></u></span>  
              </div>
            </nav>
            <menu>
            <?php
              include "menu_admin.php";
            ?>
            </menu>   
            <!-- Limpiar el float-->
            <div class="clearfix"></div>        
        </header>
        <section class="content">
          <h2>Gestión de usuarios</h2>
<?php

if ((isset($_POST["enviado"])))
  {
   //echo "grabar cambios modificaci�n";
   $nombre_usuario = $_POST["nombre_completo"];
   $nombre_usuario = str_replace("�","n",$nombre_usuario);
   $nombre_usuario = str_replace("�","N",$nombre_usuario);
   $num_id = $_POST["identificacion"];
   $tipo_usuario = $_POST["tipo_usuario"];
   $direccion = $_POST["direccion"];
   $tel = $_POST["telefono"];
   $login = $_POST["login"];
   $activo = $_POST["activo"];
   $password = $_POST["passwd"];
   $id_tarjeta = $_POST["id_tarjeta"];
   $password_enc = md5($password);
   $mysqli = new mysqli($host, $user, $pw, $db);
   $sqlcon = "SELECT * from usuarios where identificacion='$num_id'";
   $resultcon = $mysqli->query($sqlcon);
   $rowcon = $resultcon->fetch_array(MYSQLI_NUM);
   $numero_filas = $resultcon->num_rows;
  
   if ($numero_filas > 0){     
         header('Location: gestion_usuarios.php?mensaje=5');
     }
   else
    {
      $sql = "INSERT INTO usuarios(tipo_usuario, nombre_completo, identificacion, passwd, direccion, telefono, login, activo, id_tarjeta) 
      VALUES ('$tipo_usuario','$nombre_usuario','$num_id','$password_enc','$direccion','$tel','$login','$activo','$id_tarjeta')";
      //echo "sql es...".$sql;
      $result1 = $mysqli->query($sql);      
      if ($result1 == 1){
          header('Location: gestion_usuarios.php?mensaje=3');
        }
      else
         header('Location: gestion_usuarios.php?mensaje=4');      
    }
}
else{
   ?>
        <div class="center">
          <form class="card-form" method=POST action="gestion_usua_add.php">
            <div class="item-form">
              <label >Nombre Usuario</label>
              <input type="text" class="form-control" name=nombre_completo value="" required> 
            </div>
            <div class="item-form">
              <label >Identificación</label>
              <input type="number" class="form-control" name=identificacion value="" required>
            </div>
            <div class="item-form">
                <label >Tipo de Usuario</label>
                <select class="sel-form" name=tipo_usuario required> 
                <?php 	
                  $sql6 = "SELECT * from tipo_usuario order by id DESC";
                  $result6 = $mysqli->query($sql6);
                  while($row6 = $result6->fetch_array(MYSQLI_NUM))
                    {
                      $tipo_usuario_con = $row6[0];
                      $desc_tipo_usuario_con = $row6[1];
                ?>   
                    <option value="<?php echo $tipo_usuario_con; ?>"> <?php echo $desc_tipo_usuario_con; ?></option>  
                <?php
                  }
                ?>       
                </select>       
              </div>
              <div class="item-form">
                <label >Usuario</label>
                <input type="text" class="form-control"  name=login value="" required>  
              </div>
              <div class="item-form">
                <label >Contraseña</label>
                <input type="password" class="form-control" name=passwd value="" placeholder="Ingresa una contraseña segura">  
              </div>
              <div class="item-form">
                <label >Dirección</label>
                <input type="text" class="form-control" name=direccion value="" required>   
              </div>
              <div class="item-form">
                <label >Telefono</label>
                <input type="text" class="form-control" name=telefono value="" required>   
              </div>
              <div class="item-form">
                <label >Id tarjeta</label>
                <input type="number" class="form-control" name=id_tarjeta min=1 max=9 value="" required> 
              </div>
              <div class="item-form">
                <label >Estado</label>
                <select class="sel-form" name=activo required> 
                  <option value="1"> S (Activo)</option>  
                  <option value="0"> N (Inactivo)</option> 
                </select>
              </div>
              <input type="hidden" value="S" name="enviado">
                <div class=btns-form-wrap>
                  <input class="btn-menu" type=submit value="Guardar" name="Modificar">
                <form method=POST action="gestion_usuarios.php">                   
                    <input class="btn-menu" type=submit  value="Volver" name="Volver">              
                </form> 
              </div>

            </form> 
          </div> 
<?php
 }
?>        
       </body>
      </html>


   

