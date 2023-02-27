<?php
include("../bd/conexion.php");
$con = conectar();
session_start(); //iniciar session de usuario

if(!isset ($_SESSION['id']) ){ //validando si el usuario esta loggeado
    header("Location: ../index.php"); //sino esta loggeado redirigir al home
}
/*
SELECT usuarios.nombre,
                 COUNT(colaboradores_tareas.id_tarea) AS 'cantidad_tareas' 
                 FROM `colaboradores_tareas`
                 NATURAL JOIN usuarios
                 GROUP BY id_usuario
*/
$sql= "SELECT colaboradores_tareas.id_usuario,
              usuarios.nombre,
              COUNT(colaboradores_tareas.id_tarea) AS 'cantidad_tareas_activas'
        FROM colaboradores_tareas
        NATURAL JOIN usuarios
        JOIN tareas USING (id_tarea)
        WHERE tareas.status ='ACTIVA'
        GROUP BY id_usuario"; //generar consulta
$resultado= $mysqli->query($sql); //guardar consulta

$valoresX = array();
$valoresY = array();

while($ver = mysqli_fetch_row($resultado)){
  $valoresX[]=$ver[1];
  $valoresY[]=$ver[2];
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
    type: 'bar',
    marker: {
      color : 'orange'
    }
  }
];

var layout = {
title: 'Tareas ACTIVAS asignadas a usuarios',
font:{
  family: 'Raleway, sans-serif'
},
xaxis: {
  tickangle: -45,
  title: ''
},
yaxis: {
  title: 'cantidad de tareas ACTIVAS'
},
bargap :0.05
};

Plotly.newPlot('graficaBarras', data, layout);
</script>
<!-- Autor: Jafet Daniel Fonseca Garcia -->