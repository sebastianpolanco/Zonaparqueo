                                                       
<?php

// PROGRAMA DE FINALIZACION DE SESION
                   
  session_start();
  unset($_SESSION["usuario"]); 
  unset($_SESSION["autenticado"]);
  session_destroy();
  header('Location: /zonaDeParqueo/index.php');
?>
