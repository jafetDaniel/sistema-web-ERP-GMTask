<?php require_once '../header.php'; ?>
<?php
$con = conectar();
$id_proyecto = $_GET['id_proyecto'];

$sql = "SELECT * FROM proyectos WHERE id_proyecto='$id_proyecto'"; //generar consulta
$resultado = $mysqli->query($sql); //guardar consulta
$row = mysqli_fetch_array($resultado); //ejecutar consulta (fetch devuelve un solo registro)

$sql_secciones = "SELECT * FROM secciones_proyecto WHERE id_proyecto='$id_proyecto'"; //generar consulta secciones
$resultado_secciones = $mysqli->query($sql_secciones); //guardar consulta

$sql_secciones2 = "SELECT * FROM secciones_proyecto WHERE id_proyecto='$id_proyecto'"; //generar consulta secciones
$resultado_secciones2 = $mysqli->query($sql_secciones2); //guardar consulta

$sql_secciones3 = "SELECT * FROM secciones_proyecto WHERE id_proyecto='$id_proyecto'"; //generar consulta secciones
$resultado_secciones3 = $mysqli->query($sql_secciones3); //guardar consulta

$sql_tareas = "SELECT * FROM proyectos_tareas WHERE id_proyecto='$id_proyecto' ORDER BY id_tarea DESC"; //generar tareas del proyecto
$resultado_tareas = $mysqli->query($sql_tareas); //guardar consulta

$sql_usuarios = "SELECT id_usuario, nombre, apellidos, correo FROM usuarios WHERE id_usuario !='$id'"; //generar consulta usuarios para poder agrgar colaborador
$resultado_usuarios = $mysqli->query($sql_usuarios); //guardar consulta
?>
<style>
  #pai{
    display: none;
  }
</style>

<!-- Autor: Jafet Daniel Fonseca Garcia -->
<h1 class="mt-4"></h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="../home.php">Inicio</a></li>
    <li class="breadcrumb-item"><a href="proyectos.php">Proyectos</a></li>
    <li class="breadcrumb-item active">Detalles</li>
</ol>

<h2 style="display:inline;"><?php echo $row['nombre'] ?>. </h2>
<p style="display:inline;"><?php echo $row['privacidad'] ?></p>
<br>
<br>
<a type="button" class="btn btn-warning" style="height: 30px; padding-top: 3px;" data-bs-toggle="modal" data-bs-target="#modalProyecto">Editar proyecto</a>
<?php
if($tipo_usuario == 2){
?>
<a type="button" class="btn btn-danger" style="height: 30px; padding-top: 3px;" data-bs-toggle="modal" data-bs-target="#modalEliminar_p">Eliminar</a>
<?php
}
?>
<br>
<div style="text-align: right;">
    <form action="busqueda.php?id_proyecto=<?php echo $id_proyecto ?>" method="POST" class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Ingrese palabra clave ..." name="busqueda" />
            <input type="submit" class="btn btn-primary" value="Buscar" />
        </div>
    </form>
    <a type="button" class="btn btn-secondary" style="height: 30px; padding-top: 3px;" data-bs-toggle="modal" data-bs-target="#modalSeccion">Agregar sección</a>
</div>
<br>
<link rel="stylesheet" href="../css/estilos_cards.css">

<!-- TAREAS SIN SECCIÓN-->
<section class="product">
    <button class="pre-btn"><img src="../images/arrow.png" alt=""></button>
    <button class="nxt-btn"><img src="../images/arrow.png" alt=""></button>
    <div class="product-container">
        <?php
        while ($row_tareas = mysqli_fetch_array($resultado_tareas)) { //id de todas las tareas que tiene el proyecto

            $id_tarea_sin = $row_tareas['id_tarea']; //guardar id en variable

            $sql_tareas_seccion_sin = "SELECT * FROM tareas_seccion WHERE id_tarea='$id_tarea_sin'"; //consultar para ver si las tareas tiene una seccion
            $resultado_tareas_seccion_sin = $mysqli->query($sql_tareas_seccion_sin); //guardar consulta
            $num_sin = $resultado_tareas_seccion_sin->num_rows; //si la consulta genero resultados

            if ($num_sin <= 0) { //si el id de la tarea no esta en la tabla tareas_seccion (no tiene seccion)

                $sql_todas = "SELECT * FROM tareas WHERE id_tarea='$id_tarea_sin'"; //consulta para obtener los datos de la tarea
                $resultado_todas = $mysqli->query($sql_todas); //guardar consulta
                $row_todas = mysqli_fetch_array($resultado_todas); //ejecutar consulta (fetch devuelve un solo registro)
                $num = $resultado_todas->num_rows; //si la consulta genero resultados

                if ($num > 0) { //si se encontro una tarea en ese ID en la tabla "TAREAS"
        ?>
                    <div class="product-card">
                        <div class="product-image">
                            <?php
                            $sql_imagen = "SELECT * FROM archivos_tareas WHERE id_tarea='$id_tarea_sin' AND nombre LIKE '%.%g' LIMIT 1"; //generar archivos
                            $resultado_imagen = $mysqli->query($sql_imagen); //guardar consulta
                            $row_imagen = mysqli_fetch_array($resultado_imagen); //ejecutar consulta (fetch devuelve un solo registro)
                            $num_imagen = $resultado_imagen->num_rows; //si la consulta genero resultados          

                            if ($num_imagen > 0) {
                                $ruta_imagen =  "archivos_tareas/" . $id_tarea_sin . "/" . $row_imagen['nombre'];
                            } else {
                                $ruta_imagen = "images/tarea.jpg";
                            }
                            ?>
                            <img src="../<?php echo $ruta_imagen ?>" class="product-thumb" alt="">
                            <a type="button" class="btn btn-secondary" onclick="CambiarSeccion('<?php echo $id_tarea_sin ?>')">MOVER A SECCIÓN</a>
                        </div>

                        <div class="product-info">
                            <p class="product-short-description" style="display: inline; text-align: left;"><?php echo $row_todas['fecha_entrega'] ?></p>

                            <?php
                            if (($row_todas['status'] == "ACTIVA") || ($row_todas['status'] == "activa")) { //si el status es ACTIVA            
                            ?>
                                <p class="price" style="font-size: 13px; color: red; font-weight: bold; display: inline; margin-left: 40%;"><?php echo $row_todas['status'] ?></p>
                            <?php
                            } else { //si es status es FINALIZADA   
                            ?>
                                <p class="price" style="font-size: 13px; color: green; font-weight: bold; display: inline; margin-left: 30%;"><?php echo $row_todas['status'] ?></p>
                            <?php
                            }
                            ?>
                            <a href="../tareas/detalles_tarea.php?id_tarea=<?php echo $row_todas['id_tarea'] ?>">Ver</a>
                            <p class="price" style="text-align: center;"><?php echo $row_todas['nombre'] ?></p>

                        </div>
                    </div>
        <?php
                } //num
            } //num sin
        } //while
        ?>
    </div>
</section><!-- TAREAS SIN SECCIÓN-->


<!-- SECCIÓNES y sus tareas-->
<br>
<?php
while ($row_secciones = mysqli_fetch_array($resultado_secciones)) {
?>
    <div style="text-align: center;">
        <h4 style="display: inline-block;"><?php echo $row_secciones['nombre'] ?></h4>
        <a type="button" onclick="GetDetails('<?php echo $row_secciones['id_seccion'] ?>')"><i class="fa-solid fa-pen-to-square"></i></a>
        <a type="button" onclick="Delete('<?php echo $row_secciones['id_seccion'] ?>')"><i class="fa-solid fa-trash-can"></i></a>
    </div>

    <section class="product">
        <button class="pre-btn"><img src="../images/arrow.png" alt=""></button>
        <button class="nxt-btn"><img src="../images/arrow.png" alt=""></button>
        <div class="product-container">
            <?php
            $id_seccion = $row_secciones['id_seccion'];
            $sql_tareas_seccion = "SELECT * FROM tareas_seccion WHERE id_seccion='$id_seccion' ORDER BY id_tarea DESC"; //generar tareas del proyecto
            $resultado_tareas_seccion = $mysqli->query($sql_tareas_seccion); //guardar consulta

            while ($row_tareas = mysqli_fetch_array($resultado_tareas_seccion)) {

                $id_t = $row_tareas['id_tarea'];

                $sql_t = "SELECT * FROM tareas WHERE id_tarea='$id_t'"; //generar consulta
                $resultado_t = $mysqli->query($sql_t); //guardar consulta
                $row_t = mysqli_fetch_array($resultado_t); //ejecutar consulta (fetch devuelve un solo registro)
                $num = $resultado_t->num_rows; //si la consulta genero resultados

                if ($num > 0) {
            ?>
                    <div class="product-card">
                        <div class="product-image">
                            <?php
                            $sql_imagen = "SELECT * FROM archivos_tareas WHERE id_tarea='$id_t' AND nombre LIKE '%.%g' LIMIT 1"; //generar el primer archivo jpg/png
                            $resultado_imagen = $mysqli->query($sql_imagen); //guardar consulta
                            $row_imagen = mysqli_fetch_array($resultado_imagen); //ejecutar consulta (fetch devuelve un solo registro)
                            $num_imagen = $resultado_imagen->num_rows; //si la consulta genero resultados          
                            if ($num_imagen > 0) {
                                $ruta_imagen2 =  "archivos_tareas/" . $id_t . "/" . $row_imagen['nombre'];
                            } else {
                                $ruta_imagen2 = "images/tarea.jpg";
                            }
                            ?>
                            <img src="../<?php echo $ruta_imagen2 ?>" class="product-thumb" alt="">
                            <a type="button" class="btn btn-secondary" onclick="CambiarSeccion('<?php echo $row_t['id_tarea'] ?>')">MOVER DE SECCIÓN</a>
                        </div>
                        <div class="product-info">
                            <p class="product-short-description" style="display: inline; text-align: left;"><?php echo $row_t['fecha_entrega'] ?></p>


                            <?php
                            if (($row_t['status'] == "ACTIVA") || ($row_t['status'] == "activa")) { //si el status es ACTIVA            
                            ?>
                                <p class="price" style="font-size: 13px; color: red; font-weight: bold;  display: inline; margin-left: 40%;"><?php echo $row_t['status'] ?></p>
                            <?php
                            } else { //si es status es FINALIZADA   
                            ?>
                                <p class="price" style="font-size: 13px; color: green; font-weight: bold; display: inline; margin-left: 30%;"><?php echo $row_t['status'] ?></p>
                            <?php
                            }
                            ?>
                            <a href="../tareas/detalles_tarea.php?id_tarea=<?php echo $row_t['id_tarea'] ?>&id_proyecto=<?php echo $id_proyecto ?>">Ver</a>
                            <p class="price" style="text-align: center;"><?php echo $row_t['nombre'] ?></p>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </section>
<?php
}
?>
<!-- SECCIÓNES y sus tareas-->

<?php require_once '../footer.php'; ?>


<!-- MODAL modificar datos MODAL-->
<!--  ltrim — Retira espacios en blanco (u otros caracteres) del inicio de un string -->
<div class="modal fade" id="modalProyecto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar datos del proyecto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="update_proyecto.php?id_proyecto=<?php echo $row['id_proyecto'] ?>" method="POST">

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Nombre del proyecto:</label>
                        <input name="nombre" type="text" class="form-control" value="<?php echo ltrim($row['nombre']) ?>">
                    </div>

                    <div class="mb-3">
                        <label for="inputState">Privacidad</label>
                        <select id="privacidad" class="form-control" name="privacidad" required>
                            <option>PUBLICO</option>
                            <option>PRIVADO</option>
                        </select>
                    </div>
               
                        <div class="mb-3" id="pai">
                            <label for="inputState">Agregar miembro a proyecto</label>
                            <select class="form-control" name="miembro">
                                <option value="0">ninguno</option>
                                <?php
                                while ($row_usuarios = mysqli_fetch_array($resultado_usuarios)) {
                                ?>
                                    <option value="<?php echo $row_usuarios['id_usuario'] ?>"><?php echo $row_usuarios['nombre'] ?> - <?php echo $row_usuarios['correo'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-primary" value="Actualizar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- MODAL modificar datos MODAL-->

<!-- MODAL eliminar proyecto MODAL-->
<div class="modal fade" id="modalEliminar_p" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar proyecto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="delete_proyecto.php?id_proyecto=<?php echo $row['id_proyecto'] ?>" method="POST">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">¿Esta seguro que desea eliminar este proyecto?</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-danger" value="Eliminar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- MODAL eliminar proyecto MODAL-->


<!-- MODAL agregar seccion MODAL-->
<!--  ltrim — Retira espacios en blanco (u otros caracteres) del inicio de un string -->
<div class="modal fade" id="modalSeccion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar sección</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../secciones/create_seccion.php?id_proyecto=<?php echo $id_proyecto ?>" method="POST">

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Nombre:</label>
                        <input name="nombre_seccion" type="text" class="form-control">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-primary" value="Agregar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- MODAL agregar seccion MODAL-->


<!-- MODAL editar seccion MODAL-->
<div class="modal fade" id="modalSeccionUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar sección</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formUpdateSeccion">

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Nombre:</label>
                        <input name="nombre_seccion_update" id="nombre_seccion_update" type="text" class="form-control">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-primary" value="Modificar">
                        <input type="hidden" id="hiddendata">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- MODAL editar seccion MODAL-->


<!-- MODAL eliminar seccion MODAL-->
<div class="modal fade" id="modalSeccionDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar sección</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formDeleteSeccion">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">¿Esta seguro que desea eliminar esta sección?</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-danger" value="Eliminar">
                        <input type="hidden" id="hiddendata2">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- MODAL eliminar seccion MODAL-->


<!-- MODAL mover de seccion MODAL-->
<div class="modal fade" id="modalCambiarSeccion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mover de sección</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../secciones/cambiar_seccion.php?id_proyecto=<?php echo $id_proyecto ?>" method="POST">

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Mover a:</label>
                        <select class="form-control" name="cambio_seccion" style="width: 300px;">
                            <option value="SIN SECCION">SIN SECCION</option>
                            <?php
                            while ($row_secciones2 = mysqli_fetch_array($resultado_secciones2)) {
                            ?>
                                <option value="<?php echo $row_secciones2['id_seccion'] ?>"><?php echo $row_secciones2['nombre'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_tarea_cambio_sec" id="hiddendata3">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-primary" value="Mover">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- MODAL mover de seccion MODAL-->

<script>
    const productContainers = [...document.querySelectorAll('.product-container')]; //aminacion carrusel
    const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
    const preBtn = [...document.querySelectorAll('.pre-btn')];

    productContainers.forEach((item, i) => {
        let containerDimensions = item.getBoundingClientRect();
        let containerWidth = containerDimensions.width;

        nxtBtn[i].addEventListener('click', () => {
            item.scrollLeft += containerWidth;
        })

        preBtn[i].addEventListener('click', () => {
            item.scrollLeft -= containerWidth;
        })
    })
</script>

<script>
    function GetDetails(updateid) { //funcion para obtener datos de una seccion elegida y mostrarlos en modal
        $('#hiddendata').val(updateid); //ponerle de texto el id al input oculto del modal

        $.post("../secciones/consulta_update.php", {
            updateid: updateid
        }, function(data, status) {
            var userid = JSON.parse(data); //guardar consulta extraida
            $('#nombre_seccion_update').val(userid.nombre); //mostrar valor en input
        });
        $('#modalSeccionUpdate').modal('show'); //mostrar modal
    }


    $("#formUpdateSeccion").submit(function(e) { //si se presiono el boton
        e.preventDefault();
        var id = $('#hiddendata').val(); //obteenr id
        var nombre_seccion_update = $('#nombre_seccion_update').val(); //obtener nombre

        $.post("../secciones/update_seccion.php", { //llamar a pagina update
            id_seccion: id, //pasando paramatros
            nombre: nombre_seccion_update
        }, function(data, status) {
            location.reload(true); //recargar la pagina
        });
    })

    function Delete(updateid) {
        $('#hiddendata2').val(updateid); //ponerle de texto el id al input oculto del modal
        $('#modalSeccionDelete').modal('show'); //mostrar modal
    }

    $("#formDeleteSeccion").submit(function(e) { //si se presiono el boton
        e.preventDefault();
        var id = $('#hiddendata2').val(); //obteenr id

        $.post("../secciones/delete_seccion.php", { //llamar a pagina update
            id_seccion: id //pasando paramatros
        }, function(data, status) {
            location.reload(true); //recargar la pagina
        });
    })


    function CambiarSeccion(updateid) {
        $('#hiddendata3').val(updateid); //ponerle de texto el id al input oculto del modal
        $('#modalCambiarSeccion').modal('show'); //mostrar modal
    }
</script>
<script>
   $(document).ready(function(){
    $('#privacidad').on('change', function(){
        var selectValor = '#'+$(this).val(); //obtener value de select

        if(selectValor == "#PRIVADO"){
          document.getElementById('pai').style.display = 'block';//mostrar div
        }else
        if(selectValor == "#PUBLICO"){
          document.getElementById('pai').style.display = 'none';//ocultar div
        }
    })
})
</script>
<!-- Autor: Jafet Daniel Fonseca Garcia -->