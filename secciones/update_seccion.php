<?php
include("../bd/conexion.php");
$con = conectar();
session_start(); //iniciar session de usuario
if (!isset($_SESSION['id'])) { //validando si el usuario esta loggeado
    header("Location: ../index.php"); //sino esta loggeado redirigir al home
}

$id_seccion = addslashes($_POST['id_seccion']);
$nombre = addslashes($_POST['nombre']);


if (!empty($id_seccion) && !empty($nombre)) { //validar que los campos no esten vacios

    $sql = "UPDATE secciones_proyecto SET nombre='$nombre' WHERE id_seccion='$id_seccion'";

    $query = mysqli_query($con, $sql); //ejecutar consulta

    if ($query) {
      echo "<script>alert('modificacion exitosa')</script>";
    }else{
      echo "<script>alert('Error al modificar')</script>";
    }
}
