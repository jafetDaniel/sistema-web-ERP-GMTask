<?php require_once '../header.php'; ?>
<?php
$sql_colaboradores = "SELECT id_tarea FROM colaboradores_tareas WHERE id_usuario='$id'"; //generar consulta colaboradores
$resultado_colaboradores = $mysqli->query($sql_colaboradores); //guardar consulta
?>
<!-- Autor: Jafet Daniel Fonseca Garcia -->
<h1 id="saludo" class="mt-4">Mis Tareas</h1>

<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">Nueva tarea</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="create_tarea.php">Crear</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Tareas
    </div>
    <div class="card-body">
        <table id="datatablesSimple" >
            <thead>
                <tr>
                    <th>Ver</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Fecha de Entrega</th>
                    <th>Proyecto Asignado</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Ver</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Fecha de Entrega</th>
                    <th>Proyecto Asignado</th>
                    <th>Status</th>
                </tr>
            </tfoot>
            <tbody class="table-dark">           
               <?php
                while ($row_colaboradores = mysqli_fetch_array($resultado_colaboradores)) {

                    $id_t = $row_colaboradores['id_tarea']; //guardar id en variable
               
                    $sql_t_colaborador = "SELECT * FROM tareas WHERE id_tarea='$id_t'"; //consulta para obtener los datos de la tarea
                    $resultado_t_colaborador = $mysqli->query($sql_t_colaborador); //guardar consulta
                    $row_t_colaborador = mysqli_fetch_array($resultado_t_colaborador); //ejecutar consulta (fetch devuelve un solo registro)
                    $num_t_colaborador = $resultado_t_colaborador->num_rows; //si la consulta genero resultados  
    
                    if ($num_t_colaborador > 0) { 
                ?>
                    <tr>
                        <td style="width: 1px;">
                            <a type="button" href="detalles_tarea.php?id_tarea=<?php echo $row_t_colaborador['id_tarea']?>" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                        </td>
                        <td><?php echo $row_t_colaborador['nombre'] ?></td>
                        <td><?php echo $row_t_colaborador['descripcion'] ?></td>
                        <td><?php echo $row_t_colaborador['fecha_entrega'] ?></td>
                        <?php
                        $id_t = $row_t_colaborador['id_tarea'];
                        $sql_t = "SELECT id_proyecto FROM proyectos_tareas WHERE id_tarea='$id_t'"; //generar consulta
                        $resultado_t = $mysqli->query($sql_t); //guardar consulta
                        $row_t = mysqli_fetch_array($resultado_t); //ejecutar consulta (fetch devuelve un solo registro)
                        $num = $resultado_t->num_rows; //si la consulta genero resultados

                        if ($num > 0) {

                            $id_p = $row_t['id_proyecto'];
                            $sql_p = "SELECT nombre FROM proyectos WHERE id_proyecto='$id_p'"; //generar consulta
                            $resultado_p = $mysqli->query($sql_p); //guardar consulta
                            $row_p = mysqli_fetch_array($resultado_p); //ejecutar consulta (fetch devuelve un solo registro)
                        ?>
                            <td><?php echo $row_p['nombre'] ?></td>
                        <?php
                        } else {
                        ?>
                        <td>SIN PROYECTO</td>
                        <?php
                        }
                        ?>
                         <td><?php echo $row_t_colaborador['status']?></td>
                    </tr>
                <?php
                    } //if
                } //while
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Autor: Jafet Daniel Fonseca Garcia -->
<?php require_once '../footer.php'; ?>