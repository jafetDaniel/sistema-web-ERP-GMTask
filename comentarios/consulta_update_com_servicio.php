<?php
//para obtener los datos de una seccion elegida y poder mostrar esos datos en un MODAL
require "../bd/conexion.php"; //llamar a la conexion
$con = conectar(); //llamar al metodo para hacer conexion a la BD

if(isset($_POST['updateid'])){
    $id_comentario_servicio = $_POST['updateid'];

    $sql = "SELECT * FROM comentarios_servicios WHERE id_comentario_servicio=$id_comentario_servicio";
    $result=mysqli_query($con, $sql);
    $response  =array();

    while($row=mysqli_fetch_assoc(($result))){
        $response = $row;
    }
    echo json_encode($response);

}else{
    $response['status']=200;
    $response['message']="datos invalidos o incorrecto";
}