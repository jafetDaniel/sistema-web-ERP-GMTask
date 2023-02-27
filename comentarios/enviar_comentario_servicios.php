<?php  
include("../bd/conexion.php");
include("../notificaciones/funciones_notificaciones.php");
$con = conectar();
session_start(); //iniciar session de usuario

if(!isset ($_SESSION['id']) ){ //validando si el usuario esta loggeado
    header("Location: ../index.php"); //sino esta loggeado redirigir al home
}
date_default_timezone_set('America/Mexico_City');  
$fecha_sistema = date('d/m/Y h:i:s a', time());

// Llamando a los campos
$id_servicio = $_GET['id_servicio'];
$id = $_SESSION['id'];  //obtener el id de la sesion del usuario

$comentario= $_POST['comentario'];
$etiqueta_persona = $_POST['etiqueta_persona'];

date_default_timezone_set('America/Mexico_City');  
$fecha = date('d-m-Y h:i:s a', time());  

if (!empty($comentario) ) { //validar que los campos no esten vacios

    if ($etiqueta_persona != "0") {//si se etiqueto a una persona
        $sql_usuario = "SELECT nombre, apellidos FROM usuarios WHERE id_usuario='$etiqueta_persona'"; //generar consulta
        $resultado_usuario = $mysqli->query($sql_usuario); //guardar consulta
        $row_usuario = mysqli_fetch_array($resultado_usuario); //ejecutar consulta (fetch devuelve un solo registro)

        $cadena = "@".$row_usuario['nombre']." ".$row_usuario['apellidos']." - ".$comentario;

        $sql = "INSERT INTO comentarios_servicios (descripcion, fecha, id_servicio, id_usuario)
        VALUES ('$cadena','$fecha', '$id_servicio', '$id')";

       notificacion_etiqueta_persona($etiqueta_persona, $fecha_sistema, $id_servicio, $id, $con);
    } else {
        $sql = "INSERT INTO comentarios_servicios (descripcion, fecha, id_servicio, id_usuario)
        VALUES ('$comentario','$fecha', '$id_servicio', '$id')";
    }//si se etiqueto a una persona

    $query = mysqli_query($con, $sql); //ejecutar consulta

    if ($query) {
        Header("Location: ../reportes/detalles_reportes.php?id=$id_servicio");
    }else{
        echo "error al modificar";
    }
}
?>