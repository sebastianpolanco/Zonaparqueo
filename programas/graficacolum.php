<?php
include ("conexion.php");
    $mysqli = new mysqli($host, $user, $pw, $db);

    $sql = "SELECT SUM(temperatura) as count FROM datos_medidos 
            GROUP BY YEAR(fecha) ORDER BY fecha";
    $viewer = mysqli_query($mysqli,$sql);
    $viewer = mysqli_fetch_all($viewer,MYSQLI_ASSOC);
    $viewer = json_encode(array_column($viewer, 'count'),JSON_NUMERIC_CHECK);
    
    // Los datos generados a traves del json_enconde les quedan como se presenta abajo en comentarios:
    //$viewer = "[8,5,5]";
    
    /* Getting demo_click table data */
    $sql = "SELECT SUM(humedad) as count FROM datos_medidos 
            GROUP BY YEAR(fecha) ORDER BY fecha";
    $click = mysqli_query($mysqli,$sql);
    $click = mysqli_fetch_all($click,MYSQLI_ASSOC);
    $click = json_encode(array_column($click, 'count'),JSON_NUMERIC_CHECK);
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Grafico tem y hum</title>

		<style type="text/css">
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
<script src="code/highcharts.js"></script>
<script src="code/modules/series-label.js"></script>
<script src="code/modules/exporting.js"></script>
<script src="code/modules/export-data.js"></script>
<script src="code/modules/accessibility.js"></script>



<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
       Temperatura max y min por dia
       Humedad max y min por dia
    </p>
</figure>



		<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Temperatura y Humedad'
    },
    subtitle: {
        text: 'Source: sistema invernadero'
    },
    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        accessibility: {
            description: 'Rango de 7 dias'
        }
    },
    yAxis: {
        title: {
            text: 'Valor'
        },
        labels: {
            formatter: function () {
                return this.value + ' ';
            }
        }
    },
    tooltip: {
        crosshairs: true,
        shared: true
    },
    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: '#666666',
                lineWidth: 1
            }
        }
    },
    series: [{
        name: 'Temperatura',
        marker: {
            symbol: 'square'
        },
        data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, {
            y: 26.5,
            marker: {
                symbol: 'url(https://www.highcharts.com/samples/graphics/sun.png)'
            },
            accessibility: {
                description: 'Sunny symbol, this is the warmest point in the chart.'
            }
        }, 23.3, 18.3, 13.9, 9.6]

    }, {
        name: 'Humedad',
        marker: {
            symbol: 'diamond'
        },
        data: [{
            y: 3.9,
            marker: {
                symbol: 'url(https://www.highcharts.com/samples/graphics/snow.png)'
            },
            accessibility: {
                description: 'Snowy symbol, this is the coldest point in the chart.'
            }
        }, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
    }]
});
		</script>
	</body>
</html>
