
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


    // Recoge los datos para el gráfico de temperatura
    
	$sql = "SELECT MAX(temperatura) as count FROM datos_medidos
			GROUP BY DAY(fecha) ORDER BY fecha";
	$tempe = mysqli_query($mysqli,$sql);
    $tempe = mysqli_fetch_all($tempe,MYSQLI_ASSOC);
	$tempe = json_encode(array_column($tempe, 'count'),JSON_NUMERIC_CHECK);
    

	// Recoge los datos para el gráfico de humedad 
    
	$sql = "SELECT MAX(humedad) as count FROM datos_medidos
			GROUP BY DAY(fecha) ORDER BY fecha";
	$hume = mysqli_query($mysqli,$sql);
	$hume = mysqli_fetch_all($hume,MYSQLI_ASSOC);
	$hume = json_encode(array_column($hume, 'count'),JSON_NUMERIC_CHECK);
    $category[0] = "febrero 13 de 2019";
    $category[1] = "febrero 14 de 2019";
    $category[2] = "febrero 15 de 2019";
    
    

    ?>


    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
     <html>
       <head>
           <title> Generar Informes</title>
           	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
	        <script src="https://code.highcharts.com/highcharts.js"></script>
       </head>
       <body>

        <script type="text/javascript">

        $(function () { 

            var data_tempe = <?php echo $tempe; ?>;
            var data_hume = <?php echo $hume; ?>;

            $('#container').highcharts({
                chart: {
                type: 'line'
                },
                title: {
                text: 'Temperatura y Humedad promedio por dia'
                },
                xAxis: {
                categories: ['<?php echo $category[0]?>','<?php echo $category[1]?>','<?php echo $category[2]?>']
                },
                yAxis: {
                title: {
                text: 'Dia'
                }
                },
            series: [{
            name: 'Temperatura',
            data: data_tempe
            }, {
            name: 'Humedad',
            data: data_hume
             }]
            });
           });

        </script>

        <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
    	   <tr>
           <td valign="top" align=left width=70%>
              <table width="100%" align=center border=0>
            	   <tr>
                  <td valign="top" align=center width=30%>
                     <img src="img/invernadero.jpg" border=0 width=350 height=80> 
             	    </td>
                  <td valign="top" align=center width=60%>
                     <h1><font color=green>Sistema de Invernadero Automatizado </font></h1>
             	    </td>
           	    </tr>
         	    </table>
           </td>
           <td valign="top" align=right>
              <font FACE="arial" SIZE=2 color="#000000"> <b><u><?php  echo "Nombre Usuario</u>:   ".$_SESSION["nombre_usuario"];?> </b></font><br>
              <font FACE="arial" SIZE=2 color="#000000"> <b><u><?php  echo "Tipo Usuario</u>:   ".$desc_tipo_usuario;?> </b></font><br>  
              <font FACE="arial" SIZE=2 color="#00FFFF"> <b><u> <a href="cerrar_sesion.php"> Cerrar Sesion </a></u></b></font>  

           </td>
	     </tr>
     </table>
    <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
    <?php
    include "menu_admin.php";
    ?>
 	    <tr valign="top">
         <td height="20%" align="left" 				
            bgcolor="#FFFFFF" class="_espacio_celdas" 					
            style="color: #FFFFFF; 
            font-weight: bold">
    		    <font FACE="arial" SIZE=2 color="#000044"> <b><h1>Generar Informes</h1></b></font>  
	       </td>
         <td height="20%" align="right" 				
             bgcolor="#FFFFFF" class="_espacio_celdas" 					
             style="color: #FFFFFF; 
            font-weight: bold">
    			  <img src="img/generar_informes.jpg" border=0 width=115 height=115>    
		     </td>
	    </tr>
	  </table>
    <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
      <tr>
       <td align=left width=50%>

    <div class="container">
	   <br>
	       <h2 class="text-center">Ejemplo de gr&aacute;fico de informe (Generado por la librer&iacute;a High Charts)</h2>
                <div class="row">
                <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                <div class="panel-heading">Panel</div>
                <div class="panel-body">
                <div id="container"></div>
                </div>
                </div>
                </div>
                </div>
    </div>

      </td>

      </tr>
    </table>
<br><br><hr>
    
 </body>
</html>


   
