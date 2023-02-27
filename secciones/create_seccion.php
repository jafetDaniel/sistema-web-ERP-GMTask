<?php
require "../bd/conexion.php"; //llamar a la conexion
$con = conectar(); //llamar al metodo para hacer conexion a la BD
session_start(); //iniciar session de usuario
if(!isset ($_SESSION['id']) ){ //validando si el usuario esta loggeado
    header("Location: ../index.php"); //sino esta loggeado redirigir al home
}

    $id_proyecto = $_GET['id_proyecto'];
    $nombre_seccion = addslashes($_POST['nombre_seccion']);

  if (!empty($nombre_seccion) && !empty($id_proyecto)) { //validar que los campos no esten vacios

      $sql = "INSERT INTO secciones_proyecto (nombre, id_proyecto)
              VALUES ('$nombre_seccion','$id_proyecto')"; //generar query

            $result = mysqli_query($con, $sql); //ejecutar query

            if ($result) { //si se ejecuto correctamente el query 
              
               $nombre_seccion = ""; //limpiar campos
               $_POST['nombre_seccion'] = ""; //limpiar campos post
               $_GET['id_proyecto'] = "";
            
               echo "<script>swal('sección creada exitosamente', '', 'success')</script>";
               Header("Location: ../proyectos/detalles_proyecto.php?id_proyecto=$id_proyecto");

            }else{            
                echo "<script>swal('ERROR al registrar proyecto', '', 'error')</script>";
            }
  }


?>