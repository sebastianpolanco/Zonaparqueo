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
    
    // Termina c�digo php para validaciones.

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

          <div class="center">      

            <form action="gestion_usuarios.php" method="POST">

              <div class="consults-warp">

                <div class="consult">
                  <span>Consul. por Identif.: <input type="number" name=id_con value=""></span>
                </div>   
                <div class="consult">
                  <span >Consul. por Nombre: <input type="text" name=nombre_con value=""></span>
                </div> 
                <div class="consult">
                  <span FACE="arial" SIZE=2 color="#000000">Estado Usuario: 
                    <select name=estado>
                    <?php
                      if (isset($_POST["estado"]))
                        {
                          $estado = $_POST["estado"];
                          if ($_POST["estado"]!="")
                            {  
                              if ($estado == "2")
                              {
                                echo "<option value=".$estado."> Todos los Usuarios</option>";
                                echo "<option value=1> Usuarios solo Activos</option>";
                                echo "<option value=0> Usuarios solo Inactivos</option>";
                              }
                              else if ($estado == "1")
                              {
                                echo "<option value=".$estado."> Usuarios solo Activos</option>";
                                echo "<option value=2> Todos los Usuarios</option>";
                                echo "<option value=0> Usuarios solo Inactivos</option>";
                              }
                              else if ($estado == "0")
                              { 
                                echo "<option value=".$estado."> Usuarios solo Inactivos</option>";
                                echo "<option value=2> Todos los Usuarios</option>";
                                echo "<option value=1> Usuarios solo Activos</option>";
                              }
                            }  
                        }
                        else
                        {
                          ?>
                            <option value=2> Todos los Usuarios</option>
                            <option value=1> Usuarios solo Activos </option>
                            <option value=0> Usuarios solo Inactivos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                        <?php
                        }
                        ?>  
                    </select></span>           
                </div>     
                <div class="consult">
                  <span><input class="btn-menu" type="submit" name=Consultar value="Consultar"></span>              
                  <input  type="hidden" value="1" name="enviado">
                </div>     
              </div>
                
            </form>    
      
     <?php
      if (isset($_GET["mensaje"]))
      {
        $mensaje = $_GET["mensaje"];
        if ($_GET["mensaje"]!=""){?>
      
  		     <tr>
             <td> </td>
             <td height="20%" align="left">
                  <table width=60% border=1>
                   <tr>
                    <?php 
                       if ($mensaje == 1)
                         echo "<td bgcolor=#DDFFDD class=_espacio_celdas_p 					
                    style=color: #000000; font-weight: bold >Usuario actualizado correctamente.";
                       if ($mensaje == 2)
                         echo "<td bgcolor=#FFDDDD class=_espacio_celdas_p 					
                    style=color: #000000; font-weight: bold >Usuario no fue actualizado correctamente.";
                       if ($mensaje == 3)
                         echo "<td bgcolor=#DDFFDD class=_espacio_celdas_p 					
                    style=color: #000000; font-weight: bold >Usuario creado correctamente.";
                       if ($mensaje == 4)
                         echo "<td bgcolor=#FFDDDD class=_espacio_celdas_p 					
                    style=color: #000000; font-weight: bold >Usuario no fue creado. Se present� un inconveniente";
                       if ($mensaje == 5)
                         echo "<td bgcolor=#FFDDDD class=_espacio_celdas_p 					
                    style=color: #000000; font-weight: bold >Usuario no fue creado. Ya existe usuario con la misma c�dula.";
                      ?>
                    </td>
                   </tr>
                  </table>
              </td>
    		     </tr>
           <?php
            }
           }   
            ?>                         

	  	     <tr>
                  <td colspan=2 height="20%" align="left" 				
                    bgcolor="#FFFFFF" class="_espacio_celdas" 					
                    style="color: #FFFFFF; 
			             font-weight: bold">
    
    <div class="table-wrap">
    <table class="table-users" >
			<tr class="titles-table">	
				<td> 
				  <span>Nombre Usuario</span>  
				</td>	
				<td> 
				  <span> N&uacute;mero Id</span>  
				</td> 	
				<td> 
				  <span> Direcci&oacute;n</span>  
				</td> 	
        <td> 
				  <span> Telefono</span>  
				</td> 	
				<td> 
				  <span> Usuario</span>  
				</td>
				<td> 
				  <span> Tipo Usuario</span>  
				</td>
				<td> 
				  <span> Id Tarjeta</span>  
				</td>
				<td> 
				  <span> Activo (S/N)</span>  
				</td>
   	    <td> 
				  <span> Modificar</span>  
				</td>
			</tr>
				  
<?php
         $mysqli = new mysqli($host, $user, $pw, $db);
		     if ((isset($_POST["enviado"])))
         {
           $id_con = $_POST["id_con"];
           $nombre_con = $_POST["nombre_con"];
           $estado = $_POST["estado"];
           $sql1 = "SELECT * from usuarios order by nombre_completo";
           if (($id_con == "") and ($nombre_con == ""))
             {
              if ($estado != "2")
                $sql1 = "SELECT * from usuarios where activo='$estado' order by nombre_completo";
             }
           if (($id_con != "") and ($nombre_con == ""))
             {
              if ($estado == "2")
                $sql1 = "SELECT * from usuarios where identificacion='$id_con'";
              else
                $sql1 = "SELECT * from usuarios where identificacion='$id_con' and activo='$estado'";
             }
           if (($id_con == "") and ($nombre_con != ""))
             {
              if ($estado == "2")
                $sql1 = "SELECT * from usuarios where nombre_completo LIKE '%$nombre_con%' order by nombre_completo";
              else
                $sql1 = "SELECT * from usuarios where nombre_completo LIKE '%$nombre_con%' and activo='$estado' order by nombre_completo";
              }
           if (($id_con != "") and ($nombre_con != ""))
             {
              if ($estado == "2")
                 $sql1 = "SELECT * from usuarios where nombre_completo LIKE '%$nombre_con%' and identificacion='$id_con'";
              else
                $sql1 = "SELECT * from usuarios where nombre_completo LIKE '%$nombre_con%' and identificacion='$id_con' and activo='$estado'";
             }      
          }
         else
             $sql1 = "SELECT * from usuarios order by nombre_completo";
             
         //echo "sql1 es...".$sql1;
         echo "<script>console.log('$sql1');</script>";
         $result1 = $mysqli->query($sql1);
         
         while($row1 = $result1->fetch_array(MYSQLI_NUM))
         {
		   $id_usu  = $row1[0];
		   $id_usu_enc = md5($id_usu);
		   $nombre_usuario  = $row1[1];
	       $num_id = $row1[2];
	       $direccion = $row1[3];
	       $usuario= $row1[4];
           $tipo_usuario  = $row1[6];
           $id_tarjeta = $row1[7];
	       $activo= $row1[8];
         $tel = $row1[9];
			    if ($activo == 1)
				    $desc_activo = "Si";
			    else
				    $desc_activo = "No";

     	   $sql3 = "SELECT * from tipo_usuario where id='$tipo_usuario'";
           $result3 = $mysqli->query($sql3);
           $row3 = $result3->fetch_array(MYSQLI_NUM);
			    $desc_tipo_usuario = $row3[1];

?>
		
		        <tr class="datos-content">	
				<td> 
				  <span>  <?php echo $nombre_usuario; ?></span>  
				</td>	
				<td> 
				  <span> <?php echo $num_id; ?></span>  
				</td>	
				<td> 
				  <span> <?php echo $direccion; ?></span>  
				</td> 
        <td> 
				  <span> <?php echo $tel; ?></span>  
				</td> 	
				<td> 
				  <span> <?php echo $usuario; ?></span>  
				</td>
				<td> 
				  <span> <?php echo $desc_tipo_usuario; ?></span>  
				</td>
				<td> 
				  <span> <?php echo $id_tarjeta; ?></span>  
				</td>
				<td> 
				  <span> <?php echo $desc_activo; ?></span>  
				</td>
        <td> 
				  <span> <a href="gestion_usua_mod.php?id_usu=<?php echo $id_usu_enc; ?>"> <img src="img/icono_editar.jpg" border=0 width=40 height=30></a></span>  
				</td>
	     </tr>
		     
	     	         
<?php
			   }
?>


                  </table>
                    <a class="btn-menu btn-agregar" href="gestion_usua_add.php">Agregar Nuevo Usuario </a>  
                  


    </div>
     
                    
                  
        
<br><br><hr>
                  </td>
                </tr>  
        </div>

        </section>       
        
    
    
        
       </body>
      </html>


   
