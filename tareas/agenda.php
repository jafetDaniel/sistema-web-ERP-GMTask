<?php require_once '../header.php'; ?>
<?php
$sql_tareas = "SELECT * FROM tareas ORDER BY STR_TO_DATE(fecha_entrega, '%d/%m/%Y') DESC"; //generar consulta colaboradores
                                                                                           //se convierte el campo de fecha a tipo DATE
$resultado_tareas = $mysqli->query($sql_tareas); //guardar consulta proyectos
?>
<!-- Autor: Jafet Daniel Fonseca Garcia -->
<h1 id="saludo" class="mt-4">Agenda</h1>
<link rel="stylesheet" href="../css/estilos_agenda.css">

<section class="ftco-section">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <table class="table table-responsive-xl" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Tarea</th>
                                <th>Colaboradores</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row_tareas = mysqli_fetch_array($resultado_tareas)) {

                                $id_tarea = $row_tareas['id_tarea'];
                                $sql_colaboradores = "SELECT colaboradores_tareas.id_usuario, usuarios.nombre, usuarios.apellidos 
                                                      FROM colaboradores_tareas
                                                      NATURAL JOIN usuarios
                                                      WHERE colaboradores_tareas.id_tarea='$id_tarea'"; //generar consulta

                                $resultado_colaboradores = $mysqli->query($sql_colaboradores); //guardar consulta
                                $num = $resultado_colaboradores->num_rows; //si la consulta genero resultados
                            ?>
                                <tr class="alert" role="alert">
                                    <td>
                                        <div class="pl-3 email">
                                            <span><?php echo $row_tareas['fecha_entrega'] ?></span>
                                            <span><?php echo $row_tareas['nombre'] ?></span>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="pl-3 email">
                                            <br>
                                            <?php
                                            while ($row_colaboradores = mysqli_fetch_array($resultado_colaboradores)) {
                                            ?>
                                                <span><?php echo $row_colaboradores['nombre'] ?> <?php echo $row_colaboradores['apellidos'] ?></span>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </td>
                                    <?php
                                         if (($row_tareas['status'] == "ACTIVA") || ($row_tareas['status'] == "activa")) {
                                     ?>
                                    <td class="status"><span class="waiting">Activa</span></td>
                                    <?php
                                         }else{
                                     ?>
                                     <td class="status"><span class="active">Finalizada</span></td>
                                     <?php
                                         }
                                     ?>
                                    <td><a href="detalles_tarea.php?id_tarea=<?php echo $row_tareas['id_tarea']?>">Detalles</a></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Autor: Jafet Daniel Fonseca Garcia -->
<?php require_once '../footer.php'; ?>
