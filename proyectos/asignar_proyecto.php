<?php
include("../bd/conexion.php");
$con = conectar();
session_start(); //iniciar session de usuario
if (!isset($_SESSION['id'])) { //validando si el usuario esta loggeado
    header("Location: ../index.php"); //sino esta loggeado redirigir al home
}

$id_tarea = $_GET['id_tarea'];
$asignar_proyecto = addslashes($_POST['asignar_proyecto']);

if ( !empty($id_tarea) && !empty($asignar_proyecto)) { //validar que los campos no esten vacios

    $sql = "INSERT INTO proyectos_tareas (id_proyecto, id_tarea) VALUES ('$asignar_proyecto','$id_tarea')";
    $query = mysqli_query($con, $sql); //ejecutar consulta

    if ($query) {//si se ejecuto la consulta
        Header("Location: ../tareas/detalles_tarea.php?id_tarea=$id_tarea");
    }
}

