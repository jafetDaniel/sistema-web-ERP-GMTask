<?php
include("../bd/conexion.php");
$con = conectar();
session_start(); //iniciar session de usuario

if(!isset ($_SESSION['id']) ){ //validando si el usuario esta loggeado
    header("Location: ../index.php"); //sino esta loggeado redirigir al home
}

$sql = "SELECT proyectos.nombre,
               COUNT(proyectos_tareas.id_tarea) AS 'cantidad_tareas' 
        FROM proyectos_tareas
        NATURAL JOIN proyectos
        GROUP BY id_proyecto"; //generar consulta
$resultado = $mysqli->query($sql); //guardar consulta

$valoresY = array(); //tarea
$valroesX = array(); //fecha

while($ver = mysqli_fetch_row($resultado)){
  $valoresY[]=$ver[1];
  $valoresX[]=$ver[0];
}

$datosX=json_encode($valoresX);
$datosY=json_encode($valoresY);
?>
<!-- Autor: Jafet Daniel Fonseca Garcia -->
<div id="graficaBarras"></div>

<script>
	function crearCadenaBarras(json){
		var parsed = JSON.parse(json);
		var arr = [];
		for(var x in parsed){
			arr.push(parsed[x]);
		}
		return arr;
	}
</script>

<script>
  datosX=crearCadenaBarras('<?php echo $datosX ?>');
	datosY=crearCadenaBarras('<?php echo $datosY ?>');

    var data = [
  {
    x: datosX,
    y: datosY,
    type: 'bar'
  }
];

var layout = {
title: 'Cantidad de tareas por Proyectos',
font:{
  family: 'Raleway, sans-serif'
},
xaxis: {
  tickangle: -45,
  title: ''
},
yaxis: {
  title: 'cantidad de tareas'
},
bargap :0.05
};

Plotly.newPlot('graficaBarras', data, layout);
</script>
<!-- Autor: Jafet Daniel Fonseca Garcia -->