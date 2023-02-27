<?php 
header('Cache-Control: no cache'); //no cache (para que NO genere error a la hora de regresar a la pagina anterior)
session_cache_limiter('private_no_expire'); //works (para que NO genere error a la hora de regresar a la pagina anterior)
require_once '../header.php';
 ?>
<?php
$con = conectar();

$id_proyecto = $_GET['id_proyecto'];
$busqueda = addslashes($_POST['busqueda']); //protege la busqueda de caracteres especiales

$sql_tareas = "SELECT * FROM proyectos_tareas WHERE id_proyecto='$id_proyecto'"; //generar tareas del proyecto
$resultado_tareas = $mysqli->query($sql_tareas); //guardar consulta

$sql_secciones = "SELECT * FROM secciones_proyecto WHERE id_proyecto='$id_proyecto'"; //generar consulta secciones
$resultado_secciones = $mysqli->query($sql_secciones); //guardar consulta
?>
<!-- Autor: Jafet Daniel Fonseca Garcia -->
<h1 class="mt-4"></h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="../home.php">Inicio</a></li>
    <li class="breadcrumb-item"><a href="proyectos.php">Proyectos</a></li>
    <li class="breadcrumb-item active">Detalles</li>
</ol>

<h2 style="display:inline;">Resultados de la Busqueda "<?php echo $busqueda?>"</h2>
<br>

<link rel="stylesheet" href="../css/estilos_cards.css">

<!-- TAREAS SIN SECCIÓN-->
<section class="product">
    <?php
     if(!empty($busqueda)){
    ?>
    <div class="product-container">
        <?php
        while ($row_tareas = mysqli_fetch_array($resultado_tareas)) { //id de todas las tareas que tiene el proyecto

            $id_tarea = $row_tareas['id_tarea']; //guardar id en variable

            $sql_busqueda1 = "SELECT * FROM tareas WHERE id_tarea='$id_tarea' AND nombre LIKE '%$busqueda%'
                              UNION
                              SELECT * FROM tareas WHERE id_tarea='$id_tarea' AND descripcion LIKE '%$busqueda%'
                              UNION
                              SELECT * FROM tareas WHERE id_tarea='$id_tarea' AND fecha_entrega LIKE '%$busqueda%'
                              UNION
                              SELECT * FROM tareas WHERE id_tarea='$id_tarea' AND status LIKE '%$busqueda%';"; //generar consulta secciones
            
            $resultado_busqueda1 = $mysqli->query($sql_busqueda1); //guardar consulta
            $num_busqueda1 = $resultado_busqueda1->num_rows; //si la consulta genero resultados
        
            if($num_busqueda1 > 0){
                while( $row_busqueda1 = mysqli_fetch_array($resultado_busqueda1) ){ //ejecutar consulta (fetch devuelve un solo registro)) { //si se encontro una tarea
             ?>
                    <div class="product-card">
                        <div class="product-image">
                            <?php
                            $sql_imagen = "SELECT * FROM archivos_tareas WHERE id_tarea='$id_tarea' AND nombre LIKE '%.%g' LIMIT 1"; //generar archivos
                            $resultado_imagen = $mysqli->query($sql_imagen); //guardar consulta
                            $row_imagen = mysqli_fetch_array($resultado_imagen); //ejecutar consulta (fetch devuelve un solo registro)
                            $num_imagen = $resultado_imagen->num_rows; //si la consulta genero resultados          
                            if($num_imagen > 0){
                                $ruta_imagen =  "archivos_tareas/".$id_tarea."/".$row_imagen['nombre'];
                            }else{
                                $ruta_imagen = "images/tarea.jpg";
                            }
                            ?>
                            <img src="../<?php echo $ruta_imagen?>" class="product-thumb" alt="">
                            <a type="button" class="btn btn-secondary" onclick="CambiarSeccion('<?php echo $id_tarea?>')">MOVER A SECCIÓN</a>
                        </div>

                        <div class="product-info">
                            <p class="product-short-description" style="display: inline; text-align: left;"><?php echo $row_busqueda1['fecha_entrega'] ?></p>
                            
                            <?php
                            if (($row_busqueda1['status'] == "ACTIVA") || ($row_busqueda1['status'] == "activa")) { //si el status es ACTIVA            
                            ?>
                                <p class="price" style="font-size: 13px; color: red; font-weight: bold; display: inline; margin-left: 40%"><?php echo $row_busqueda1['status'] ?></p>
                            <?php
                            } else { //si es status es FINALIZADA   
                            ?>
                                <p class="price" style="font-size: 13px; color: green; font-weight: bold; display: inline; margin-left: 30%"><?php echo $row_busqueda1['status'] ?></p>
                            <?php
                            }
                            ?>
                            <a href="../tareas/detalles_tarea.php?id_tarea=<?php echo $row_busqueda1['id_tarea']?>">Ver</a>
                            <p class="price"><?php echo $row_busqueda1['nombre'] ?></p>
                        </div>
                    </div>
        <?php
                } //while de busqueda
            }// if num
        } //while id de todas las tareas
    } //si hay texto en el buscador
    else{
        ?>
        <br><br><br><br>
        <h2 style="color: gray;">SIN RESULTADOS</h2>
        <?php
        }
        ?>
    </div>
</section><!-- TAREAS SIN SECCIÓN-->
<?php require_once '../footer.php'; ?>

<!-- MODAL mover tarea de seccion MODAL-->
<div class="modal fade" id="modalCambiarSeccion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mover de sección</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../secciones/cambiar_seccion.php?id_proyecto=<?php echo $id_proyecto?>" method="POST">

                    <div class="mb-3">
                       <label for="recipient-name" class="col-form-label">Mover a:</label>
                        <select class="form-control" name="cambio_seccion" style="width: 300px;">
                            <option value="SIN SECCION">SIN SECCION</option>
                            <?php
                            while ($row_secciones = mysqli_fetch_array($resultado_secciones)) {
                            ?>
                                <option value="<?php echo $row_secciones['id_seccion'] ?>"><?php echo $row_secciones['nombre'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_tarea_cambio_sec" id="hiddendata">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-primary" value="Mover">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- MODAL mover tarea de seccion MODAL-->

<script>
     function CambiarSeccion(updateid) {
        $('#hiddendata').val(updateid); //ponerle de texto el id al input oculto del modal
        $('#modalCambiarSeccion').modal('show'); //mostrar modal
    }
</script>
<!-- Autor: Jafet Daniel Fonseca Garcia -->