<?php
include("../bd/conexion.php");
$con = conectar();
session_start(); //iniciar session de usuario
if(!isset ($_SESSION['id']) ){ //validando si el usuario esta loggeado
        header("Location: ../index.php"); //sino esta loggeado redirigir al home
    }
    
$id = $_SESSION['id']; //obtener id del usuario

        $password=$_POST['password'];
        $password_rep=$_POST['password_rep'];

        if(!empty($password) && !empty($password_rep)){
            
            $pass_cifrado = sha1($password); //cifrar password ingresada
            $sql="UPDATE usuarios SET  password='$pass_cifrado' WHERE id_usuario='$id'";
            $query=mysqli_query($con,$sql);

        }
        if($query){
                Header("Location: usuarios.php");
            }
?>