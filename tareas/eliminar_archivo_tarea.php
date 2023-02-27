<?php
include("../bd/conexion.php");
$con = conectar();
session_start(); //iniciar session de usuario
if(!isset ($_SESSION['id']) ){ //validando si el usuario esta loggeado
    header("Location: ../index.php"); //sino esta loggeado redirigir al home
}
$id_archivo_tarea=$_GET['id_archivo_tarea'];
$id_tarea=$_GET['id_tarea'];


$sql = "SELECT * FROM archivos_tareas WHERE id_archivo_tarea='$id_archivo_tarea'"; //generar consulta
$resultado = $mysqli->query($sql); //guardar consulta
$row=mysqli_fetch_array($resultado);//ejecutar consulta (fetch devuelve un solo registro)

$ruta = "../archivos_tareas/".$id_tarea."/".$row['nombre'];

unlink($ruta); //eliminar archivo

//elimianr registro de la bd
$delete="DELETE FROM archivos_tareas WHERE id_archivo_tarea='$id_archivo_tarea'"; //generar consulta
$query_delete=mysqli_query($con,$delete); //ejecutar consulta

if($query_delete){
    Header("Location: detalles_tarea.php?id_tarea=$id_tarea");

    echo "<script>alert('Elemento eliminado')</script>";               
}else{
    echo "<script>alert('Error al eliminar elemento')</script>";
}
       
?>
