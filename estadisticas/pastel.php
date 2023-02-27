<?php
include("../bd/conexion.php");
$con = conectar();
session_start(); //iniciar session de usuario
if(!isset ($_SESSION['id']) ){ //validando si el usuario esta loggeado
    header("Location: ../index.php"); //sino esta loggeado redirigir al home
}

$sql_activas = "SELECT count(*) AS 'cantidad' FROM tareas WHERE status='ACTIVA'"; //generar consulta
$resultado_activas = $mysqli->query($sql_activas); //guardar consulta
$row_activas = mysqli_fetch_array($resultado_activas); //ejecutar consulta (fetch devuelve un solo registro)
$activas = $row_activas['cantidad'];

$sql_finalizadas = "SELECT count(*) AS 'cantidad' FROM tareas WHERE status='FINALIZADA'"; //generar consulta
$resultado_finalizadas = $mysqli->query($sql_finalizadas); //guardar consulta
$row_finalizadas = mysqli_fetch_array($resultado_finalizadas); //ejecutar consulta (fetch devuelve un solo registro)
$finalizadas = $row_finalizadas['cantidad'];
?>
<!-- Autor: Jafet Daniel Fonseca Garcia -->
<div id="graficaPastel"></div>

<script>
  var ultimateColors = [
    ['green', 'red'],
];

    var data = [{
  values: [<?php echo $activas?>, <?php echo $finalizadas?>],
  labels: ['Tareras activas (<?php echo $activas?>)', 'Tareas finalizadas (<?php echo $finalizadas?>)'],
  type: 'pie',
  marker: {
    colors: ultimateColors[0]
  }
}];

var layout = {
  title: 'Estatus de Tareas'
};

Plotly.newPlot('graficaPastel', data, layout);
</script>
<!-- Autor: Jafet Daniel Fonseca Garcia -->