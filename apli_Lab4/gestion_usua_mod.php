<?php

// PROGRAMA DE MENU ADMINISTRADORES
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
   $id_usu_enc = $_POST["id_usu"];
   $nombre_usuario = $_POST["nombre_completo"];
   $nombre_usuario = str_replace("�","n",$nombre_usuario);
   $nombre_usuario = str_replace("�","N",$nombre_usuario);
   $num_id = $_POST["identificacion"];
   $tipo_usuario = $_POST["tipo_usuario"];
   $direccion = $_POST["direccion"];
   $activo = $_POST["activo"];
   $password = $_POST["passwd"];
   $id_tarjeta = $_POST["id_tarjeta"];
   $login = $_POST["login"];
   $tel = $_POST["telefono"];
   
   $mysqli = new mysqli($host, $user, $pw, $db);
	 $sqlu1 = "UPDATE usuarios set nombre_completo='$nombre_usuario' where id='$id_usu_enc'"; 
   $resultsqlu1 = $mysqli->query($sqlu1);
	 $sqlu2 = "UPDATE usuarios set login='$login' where id='$id_usu_enc'"; 
   $resultsqlu2 = $mysqli->query($sqlu2);
   $sqlu3 = "UPDATE usuarios set identificacion='$num_id' where id='$id_usu_enc'"; 
   $resultsqlu3 = $mysqli->query($sqlu3);
   $sqlu4 = "UPDATE usuarios set tipo_usuario='$tipo_usuario' where id='$id_usu_enc'"; 
   $resultsqlu4 = $mysqli->query($sqlu4);
   $sqlu5 = "UPDATE usuarios set direccion='$direccion' where id='$id_usu_enc'"; 
   $resultsqlu5 = $mysqli->query($sqlu5);
   $sqlu6 = "UPDATE usuarios set id_tarjeta='$id_tarjeta' where id='$id_usu_enc'"; 
   $resultsqlu6 = $mysqli->query($sqlu6);
   $sqlu7 = "UPDATE usuarios set activo='$activo' where id='$id_usu_enc'"; 
   $resultsqlu7 = $mysqli->query($sqlu7);
   $sqlu8 = "UPDATE usuarios set telefono='$tel' where id='$id_usu_enc'"; 
   $resultsqlu8 = $mysqli->query($sqlu8);
   if ($password != "")
     {
     $password_enc = md5($password);
     $sqlu9 = "UPDATE usuarios set passwd='$password_enc' where id='$id_usu_enc'"; 
     $resultsqlu9 = $mysqli->query($sqlu9);
     }
     
   
   if (($resultsqlu1 == 1) && ($resultsqlu2 == 1) && ($resultsqlu3 == 1) && ($resultsqlu4 == 1) && 
       ($resultsqlu5 == 1) && ($resultsqlu6 == 1) && ($resultsqlu7 == 1)&& ($resultsqlu8 == 1)) 
         header('Location: gestion_usuarios.php?mensaje=1');
   else
         header('Location: gestion_usuarios.php?mensaje=2');
   
}

else

{

// Consulta el nombre y dem�s datos del usuario a modificar
   $id_usu_enc = $_GET["id_usu"];
   $mysqli = new mysqli($host, $user, $pw, $db);
   $sqlenc = "SELECT * from usuarios";
   $resultenc = $mysqli->query($sqlenc);
   while($rowenc = $resultenc->fetch_array(MYSQLI_NUM))
    {  
      $id_usu  = $rowenc[0];
      if (md5($id_usu) == $id_usu_enc)
        $id_usu_enc = $id_usu;
    }
   $sql1 = "SELECT * from usuarios where id='$id_usu_enc'";
   $result1 = $mysqli->query($sql1);
   $row1 = $result1->fetch_array(MYSQLI_NUM);
   $nombre_usuario  = $row1[1];
   $tipo_usuario  = $row1[6];
   $num_id = $row1[2];
   $direccion = $row1[3];
   $activo = $row1[8];
   $id_tarjeta = $row1[7];
   $login = $row1[4];
   $tel = $row1[9];


   if ($activo == 1)
      $desc_activo = "S (Activo)";
   else
      $desc_activo = "N (Inactivo)";
      
   $sql3 = "SELECT * from tipo_usuario where id='$tipo_usuario'";
   $result3 = $mysqli->query($sql3);
   $row3 = $result3->fetch_array(MYSQLI_NUM);
   $desc_tipo_usuario = $row3[1];

   ?>         
          <div class="center">
            <form class="card-form" method=POST action="gestion_usua_mod.php">
              <div class="item-form">
                <label >Nombre Usuario</label>
                <input type="text" class="form-control" name=nombre_completo value="<?php echo $nombre_usuario; ?>" required> 
              </div>
              <div class="item-form">
                <label >Identificación</label>
                <input type="number" class="form-control" name=identificacion value="<?php echo $num_id; ?>" required>
              </div>
              <div class="item-form">
                <label >Tipo de Usuario</label>
                <select class="sel-form" name=tipo_usuario required> 
                  <option value="<?php echo $tipo_usuario; ?>"> <?php echo $desc_tipo_usuario; ?></option>  
                  <?php 	
                  $sql6 = "SELECT * from tipo_usuario";
                  $result6 = $mysqli->query($sql6);
                  while($row6 = $result6->fetch_array(MYSQLI_NUM))
                    {
                      $tipo_usuario_con = $row6[0];
                      $desc_tipo_usuario_con = $row6[1];
                      if ($tipo_usuario_con != $tipo_usuario)
                      {
                  ?>   
                      <option value="<?php echo $tipo_usuario_con; ?>"> <?php echo $desc_tipo_usuario_con; ?></option>  
                  <?php
                      }
                    }
                  ?>
                </select>                
              </div>
              <div class="item-form">
                <label >Usuario</label>
                <input type="text" class="form-control"  name=login value="<?php echo $login; ?>" required>  
              </div>
              <div class="item-form">
                <label >Contraseña</label>
                <input type="password" class="form-control" name=passwd value="" placeholder="Deja vacio para no cambiar">  
              </div>
              <div class="item-form">
                <label >Dirección</label>
                <input type="text" class="form-control" name=direccion value="<?php echo $direccion; ?>" required>   
              </div>
              <div class="item-form">
                <label >Telefono</label>
                <input type="text" class="form-control" name=telefono value="<?php echo $tel; ?>" required>   
              </div>
              <div class="item-form">
                <label >Id tarjeta</label>
                <input type="number" class="form-control" name=id_tarjeta min=1 max=9 value="<?php echo $id_tarjeta; ?>" required> 
              </div>
              <div class="item-form">
                <label >Estado</label>
                <select class="sel-form" name=activo required> 
                  <option value="<?php echo $activo; ?>"> <?php echo $desc_activo; ?></option>  
                  <?php
                  $activo_con = 1;
                  $desc_activo_con = "S (Activo)";
                  if ($activo_con != $activo)
                      {
                  ?>   
                      <option value="<?php echo $activo_con; ?>"> <?php echo $desc_activo_con; ?></option>  
                  <?php
                      }
                  else
                      {    
                  ?>
                      <option value="0"> N (Inactivo)</option>  
                  <?php
                      }
                  ?> 
                </select>
              </div>
              <input type="hidden" value="S" name="enviado">
              <input type="hidden" value="<?php echo $id_usu_enc; ?>" name="id_usu">
              <div class=btns-form-wrap>
              <input class="btn-menu" type=submit  value="Modificar" name="Modificar">
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


   
