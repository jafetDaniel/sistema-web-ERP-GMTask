<?php
include("../bd/conexion.php");
$con = conectar();
session_start(); //iniciar session de usuario
if(!isset ($_SESSION['id']) ){ //validando si el usuario esta loggeado
    header("Location: ../index.php"); //sino esta loggeado redirigir al home
}

$id_tarea=$_GET['id_tarea'];

$ruta = "../archivos_tareas/".$id_tarea;
rrmdir($ruta); //eliminar carpeta fisicamente (con todo y sus archivos)

function rrmdir($dir) {//metodo que elimina carpeta con contenido
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
        $sql="DELETE FROM tareas WHERE id_tarea='$id_tarea'";
        $query=mysqli_query($con,$sql); //ejecutar consulta para eliminar proyecto de la BD

        if($query){
                header("Location: tareas.php");
                echo "<script>alert('Elemento eliminado')</script>";               
            }else{
                echo "<script>alert('Error al eliminar elemento')</script>";
            }
?>