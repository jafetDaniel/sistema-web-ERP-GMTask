<script src="../librerias/sweetalert.js"></script>
<?php
include("../bd/conexion.php");
$con = conectar();
session_start(); //iniciar session de usuario
if(!isset ($_SESSION['id']) ){ //validando si el usuario esta loggeado
    header("Location: ../index.php"); //sino esta loggeado redirigir al home
}

$id=$_GET['id'];

$ruta = "../archivos_servicios/".$id;
rrmdir($ruta); //eliminar carpeta fisicamente (con todo y sus archivos)

function rrmdir($dir) { //funcion para borrar carpeta y sus archivos dentro
    if (is_dir($dir)) {
      $objects = scandir($dir);
      foreach ($objects as $object) {
        if ($object != "." && $object != "..") {
          if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
        }
      }
      reset($objects);
      rmdir($dir);
    }
 } 
 
        $sql="DELETE FROM reporte_servicios WHERE id_servicio='$id'"; //consuta para borrar registro
             $query=mysqli_query($con,$sql); //ejecutar consulta para eliminar servicio

        if($query){ //si se ejecuto el query correctamente
                header("Location: reportes.php");
                echo "<script>alert('Elemento eliminado')</script>";               
            }else{
                echo "<script>alert('Error al eliminar elemento')</script>";
            }
?>