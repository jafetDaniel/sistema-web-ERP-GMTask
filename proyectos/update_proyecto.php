<?php
include("../bd/conexion.php");
$con = conectar();
session_start(); //iniciar session de usuario
if (!isset($_SESSION['id'])) { //validando si el usuario esta loggeado
    header("Location: ../index.php"); //sino esta loggeado redirigir al home
}

$id_proyecto = $_GET['id_proyecto'];

$nombre = addslashes($_POST['nombre']);
$privacidad = addslashes($_POST['privacidad']);
$miembro = addslashes($_POST['miembro']);

if (
    !empty($nombre) && !empty($privacidad)) { //validar que los campos no esten vacios

    $sql = "UPDATE proyectos SET nombre='$nombre', privacidad ='$privacidad' WHERE id_proyecto='$id_proyecto'";

    $query = mysqli_query($con, $sql); //ejecutar consulta

    if(!empty($miembro) && $miembro != 0){
        $sql_miembro = "INSERT INTO colaboradores_proyectos (id_proyecto, id_usuario)
                                VALUES ('$id_proyecto','$miembro')"; //generar query
            $resultado_membro = mysqli_query($con, $sql_miembro); //ejecutar query
    }

    if ($query) {//si se ejecuto la consulta
        Header("Location: detalles_proyecto.php?id_proyecto=$id_proyecto");
    }
}
