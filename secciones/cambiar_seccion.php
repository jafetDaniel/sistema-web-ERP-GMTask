<?php
include("../bd/conexion.php");
$con = conectar();
session_start(); //iniciar session de usuario
if (!isset($_SESSION['id'])) { //validando si el usuario esta loggeado
    header("Location: ../index.php"); //sino esta loggeado redirigir al home
}
$id_proyecto = $_GET['id_proyecto'];

$id_tarea_cambio_sec = addslashes($_POST['id_tarea_cambio_sec']);
$cambio_seccion = addslashes($_POST['cambio_seccion']);


if (!empty($id_tarea_cambio_sec) && !empty($cambio_seccion)) { //validar que los campos no esten vacios

  if( ($cambio_seccion == "SIN SECCION") || ($cambio_seccion == "sin seccion") ){ //sin seccion
    
    $sql = "DELETE FROM tareas_seccion WHERE id_tarea='$id_tarea_cambio_sec'"; //qutar tarea de una seccion

  }else{

    $sql_secciones = "SELECT * FROM tareas_seccion WHERE id_tarea='$id_tarea_cambio_sec'"; //generar consulta secciones
    $resultado_secciones = $mysqli->query($sql_secciones); //guardar consulta
    $row = mysqli_fetch_array($resultado_secciones); //ejecutar consulta (fetch devuelve un solo registro)
    $num = $resultado_secciones->num_rows; //si la consulta genero resultados

    if( $num > 0){ //si ya tiene una seccion
         $sql = "UPDATE tareas_seccion SET id_seccion='$cambio_seccion' WHERE id_tarea='$id_tarea_cambio_sec'";

    }else{ //si apenas se asignara una seccion
      $sql = "INSERT INTO tareas_seccion (id_seccion, id_tarea)
             VALUES ('$cambio_seccion','$id_tarea_cambio_sec')"; //generar query
    }

  }
    $query = mysqli_query($con, $sql); //ejecutar consulta

    if ($query) {
      Header("Location: ../proyectos/detalles_proyecto.php?id_proyecto=$id_proyecto");
    }else{
      echo "Error al modificar";
    }
}
