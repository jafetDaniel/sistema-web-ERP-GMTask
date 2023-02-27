<?php
include("../bd/conexion.php");
session_start(); //iniciar session de usuario
if(!isset ($_SESSION['id']) ){ //validando si el usuario esta loggeado
    header("Location: ../index.php"); //sino esta loggeado redirigir al home
}

if ($_POST) { //si ya se ingresaron los datos
 
   $tipo = addslashes($_POST['tipo']);
   echo $tipo;

   if($tipo == 'REPARACION'){
    Header("Location: create_reparacion.php");

   }else if($tipo == 'SERVICIO'){
    Header("Location: create_servicio.php");

   }else{
    echo "error de seleccion";
   }
}
?>