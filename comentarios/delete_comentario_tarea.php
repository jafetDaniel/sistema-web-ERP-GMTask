<script src="../librerias/sweetalert.js"></script>
<?php
include("../bd/conexion.php");
$con = conectar();
session_start(); //iniciar session de usuario
if (!isset($_SESSION['id'])) { //validando si el usuario esta loggeado
    header("Location: ../index.php"); //sino esta loggeado redirigir al home
}

$id_comentario = addslashes($_POST['id_comentario']);

$sql_comentario = "DELETE FROM comentarios_tareas WHERE id_comentario='$id_comentario'";
$query_comentario = mysqli_query($con, $sql_comentario); //ejecutar consulta para eliminar seccion

if ($query_comentario) {
    echo "<script>alert('Elemento eliminado')</script>";
} else {
    echo "<script>alert('Error al eliminar elemento')</script>";
}
?>