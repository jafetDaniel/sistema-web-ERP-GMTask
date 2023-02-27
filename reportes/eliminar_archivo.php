<script src="../librerias/sweetalert.js"></script>
<?php
include("../bd/conexion.php");
$con = conectar();
session_start(); //iniciar session de usuario
if(!isset ($_SESSION['id']) ){ //validando si el usuario esta loggeado
    header("Location: ../index.php"); //sino esta loggeado redirigir al home
}
$id_archivo=$_GET['id_archivo'];
$id_servicio=$_GET['id_servicio'];

$sql = "SELECT * FROM archivos_reporte_servicios WHERE id_archivo='$id_archivo'"; //generar consulta
$resultado = $mysqli->query($sql); //guardar consulta
$row=mysqli_fetch_array($resultado);//ejecutar consulta (fetch devuelve un solo registro)

$ruta = "../archivos_servicios/".$row['id_servicio']."/".$row['descripcion'];

unlink($ruta); //eliminar archivo

//elimianr registro de la bd
$delete="DELETE FROM archivos_reporte_servicios WHERE id_archivo='$id_archivo'"; //generar consulta delete
$query_delete=mysqli_query($con,$delete); //ejecutar consulta

if($query_delete){ //si se ejecuto correctamente la consulta
    Header("Location: detalles_reportes.php?id=$id_servicio");

    echo "<script>alert('Elemento eliminado')</script>";               
}else{
    echo "<script>alert('Error al eliminar elemento')</script>";
}
?>
