<?php require_once '../header.php'; ?>
<?php
$sql = "SELECT id_proyecto FROM proyectos WHERE privacidad ='PUBLICO'
        UNION
        SELECT id_proyecto FROM colaboradores_proyectos WHERE id_usuario ='$id'";
$resultado = $mysqli->query($sql); //guardar consulta
?>
<h1 id="saludo" class="mt-4">Mis Proyectos</h1>
<!-- Autor: Jafet Daniel Fonseca Garcia -->
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">Nuevo proyecto</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="create_proyecto.php">Crear</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Proyectos
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Ver</th>
                    <th>Nombre</th>
                    <th>Creador</th>
                    <th>Privacidad</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Ver</th>
                    <th>Nombre</th>
                    <th>Creador</th>
                    <th>Privacidad</th>
                </tr>
            </tfoot>
            <tbody class="table-dark">
                <?php
                while ($row = mysqli_fetch_array($resultado)) {
                    $id_p = $row['id_proyecto']; //guardar id en variable
               
                    $sql_proyecto = "SELECT * FROM proyectos WHERE id_proyecto='$id_p'"; //consulta para obtener los datos de la tarea
                    $resultado_proyecto = $mysqli->query($sql_proyecto); //guardar consulta
                    $row_proyecto = mysqli_fetch_array($resultado_proyecto); //ejecutar consulta (fetch devuelve un solo registro)
                    $num_proyecto = $resultado_proyecto->num_rows; //si la consulta genero resultados  
    
                    if ($num_proyecto > 0) {              
                ?>
                    <tr>
                        <td style="width: 1px;">
                            <a type="button" href="detalles_proyecto.php?id_proyecto=<?php echo $row['id_proyecto'] ?>" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                        </td>
                        <td><?php echo $row_proyecto['nombre'] ?></td>
                        <td><?php echo $row_proyecto['correo_creador'] ?></td>
                        <td><?php echo $row_proyecto['privacidad'] ?></td>
                    </tr>
                <?php
                } //if
                }//while
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Autor: Jafet Daniel Fonseca Garcia -->
<?php require_once '../footer.php'; ?>


