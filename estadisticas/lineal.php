<?php
include("../bd/conexion.php");
$con = conectar();
session_start(); //iniciar session de usuario
if(!isset ($_SESSION['id']) ){ //validando si el usuario esta loggeado
    header("Location: ../index.php"); //sino esta loggeado redirigir al home
}

$sql = "SELECT nombre, fecha_entrega FROM tareas ORDER BY STR_TO_DATE(fecha_entrega, '%d/%m/%Y') ASC"; //generar consulta
$resultado = $mysqli->query($sql); //guardar consulta

$valoresY = array(); //tarea
$valroesX = array(); //fecha

while($ver = mysqli_fetch_row($resultado)){
  $valoresY[]=$ver[0];
  $valoresX[]=$ver[1];
}

$datosX=json_encode($valoresX);
$datosY=json_encode($valoresY);
?>
<!-- Autor: Jafet Daniel Fonseca Garcia -->
<div id="graficaLineal"></div>

<script>
	function crearCadenaLineal(json){
		var parsed = JSON.parse(json);
		var arr = [];
		for(var x in parsed){
			arr.push(parsed[x]);
		}
		return arr;
	}
</script>

<script>
  datosX=crearCadenaLineal('<?php echo $datosX ?>');
	datosY=crearCadenaLineal('<?php echo $datosY ?>');

    var trace1 = {
  x: datosX,
  y: datosY,
  type: 'scatter',
  line:{
    color: 'red',
    width: 2
  },
  marker:{
    color: 'rgb(164,194,244)',
    size: 12
  }
}
  var layout = {
    title: 'Tareas por fecha',
    xaxis:{
      title: ''
    },
    yaxis:{
      title: ''
    }
};

var data = [trace1];

Plotly.newPlot('graficaLineal', data, layout);
</script>
<!-- Autor: Jafet Daniel Fonseca Garcia -->