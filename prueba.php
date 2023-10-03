<?php
  include "../eventos/conexion.php";  
  $mysqli = new mysqli($host, $user, $pw, $db); 
  session_start();
  if ($_SESSION["autenticado"] != "SIx5"){
    header('Location: index.php');
  }
  $idUsuario = $_SESSION['idUsuario'];
  $usuario = $_SESSION['usuario'];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01  Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

    <head>
      <title>Zona De Parqueo</title>
      <meta charset="utf-8">
      <meta http-equiv="refresh" content="30"/>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
      <script src="/zonaDeParqueo/js/vtnVisualizarPuestos.js"></script>
      <link rel="stylesheet" type="text/css" href="/zonaDeParqueo/css/menu.css">

      <style type="text/css">
#container {
    height: 400px;
}

.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

    </style>


    </head>

    <body>

      <script src="../../code/highcharts.js"></script>
      <script src="../../code/modules/exporting.js"></script>
      <script src="../../code/modules/export-data.js"></script>
      <script src="../../code/modules/accessibility.js"></script>

      

      <ul class="menu">
        <li><a href="vtnAdminInicio.php">Inicio</a></li>
        <li><a href="#">Gestion Usuarios</a></li>
        <li><a href="#">Informes</a></li>
        <li><a href="#">Estadisticas</a></li>
        <li><a href="#">Opcion 4</a></li>
        <li><a href="#">Acerca De</a></li>
        <li class="item_sesion"><a href="/zonaDeParqueo/eventos/cerrarSesion.php">Cerrar Sesión</a></li>
        <li class="item_sesion"><a href="#"><?php echo $usuario;?></a>
        </li>
      </ul>

       <table width="80%" align=center cellpadding=5 border=1 bgcolor="FFFFFF" class="tabla">
       <tr>
         <td valign="top" align=center width=80& colspan=7 class="tdima">
           <img src="/zonaDeParqueo/img/SmartParking.jpg" width=1050 height=250>
         </td>
       </tr>
       <tr>
         <td valign="top" align=center width=80 height=30 colspan=7 class="tdima">
           <h1> <font color=white>Grafica de estados por dia</font></h1>
         </td>
       </tr>


       <?php
      if ((isset($_POST["enviado"])))
         {

          $dia=$_POST['dia'];

          $mysqli = new mysqli($host, $user, $pw, $db);

          $sql1 = "SELECT * from registros where fecha = '$dia'"; 
           
          $result1 = $mysqli->query($sql1);

          //estado
            $sql = "SELECT estado from registros where hora >= '12:00' and hora <= '24:00' and zona = '1' and puesto = '1' GROUP BY HOUR(fecha) ORDER BY fecha";
            $zona11= mysqli_query($mysqli,$sql);
            $zona11= mysqli_fetch_all($zona11,MYSQLI_ASSOC);
            $zona11 = json_encode(array_column($zona11, 'count'),JSON_NUMERIC_CHECK);

            $sql = "SELECT estado from registros where hora >= '12:00' and hora <= '24:00' and zona = '1' and puesto = '2' GROUP BY HOUR(fecha) ORDER BY fecha";
            $zona12= mysqli_query($mysqli,$sql);
            $zona12= mysqli_fetch_all($zona12,MYSQLI_ASSOC);
            $zona12 = json_encode(array_column($zona12, 'count'),JSON_NUMERIC_CHECK);

            $sql = "SELECT estado from registros where hora >= '12:00' and hora <= '24:00' and zona = '2' and puesto = '1' GROUP BY HOUR(fecha) ORDER BY fecha";
            $zona21= mysqli_query($mysqli,$sql);
            $zona21= mysqli_fetch_all($zona21,MYSQLI_ASSOC);
            $zona21 = json_encode(array_column($zona21, 'count'),JSON_NUMERIC_CHECK);

            $sql = "SELECT estado from registros where hora >= '12:00' and hora <= '24:00' and zona = '2' and puesto = '2' GROUP BY HOUR(fecha) ORDER BY fecha";
            $zona22= mysqli_query($mysqli,$sql);
            $zona22= mysqli_fetch_all($zona22,MYSQLI_ASSOC);
            $zona22 = json_encode(array_column($zona22, 'count'),JSON_NUMERIC_CHECK);

          ?>
          <tr>
         <td valign="top" align=center bgcolor="#E1E1E1" colspan=6>
            <b>Dia :  <?php echo $dia; ?></b>
         </td>
         </tr>

         <script type="text/javascript">

    $(function () { 

    var data_zona11 = <?php echo $zona11; ?>;
    var data_zona12 = <?php echo $zona12; ?>;
    var data_zona21 = <?php echo $zona21; ?>;
    var data_zona22 = <?php echo $zona22; ?>;

    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Estado de las zonas desde las 12 pm a 12 am '
        },
        xAxis: {
            categories: ['12 pm', '1 pm','2 pm','3 pm','4 pm', '5 pm','6 pm','7 pm','8 pm', '9 pm','10 pm','11 pm', '12 am']
        },
        yAxis: {
            title: {
                min: 0,
        title: {
            text: 'estado'
        },
        stackLabels: {
            enabled: true,
            style: {
                fontWeight: 'bold',
                color: ( // theme
                    Highcharts.defaultOptions.title.style &&
                    Highcharts.defaultOptions.title.style.color
                ) || 'gray'
            }
            }
        },
        tooltip: {
        headerFormat: '<b>{point.x}</b><br/>',
        pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
        column: {
            stacking: 'normal',
            dataLabels: {
                enabled: true
            }
          }
        },
        series: [{
            name: 'zona 1 puesto 1',
            data: data_zona11
        }, {
            name: 'zona 1 puesto 2',
            data: data_zona12
        },{
            name: 'zona 2 puesto 1 ',
            data: data_zona21
        },{
            name: 'zona 2 puesto 2',
            data: data_zona22
        }]
    });
});

         </script>

                 
    

      <?php
         
 

     // FIN DEL IF, si ya se han recibido las fechas del formulario
          }

      else
      {
      ?>

      </table>     
    <table width="80%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
     <form method=POST action="vtnVisualizarGrafica.php">
         <tr>   
            <td bgcolor="#000000" align=center> 
                  <font FACE="arial" SIZE=2 color="#FFFFFF"> <b>Dia:</b></font>  
                  //dia * zona y estado  
                  //3 columnas de color /column-stacked/
                  </td> 
                  <td bgcolor="#000000" align=center> 
                    <input type="date" name="dia" value="" required>  
          </td> 
         </tr>
         
       <tr> 
                  <td bgcolor="#000000" align=center colspan=2> 
                    <input type="hidden" name="enviado" value="1">  
                    <input type="submit" value="GENERAR GRAFICO" name="GENERAR GRAFICO">  
          </td> 
         </tr>
      </form>     

<?php
    } 
?>    


       </table>

    <body>
<html>