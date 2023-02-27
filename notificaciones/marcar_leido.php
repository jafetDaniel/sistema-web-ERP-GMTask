<?php
include("../bd/conexion.php");
$con = conectar();
session_start(); //iniciar session de usuario
if(!isset ($_SESSION['id']) ){ //validando si el usuario esta loggeado
    header("Location: ../index.php"); //sino esta loggeado redirigir al home
}
$id = $_SESSION['id'];  //obtener el id de la sesion del usuario

$id_notificacion=$_GET['id_notificacion'];

        $sql="UPDATE notificaciones SET leido = '1'
              WHERE id_notificacion='$id_notificacion' AND id_usuario_receptor=$id";
              
        $query=mysqli_query($con,$sql); //ejecutar consulta para eliminar proyecto

        if($query){
                header("Location: ../tareas/bandeja.php");                             
            }
?>