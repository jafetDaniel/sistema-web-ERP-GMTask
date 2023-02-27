<?php
include("../bd/conexion.php");
include("../notificaciones/funciones_notificaciones.php");
$con = conectar();
session_start(); //iniciar session de usuario

if (!isset($_SESSION['id'])) { //validando si el usuario esta loggeado
    header("Location: ../index.php"); //sino esta loggeado redirigir al home
}
$nombre = $_SESSION['nombre']; //obtener el nombre de la sesion del usuario
$apellidos = $_SESSION['apellidos']; //obtener apellidos de sesion
$correo = $_SESSION['correo'];  //obtener el correo de la sesion del usuario
$id = $_SESSION['id'];  //obtener el id de la sesion del usuario

date_default_timezone_set('America/Mexico_City');  //defiir zona horaria del sistema
$fecha_sistema = date('d/m/Y h:i:s a', time()); //establecer formato de la fecha

   /*
   addslashes(string $str):  Devuelve un string con barras invertidas delante de los caracteres 
   que necesitan ser escapados. Estos caracteres son la comilla simple ('), comilla doble ("),
    barra invertida (\) y NUL (el byte null). 
   */
  $nombre_tarea = addslashes($_POST['nombre_tarea']);
  $colaborador = addslashes($_POST['responsable']);
  $colaborador2 = addslashes($_POST['responsable2']);
  $colaborador3 = addslashes($_POST['responsable3']);

  $descripcion = addslashes($_POST['descripcion']);

  $fecha_entrega = addslashes($_POST['fecha_entrega']);
  $date_entrega = strtotime($fecha_entrega);
  $date = date('d/m/Y', $date_entrega); //definir formato de la fecha obtenida del input

  $descripcion_archivo1 = addslashes($_POST['descripcion_archivo1']);
  $descripcion_archivo2 = addslashes($_POST['descripcion_archivo2']);

  $proyecto = addslashes($_POST['proyecto']);

  if (!empty($nombre_tarea) && !empty($fecha_entrega)) { //validar que los campos no esten vacios

    $sql = "INSERT INTO tareas (nombre, descripcion, fecha_entrega, status, id_usuario)
              VALUES ('$nombre_tarea','$descripcion','$date', 'ACTIVA', '$id')"; //generar query

    $result = mysqli_query($con, $sql); //ejecutar query insercion en tareas

    $id_tarea =  mysqli_insert_id($con); //recibo el último id insertado

    $sql_user = "INSERT INTO colaboradores_tareas (id_tarea, id_usuario) 
                 VALUES ('$id_tarea', '$id')"; //generar query para insertar como colaborador al creador de la tareas
    $result_user = mysqli_query($con, $sql_user); //ejecutar query insercion en colaboradores_tareas

    $cadena = 'Creo la tarea el '.$fecha_sistema;

    $sql_comentario = "INSERT INTO comentarios_tareas (descripcion, fecha, id_tarea, id_usuario)
    VALUES ('$cadena','$fecha_sistema', '$id_tarea', '$id')";
    $result_comentario = mysqli_query($con, $sql_comentario); //ejecutar query

    notificacion_creador_tarea($fecha_sistema, $id_tarea, $id, $con);

    if ($result && $result_user) { //si se ejecuto correctamente el query 

      if (!empty($proyecto)) { //validar que los campos no esten vacios
        if (($proyecto == "SIN PROYECTO") || ($proyecto == "sin proyeto")) { //si NO se asigno un proyecto
          
          $nombre_tarea = ""; //limpiar campos
          $descripcion = "";
          $fecha_entrega = "";
          $proyecto = "";
          $_POST['nombre_tarea'] = ""; //limpiar campos post
          $_POST['descripcion'] = "";
          $_POST['fecha_entrega'] = "";
          $_POST['proyecto'] = "";
          $cadena="";
        } else {

          $sql_pt = "INSERT INTO proyectos_tareas (id_proyecto, id_tarea)
                  VALUES ('$proyecto','$id_tarea')"; //generar query
          $result_pt = mysqli_query($con, $sql_pt); //ejecutar query

          $nombre_tarea = ""; //limpiar campos
          $descripcion = "";
          $fecha_entrega = "";
          $proyecto = "";
          $_POST['nombre_tarea'] = ""; //limpiar campos post
          $_POST['descripcion'] = "";
          $_POST['fecha_entrega'] = "";
          $_POST['proyecto'] = "";
        }
      }

      if( (!empty($colaborador)) && ($colaborador != "0") ){
        $sql_colaborador = "INSERT INTO colaboradores_tareas (id_tarea, id_usuario)
                            VALUES ('$id_tarea','$colaborador')"; //generar query
        $resultado_colaborador = mysqli_query($con, $sql_colaborador); //ejecutar query
    
        notificacion_colaborador($colaborador, $fecha_sistema, $id_tarea, $id, $con, $mysqli); //agregar notificacion de nuevo colaborador
      }
      if( (!empty($colaborador2)) && ($colaborador2 != "0") && ($colaborador2 != $colaborador)){
        $sql_colaborador2 = "INSERT INTO colaboradores_tareas (id_tarea, id_usuario)
                            VALUES ('$id_tarea','$colaborador2')"; //generar query
        $resultado_colaborador2 = mysqli_query($con, $sql_colaborador2); //ejecutar query
         
        notificacion_colaborador($colaborador2, $fecha_sistema, $id_tarea, $id, $con, $mysqli); //agregar notificacion de nuevo colaborador
      }
      if( (!empty($colaborador3)) && ($colaborador3 != "0") &&
          ($colaborador3 != $colaborador) && ($colaborador3 != $colaborador2)){
        $sql_colaborador3 = "INSERT INTO colaboradores_tareas (id_tarea, id_usuario)
                            VALUES ('$id_tarea','$colaborador3')"; //generar query
        $resultado_colaborador3 = mysqli_query($con, $sql_colaborador3); //ejecutar query

        notificacion_colaborador($colaborador3, $fecha_sistema, $id_tarea, $id, $con, $mysqli); //agregar notificacion de nuevo colaborador
      }

      //agregar archivo
      if($_FILES["archivo1"]){ //si se subio un archivo
        $nombre_base = basename($_FILES["archivo1"]["name"]); //obtener el nombre del archivo
        $nombre_final = date("d-m-y")."_".date("H-i-s")."-".$nombre_base; //agregar fecha y hora al nombre
        $ruta = "../archivos_tareas/".$id_tarea."/".$nombre_final;
        
        if(!file_exists("../archivos_tareas/".$id_tarea."/")){ //sino existe la ruta, crearla
            mkdir("../archivos_tareas/".$id_tarea."/"); //crear ruta
        }
        $subirarchivo = move_uploaded_file($_FILES["archivo1"]["tmp_name"], $ruta); //mover el archivo del formulario a la ruta que le indique
        if($subirarchivo){ //si se movio el archivo en la ruta que le indique
           $insertar = "INSERT INTO archivos_tareas(nombre, descripcion, id_tarea) 
                         VALUES ('$nombre_final', '$descripcion_archivo1', '$id_tarea')"; //query
           $resultado = mysqli_query($con, $insertar); //ejecutar query
          
        }
     }

     if($_FILES["archivo2"]){ //si se subio un archivo
      $nombre_base = basename($_FILES["archivo2"]["name"]); //obtener el nombre del archivo
      $nombre_final = date("d-m-y")."_".date("H-i-s")."-".$nombre_base; //agregar fecha y hora al nombre
      $ruta = "../archivos_tareas/".$id_tarea."/".$nombre_final;
      
      if(!file_exists("../archivos_tareas/".$id_tarea."/")){ //sino existe la ruta, crearla
          mkdir("../archivos_tareas/".$id_tarea."/"); //crear ruta
      }
      $subirarchivo = move_uploaded_file($_FILES["archivo2"]["tmp_name"], $ruta); //mover el archivo del formulario a la ruta que le indique
      if($subirarchivo){ //si se movio el archivo en la ruta que le indique
         $insertar = "INSERT INTO archivos_tareas(nombre, descripcion, id_tarea) 
                      VALUES ('$nombre_final', '$descripcion_archivo2', '$id_tarea')"; //query
         $resultado = mysqli_query($con, $insertar); //ejecutar query
         
      }
   }
      echo "<script>swal('Tarea creada exitosamente', '', 'success')</script>";
      Header("Location: tareas.php");
    } else {
      echo "<script>swal('ERROR al registrar tarea', '', 'error')</script>";
    }
  }

?>