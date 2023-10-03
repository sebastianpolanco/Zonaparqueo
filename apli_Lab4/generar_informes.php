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
                    <span FACE="arial" SIZE=2 color="#00FFFF"> <u> <a href="cerrar_sesion.php"> Cerrar Sesion </a></u></span>  
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
            <h2>Informe del Cloro</h2>

            <div class="center graphics-wrap">
                
                <div class="graph">
                    <canvas id="myChart" style="position: relative; height: 40vh; width: 80vw;"></canvas>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/moment@^2"></script>
                    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment@^1"></script>

                    <script>
                      var ctx = document.getElementById('myChart')
                      var myChart = new Chart(ctx, {
                          type:'bar',
                          data:{
                              datasets: [{
                                  label: 'Nivel de Cloro',
                                  backgroundColor: ['#6bf1ab','#63d69f', '#438c6c', '#509c7f', '#1f794e', '#34444c', '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3', '#0D47A1'],
                                  borderColor: ['black'],
                                  borderWidth:1
                              }]
                          },
                          options:{
                              scales:{
                                x:{
                                    type:'time',
                                    time:{
                                        unit:'day',
                                    }
                                  },
                                  y:{
                                      beginAtZero:true
                                  }
                              }
                          }
                      })

                      let url = 'http://localhost/apli_Lab4/data_reports.php'
                      fetch(url)
                          .then( response => response.json() )
                          .then( datos => mostrar(datos) )
                          .then(data => console.log(data))
                          .catch( error => console.log(error) )


                      const mostrar = (articulos) =>{
                          articulos.forEach(element => {
                              myChart.data['labels'].push(element.fecha)
                              myChart.data['datasets'][0].data.push(element.nivel_CL)
                              myChart.update()
                          });
                          console.log(myChart.data)
                      } 
                    </script>

                    
                                        
                    
                </div>
                <div class="graph">
                    <iframe src="https://thingspeak.com/channels/805465/charts/2?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&type=line&update=15"></iframe>
                </div>            
                
            <br><br><hr>

            </div>
        </section>
    
    
    
 </body>
</html>