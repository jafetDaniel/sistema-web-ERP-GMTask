<?php require_once '../header.php'; ?>
<?php
$con = conectar(); //llamar al metodo para hacer conexion a la BD
?>
<script src="../librerias/plotly-2.15.1.min.js"></script>
<h1 class="mt-4">Estadísticas</h1>
<!-- Autor: Jafet Daniel Fonseca Garcia -->
<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-primary">
					<div class="panel panel-heading">Gráficas de Tareas</div>
					<div class="panel panel-body">
						<div class="row">		
						    <div class="col-sm-10">	
							    <div id="cargaPastel"></div>
							</div>			
							<div class="col-sm-10">					
								<div id="cargaBarrasUsuarios"></div>	
							</div>		
						    <div class="col-sm-10">
								<div id="cargaLineal"></div>
							</div>	
							<div class="col-sm-10">					
								<div id="cargaBarras"></div>
							</div>										
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php require_once '../footer.php';?>

<script>
    $(document).ready(function(){
        $('#cargaLineal').load('lineal.php'); //llamado a archivo php
        $('#cargaBarras').load('barras.php'); //llamado a archivo php
        $('#cargaPastel').load('pastel.php'); //llamado a archivo php
		$('#cargaBarrasUsuarios').load('barras_usuarios.php'); //llamado a archivo php
    });
</script>
<!-- Autor: Jafet Daniel Fonseca Garcia -->