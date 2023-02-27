<?php
include("../bd/conexion.php");
$con = conectar();
session_start(); //iniciar session de usuario
if (!isset($_SESSION['id'])) { //validando si el usuario esta loggeado
    header("Location: ../index.php"); //sino esta loggeado redirigir al home
}

$id_comentario_servicio = addslashes($_POST['id_comentario_servicio']);
$descripcion = addslashes($_POST['descripcion']);

if (!empty($id_comentario_servicio) && !empty($descripcion)) { //validar que los campos no esten vacios

    $sql = "UPDATE comentarios_servicios SET descripcion='$descripcion' WHERE id_comentario_servicio='$id_comentario_servicio'";

    $query = mysqli_query($con, $sql); //ejecutar consulta

    if ($query) {
      echo "<script>alert('modificacion exitosa')</script>";
    }else{
      echo "<script>alert('Error al modificar')</script>";
    }
}
