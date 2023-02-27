<?php
include("../bd/conexion.php");
$con = conectar();

session_start(); //iniciar session de usuario
if(!isset ($_SESSION['id']) ){ //validando si el usuario esta loggeado
        header("Location: ../index.php"); //sino esta loggeado redirigir al home
    }
$id = $_SESSION['id']; //obtener id del usuario

$sql_anterior = "SELECT nombre FROM imagenes_perfil WHERE id_usuario='$id'"; //generar consulta imagen perfil
$resultado_anterior = $mysqli->query($sql_anterior); //guardar consulta
$row_anterior = mysqli_fetch_array($resultado_anterior); //ejecutar consulta (fetch devuelve un solo registro)

        //agregar archivo
      if($_FILES["archivo_imagen"]){ //si se subio un archivo
        $nombre_base = basename($_FILES["archivo_imagen"]["name"]); //obtener el nombre del archivo
        $nombre_final = date("d-m-y")."_".date("H-i-s")."-".$nombre_base; //agregar fecha y hora al nombre
        $ruta = "archivos_imagenes_perfil/".$id."/".$nombre_final;
        
        if(!file_exists("../archivos_imagenes_perfil/".$id."/")){ //sino existe la ruta, crearla
            mkdir("../archivos_imagenes_perfil/".$id."/"); //crear ruta
        }
        $subirarchivo = move_uploaded_file($_FILES["archivo_imagen"]["tmp_name"], "../".$ruta); //mover el archivo del formulario a la ruta que le indique
        
        if($subirarchivo){ //si se movio el archivo en la ruta que le indique
           
            $nombre=$_POST['nombre'];
            $sql="UPDATE imagenes_perfil SET nombre='$ruta' WHERE id_usuario='$id'";
            $query=mysqli_query($con,$sql);

            $ruta = "../".$row_anterior['nombre'];
            
            if($ruta != "../images/perfil.jpg"){ //sino es la imagen por defecto
                unlink($ruta); //eliminar archivo
            }
            
        }
     }

        if($query){
                Header("Location: usuarios.php");
            }

?>