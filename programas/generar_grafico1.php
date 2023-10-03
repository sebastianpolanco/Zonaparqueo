<?php

include ("conexion.php");
    $mysqli = new mysqli($host, $user, $pw, $db);

    

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01    Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
     
<html>
<head>
    <title>Grafico max y min</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
</head>
<body>


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
         </tr>
     </table>


     <tr valign="top">
        <td height="20%" align="left" bgcolor="#FFFFFF" class="_espacio_celdas" style="color: #FFFFFF; font-weight: bold">
                <font FACE="arial" SIZE=2 color=green> <b><h1>Graficar datos medidos (por rango de fechas)</h1></b></font>  

               </td>
    </tr>
<?php
if ((isset($_POST["enviado"])))
         {
           $fecha_ini=$_POST['fecha_ini'];
           $fecha_final=date("Y-m-d",strtotime($fecha_ini."+ 7 days"));

           $mysqli = new mysqli($host, $user, $pw, $db);

           $sql1 = "SELECT * from datos_medidos where fecha >= '$fecha_ini' and fecha<= '$fecha_final'"; 
           
      $result1 = $mysqli->query($sql1);


      //MAXIMOS
            $sql = "SELECT MAX(temperatura) as count FROM datos_medidos where fecha >= '$fecha_ini' and fecha<= '$fecha_final'
                 GROUP BY DAY(fecha) ORDER BY fecha";
            $MAXT = mysqli_query($mysqli,$sql);
            $MAXT = mysqli_fetch_all($MAXT,MYSQLI_ASSOC);
            $MAXT = json_encode(array_column($MAXT, 'count'),JSON_NUMERIC_CHECK);

            /* Getting demo_click table data */
            $sql = "SELECT MAX(humedad) as count FROM datos_medidos where fecha >= '$fecha_ini' and fecha<= '$fecha_final'
                    GROUP BY DAY(fecha) ORDER BY fecha";
            $MAXH = mysqli_query($mysqli,$sql);
            $MAXH = mysqli_fetch_all($MAXH,MYSQLI_ASSOC);
            $MAXH = json_encode(array_column($MAXH, 'count'),JSON_NUMERIC_CHECK);

    //MINIMOS
            $sql = "SELECT MIN(temperatura) as count FROM datos_medidos where fecha >= '$fecha_ini' and fecha<= '$fecha_final'
                 GROUP BY DAY(fecha) ORDER BY fecha";
            $MINT = mysqli_query($mysqli,$sql);
            $MINT = mysqli_fetch_all($MINT,MYSQLI_ASSOC);
            $MINT = json_encode(array_column($MINT, 'count'),JSON_NUMERIC_CHECK);
            
            // Los datos generados a traves del json_enconde les quedan como se presenta abajo en comentarios:
            //$viewer = "[8,5,5]";
            
            /* Getting demo_click table data */
            $sql = "SELECT MIN(humedad) as count FROM datos_medidos where fecha >= '$fecha_ini' and fecha<= '$fecha_final'
                    GROUP BY DAY(fecha) ORDER BY fecha";
            $MINH = mysqli_query($mysqli,$sql);
            $MINH = mysqli_fetch_all($MINH,MYSQLI_ASSOC);
            $MINH = json_encode(array_column($MINH, 'count'),JSON_NUMERIC_CHECK);

    $category[0] = $fecha_ini;
    $category[1] = date("Y-m-d",strtotime($fecha_ini."+ 1 days"));
    $category[2] = date("Y-m-d",strtotime($fecha_ini."+ 2 days"));
    $category[3] = date("Y-m-d",strtotime($fecha_ini."+ 3 days"));
    $category[4] = date("Y-m-d",strtotime($fecha_ini."+ 4 days"));
    $category[5] = date("Y-m-d",strtotime($fecha_ini."+ 5 days"));
    $category[6] = date("Y-m-d",strtotime($fecha_ini."+ 6 days"));
    $category[7] = date("Y-m-d",strtotime($fecha_ini."+ 7 days"));
    
?>
      <tr>
         <td valign="top" align=center bgcolor="#E1E1E1" colspan=6>
            <b>Rango de fechas consultado: desde <?php echo $fecha_ini; ?> hasta <?php echo $fecha_final; ?></b>
         </td>
         </tr>

         <?php

         //while($row1 = $result1->fetch_array(MYSQLI_NUM))
         //{
           // $temperatura=$row1[0];
            //$humedad=$row1[1];
            
            
      
?>
    
     <script type="text/javascript">





$(function () { 

    var data_MAXT = <?php echo $MAXT; ?>;
    var data_MAXH = <?php echo $MAXH; ?>;
    var data_MINT = <?php echo $MINT; ?>;
    var data_MINH = <?php echo $MINH; ?>;

    $('#container').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'Rango de Temperatura y Humedad promedio por dia '
        },
        xAxis: {
            categories: ['<?php echo $category[0]?>','<?php echo $category[1]?>','<?php echo $category[2]?>','<?php echo $category[3]?>','<?php echo $category[4]?>','<?php echo $category[5]?>','<?php echo $category[6]?>']
        },
        yAxis: {
            title: {
                text: 'valor'
            }
        },
        series: [{
            name: 'Temperatura max',
            data: data_MAXT
        }, {
            name: 'Temperatura min',
            data: data_MINT
        },{
            name: 'Humedad max',
            data: data_MAXH
        },{
            name: 'Humedad min',
            data: data_MINH
        }]
    });
});


</script>

<div class="container">
    <br/>
    <h2 class="text-center">Temperatura y la humedad más altas y bajas por día</h2>
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
         
                 
<?php
         
 

     // FIN DEL IF, si ya se han recibido las fechas del formulario
   }

else
    {
?>    
    </table>     
    <table width="70%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
     <form method=POST action="generar_grafico1.php">
         <tr>   
            <td bgcolor="#CCEECC" align=center> 
                  <font FACE="arial" SIZE=2 color="#004400"> <b>Fecha Inicial:</b></font>  
                  </td> 
                  <td bgcolor="#EEEEEE" align=center> 
                    <input type="date" name="fecha_ini" value="" required>  
          </td> 
         </tr>
         
       <tr> 
                  <td bgcolor="#EEEEEE" align=center colspan=2> 
                    <input type="hidden" name="enviado" value="1">  
                    <input type="submit" value="GENERAR GRAFICO" name="GENERAR GRAFICO">  
          </td> 
         </tr>
      </form>     

<?php
    } 
?>    


       </table>

</body>
</html>      