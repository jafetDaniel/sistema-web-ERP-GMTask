<?php
include("../bd/conexion.php");
$con = conectar();
session_start(); //iniciar session de usuario
if (!isset($_SESSION['id'])) { //validando si el usuario esta loggeado
    header("Location: ../index.php"); //sino esta loggeado redirigir al home
}

$id_comentario = addslashes($_POST['id_comentario']);
$descripcion = addslashes($_POST['descripcion']);

if (!empty($id_comentario) && !empty($descripcion)) { //validar que los campos no esten vacios

    $sql = "UPDATE comentarios_tareas SET descripcion='$descripcion' WHERE id_comentario='$id_comentario'";

    $query = mysqli_query($con, $sql); //ejecutar consulta

    if ($query) {
      echo "<script>alert('modificacion exitosa')</script>";
    }else{
      echo "<script>alert('Error al modificar')</script>";
    }
}
