<script src="../librerias/sweetalert.js"></script>
<?php
include("../bd/conexion.php");
$con = conectar();
session_start(); //iniciar session de usuario
if (!isset($_SESSION['id'])) { //validando si el usuario esta loggeado
    header("Location: ../index.php"); //sino esta loggeado redirigir al home
}

$id_seccion = addslashes($_POST['id_seccion']);

$sql_seccion = "DELETE FROM secciones_proyecto WHERE id_seccion='$id_seccion'";
$query_seccion = mysqli_query($con, $sql_seccion); //ejecutar consulta para eliminar seccion

if ($query_seccion) {
    echo "<script>alert('Elemento eliminado')</script>";
} else {
    echo "<script>alert('Error al eliminar elemento')</script>";
}
?>