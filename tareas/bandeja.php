<?php require_once '../header.php'; ?>
<?php
$sql_bandeja = "SELECT id_notificacion, tipo, leido, fecha, id_tarea, id_usuario
                FROM notificaciones
                WHERE id_usuario_receptor  = '$id'
                ORDER BY id_notificacion DESC"; //generar consulta para obtener las notificaciones del usuario

$resultado_bandeja = $mysqli->query($sql_bandeja); //guardar consulta proyectos
?>
<style>
  #borrar_notificacion{
    display: block;
    text-align: right; 
    color: red;
    margin-left: 80%;
}
#visto{
  text-align: right; 
  font-weight: bold;
}
.card-1 p{
    font-size: 15px;
    margin-top: 1px;
    margin-bottom: 2px;
}
input{
  height: 35px;
}
</style>
<!-- Autor: Jafet Daniel Fonseca Garcia -->
<h1 id="saludo" class="mt-4">Bandeja de Entrada</h1>
<link rel="stylesheet" href="../css/estilos_bandeja.css">

<div class="container">
    <div class="row">
               <?php
                while ($row_bandeja = mysqli_fetch_array($resultado_bandeja)) {

                        $id_t = $row_bandeja['id_tarea']; //id de tarea o servicio
                        $id_u = $row_bandeja['id_usuario']; //id del usuario credor de la notificacion

                          $sql_tarea = "SELECT * FROM tareas WHERE id_tarea='$id_t'"; //generar consulta datos de la tarea
                          $resultado_tarea = $mysqli->query($sql_tarea); //guardar consulta
                          $row_tarea = mysqli_fetch_array($resultado_tarea); //ejecutar consulta (fetch devuelve un solo registro)
                          $num_tarea = $resultado_tarea->num_rows; //si la consulta genero resultados     

                          $sql_usuario = "SELECT nombre, apellidos FROM usuarios WHERE id_usuario='$id_u'"; //generar consulta datos del usuario
                          $resultado_usuario = $mysqli->query($sql_usuario); //guardar consulta
                          $row_usuario = mysqli_fetch_array($resultado_usuario); //ejecutar consulta (fetch devuelve un solo registro)
                ?>
            <div class="card-1">
                 <a type="button" href="../notificaciones/delete_notificacion.php?id_notificacion=<?php echo $row_bandeja['id_notificacion']?>" id="borrar_notificacion"><i class="fa-solid fa-xmark" style="width: 20px; height: 20px;"></i></a> 
                 <p id="visto">            
                    <?php 
                      if($row_bandeja['leido'] == "1"){ 
                    ?>
                  visto <i class="fa-solid fa-check-double"></i>
                    <?php
                      }else{      
                    ?> 
                  <a type="button" href="../notificaciones/marcar_leido.php?id_notificacion=<?php echo $row_bandeja['id_notificacion']?>">Marcar como leído</a>  
                    <?php
                     }        
                    ?>   
                </p>   
                <h6><?php echo $row_bandeja['fecha'] ?></h6>
                <p>
                  <?php 
                  echo $row_usuario['nombre']." ".$row_usuario['apellidos']." ".$row_bandeja['tipo'];    
                  ?>
                </p>
                <?php
                  if($num_tarea > 0){//si es una tarea
                  ?>
                <p>Tarea: <?php echo $row_tarea['nombre'] ?></p>
                <p>vence el: <?php echo $row_tarea['fecha_entrega']?> 
                  <?php
                  if($row_tarea['status'] == "ACTIVA"){
                  ?>
                  <span class="waiting">ACTIVA</span>
                  <?php
                   }else
                   if($row_tarea['status'] == "FINALIZADA"){            
                  ?>
                  <span class="active">FINALIZADA</span>
                  <?php
                   }
                  ?>
                </p>
                <input type="button" onclick="location.href='../notificaciones/notificacion_vista_tarea.php?id_notificacion=<?php echo $row_bandeja['id_notificacion']?>&id_tarea=<?php echo $id_t?>'" value="Ir a tarea" class="btn btn-info">

                <?php
                  }else{//si es un servicio
                  ?>
                  <p>En un registro de servicios</p>
                  <input type="button" onclick="location.href='../notificaciones/notificacion_vista_servicio.php?id_notificacion=<?php echo $row_bandeja['id_notificacion']?>&id_servicio=<?php echo $id_t?>'" value="Ir a registro" class="btn btn-info">
                  <?php
                  }
                  ?>
            </div>
                <?php                    
                  } //while
                ?>
    </div>
</div>
<!-- Autor: Jafet Daniel Fonseca Garcia -->
<?php require_once '../footer.php'; ?>