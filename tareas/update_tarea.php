<?php
include("../bd/conexion.php");
include("../notificaciones/funciones_notificaciones.php");

$con = conectar();
session_start(); //iniciar session de usuario
if (!isset($_SESSION['id'])) { //validando si el usuario esta loggeado
    header("Location: ../index.php"); //sino esta loggeado redirigir al home
}
$id = $_SESSION['id'];  //obtener el id de la sesion del usuario

date_default_timezone_set('America/Mexico_City');  
$fecha_sistema = date('d/m/Y h:i:s a', time());

$id_tarea = $_GET['id_tarea'];

$nombre_tarea = addslashes($_POST['nombre_tarea']);
$colaborador = addslashes($_POST['responsable']);
$descripcion = addslashes($_POST['descripcion']);
$fecha_entrega = addslashes($_POST['fecha_entrega']);

$sql_tarea = "SELECT * FROM tareas WHERE id_tarea='$id_tarea'"; //generar consulta datos de la tarea
$resultado_tarea = $mysqli->query($sql_tarea); //guardar consulta
$row_tarea = mysqli_fetch_array($resultado_tarea); //ejecutar consulta (fetch devuelve un solo registro)

$sql_colaboradores = "SELECT * FROM colaboradores_tareas WHERE id_tarea='$id_tarea'"; //generar consulta colaboradores
$resultado_colaboradores = $mysqli->query($sql_colaboradores); //guardar consulta proyectos

$sql_colaboradores2 = "SELECT * FROM colaboradores_tareas WHERE id_tarea='$id_tarea'"; //generar consulta colaboradores
$resultado_colaboradores2 = $mysqli->query($sql_colaboradores2); //guardar consulta proyectos

if (!empty($nombre_tarea) && !empty($descripcion)) { //validar que los campos no esten vacios

    if($row_tarea['fecha_entrega'] != $fecha_entrega){
        while ($row_colaboradores = mysqli_fetch_array($resultado_colaboradores)) {
        notificacion_update_fecha($fecha_sistema, $id_tarea, $id, $row_colaboradores['id_usuario'], $con);
        }
    }
    if( ($row_tarea['nombre'] != $nombre_tarea) || ($row_tarea['descripcion'] != $descripcion) ){
        while ($row_colaboradores2 = mysqli_fetch_array($resultado_colaboradores2)) {
        notificacion_update_datos($fecha_sistema, $id_tarea, $id, $row_colaboradores2['id_usuario'], $con);
        }
    }

    $sql = "UPDATE tareas SET nombre='$nombre_tarea', descripcion ='$descripcion', fecha_entrega ='$fecha_entrega' WHERE id_tarea='$id_tarea'";
    $query = mysqli_query($con, $sql); //ejecutar consulta

    if( (!empty($colaborador)) && ($colaborador != "0") ){
        $sql_colaborador = "INSERT INTO colaboradores_tareas (id_tarea, id_usuario)
                            VALUES ('$id_tarea','$colaborador')"; //generar query
        $resultado_colaborador = mysqli_query($con, $sql_colaborador); //ejecutar query

        //para notificacion
        $sql_colaboradores3 = "SELECT * FROM colaboradores_tareas WHERE id_tarea='$id_tarea'"; //generar consulta colaboradores
        $resultado_colaboradores3 = $mysqli->query($sql_colaboradores3); //guardar consulta proyectos
        while ($row_colaboradores3 = mysqli_fetch_array($resultado_colaboradores3)) {
       notificacion_nuevo_colaborador($colaborador, $fecha_sistema, $id_tarea, $id, $row_colaboradores3['id_usuario'], $con, $mysqli); //agregar notificacion de nuevo colaborador
        }
      }


    if ($query) {
        Header("Location: detalles_tarea.php?id_tarea=$id_tarea");
    }else{
        echo "error al modificar";
    }
}


?>
