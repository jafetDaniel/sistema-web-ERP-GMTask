<?php 
header('Cache-Control: no cache'); //no cache (para que NO genere error a la hora de regresar a la pagina anterior)
session_cache_limiter('private_no_expire'); //works (para que NO genere error a la hora de regresar a la pagina anterior)
require_once '../header.php';
$con = conectar();

$busqueda = addslashes($_POST['busqueda']); //protege la busqueda de caracteres especiales

$sql_busqueda = "SELECT * FROM tareas WHERE nombre LIKE '%$busqueda%'
                              UNION
                              SELECT * FROM tareas WHERE descripcion LIKE '%$busqueda%'
                              UNION
                              SELECT * FROM tareas WHERE fecha_entrega LIKE '%$busqueda%'
                              UNION
                              SELECT * FROM tareas WHERE status LIKE '%$busqueda%';"; //generar consulta secciones
$resultado_busqueda = $mysqli->query($sql_busqueda); //guardar consulta
$num_busqueda = $resultado_busqueda->num_rows; //si la consulta genero resultados
?>
<!-- Autor: Jafet Daniel Fonseca Garcia -->
<h1 class="mt-4"></h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="../home.php">Inicio</a></li>
    <li class="breadcrumb-item active">Busqueda</li>
</ol>
<h2 style="display:inline;">Resultados de la Busqueda "<?php echo $busqueda?>"</h2>
<br>
<link rel="stylesheet" href="../css/estilos_cards.css">

<section class="product">
    <?php
     if(!empty($busqueda)){
    ?>
    <div class="product-container">
        <?php
        while ($row = mysqli_fetch_array($resultado_busqueda)) { //id de todas las tareas que tiene el proyecto

            $id_tarea = $row['id_tarea']; //guardar id en variable

            if($num_busqueda > 0){
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
                        </div>

                        <div class="product-info">
                            <p class="product-short-description" style="display: inline; text-align: left;"><?php echo $row['fecha_entrega'] ?></p>
        
                            <?php
                            if (($row['status'] == "ACTIVA") || ($row['status'] == "activa")) { //si el status es ACTIVA            
                            ?>
                                <p class="price" style="font-size: 13px; color: red; font-weight: bold; display: inline; margin-left: 40%;"><?php echo $row['status'] ?></p>
                            <?php
                            } else { //si es status es FINALIZADA   
                            ?>
                                <p class="price" style="font-size: 13px; color: green; font-weight: bold; display: inline; margin-left: 30%;"><?php echo $row['status'] ?></p>
                            <?php
                            }
                            ?>
                            <a href="detalles_tarea.php?id_tarea=<?php echo $row['id_tarea']?>">Ver</a>
                            <p class="price"><?php echo $row['nombre'] ?></p>
                        </div>
                    </div>
        <?php
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
<!-- Autor: Jafet Daniel Fonseca Garcia -->