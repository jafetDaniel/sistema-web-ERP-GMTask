<?php
//pagina para cuando el usuario quiere modifcar el status de la tarea a Activa
include("../bd/conexion.php");
$con = conectar();
session_start(); //iniciar session de usuario
if (!isset($_SESSION['id'])) { //validando si el usuario esta loggeado
    header("Location: ../index.php"); //sino esta loggeado redirigir al home
}

$id_tarea = $_GET['id_tarea'];

if (!empty($id_tarea)) { //validar que los campos no esten vacios

    $sql = "UPDATE tareas SET status='ACTIVA' WHERE id_tarea='$id_tarea'";

    $query = mysqli_query($con, $sql); //ejecutar consulta

    if ($query) {
        Header("Location: detalles_tarea.php?id_tarea=$id_tarea");
    }else{
        echo "error al modificar";
    }
}