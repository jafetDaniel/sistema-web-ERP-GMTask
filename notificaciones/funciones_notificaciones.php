<?php
  function notificacion_colaborador($id_colaborador, $fecha_sistema, $id_tarea, $id_user, $con){

    $sql_notificacion = "INSERT INTO notificaciones (tipo, leido, fecha, id_tarea, id_usuario, id_usuario_receptor)
                         VALUES ('Lo agrego como colaborador en una nueva tarea', '0', '$fecha_sistema', '$id_tarea','$id_user', '$id_colaborador')"; //generar query
    $resultado_notificacion = mysqli_query($con, $sql_notificacion); //ejecutar query

    return $resultado_notificacion;
  }

  function notificacion_nuevo_colaborador($id_colaborador, $fecha_sistema, $id_tarea, $id_user, $id_usuario_receptor, $con, $mysqli){

    $sql_colaborador = "SELECT nombre, apellidos FROM usuarios WHERE id_usuario='$id_colaborador'"; //generar consulta
    $resultado_colaborador = $mysqli->query($sql_colaborador); //guardar consulta
    $row_colaborador = mysqli_fetch_array($resultado_colaborador); //ejecutar consulta (fetch devuelve un solo registro)
    $nombre_colaborador =  $row_colaborador['nombre'];
    $apellidos_colaborador =  $row_colaborador['apellidos'];

    $sql_notificacion = "INSERT INTO notificaciones (tipo, leido, fecha, id_tarea, id_usuario, id_usuario_receptor)
                         VALUES ('Agrego a $nombre_colaborador $apellidos_colaborador como nuevo colaborador', '0', '$fecha_sistema', '$id_tarea','$id_user', '$id_usuario_receptor')"; //generar query
    $resultado_notificacion = mysqli_query($con, $sql_notificacion); //ejecutar query

    return $resultado_notificacion;
  }

  function notificacion_creador_tarea($fecha_sistema, $id_tarea, $id_user, $con){
    $sql_notificacion = "INSERT INTO notificaciones (tipo, leido, fecha, id_tarea, id_usuario, id_usuario_receptor)
                         VALUES ('Usted ha credo una nueva tarea', '0', '$fecha_sistema', '$id_tarea','$id_user', '$id_user')"; //generar query
    $resultado_notificacion = mysqli_query($con, $sql_notificacion); //ejecutar query

    return $resultado_notificacion;
  }

  function notificacion_update_datos($fecha_sistema, $id_tarea, $id_user, $id_usuario_receptor, $con){

    $sql_notificacion = "INSERT INTO notificaciones (tipo, leido, fecha, id_tarea, id_usuario, id_usuario_receptor)
                         VALUES ('Modifico los datos de la tarea', '0', '$fecha_sistema', '$id_tarea','$id_user', '$id_usuario_receptor')"; //generar query
    $resultado_notificacion = mysqli_query($con, $sql_notificacion); //ejecutar query

    return $resultado_notificacion;
  }

  function notificacion_update_fecha($fecha_sistema, $id_tarea, $id_user, $id_usuario_receptor, $con){

    $sql_notificacion = "INSERT INTO notificaciones (tipo, leido, fecha, id_tarea, id_usuario, id_usuario_receptor)
                         VALUES ('Modifico la fecha de entrega', '0', '$fecha_sistema', '$id_tarea','$id_user', '$id_usuario_receptor')"; //generar query
    $resultado_notificacion = mysqli_query($con, $sql_notificacion); //ejecutar query
    
    return $resultado_notificacion;
  }

  function notificacion_comentario($fecha_sistema, $id_tarea, $id_user, $id_usuario_receptor,  $con){

    $sql_notificacion = "INSERT INTO notificaciones (tipo, leido, fecha, id_tarea, id_usuario, id_usuario_receptor)
                         VALUES ('Agrego un nuevo comentario', '0', '$fecha_sistema', '$id_tarea','$id_user', '$id_usuario_receptor')"; //generar query
    $resultado_notificacion = mysqli_query($con, $sql_notificacion); //ejecutar query
    
    return $resultado_notificacion;
  }

  function notificacion_archivo($fecha_sistema, $id_tarea, $id_user, $id_usuario_receptor, $con){

    $sql_notificacion = "INSERT INTO notificaciones (tipo, leido, fecha, id_tarea, id_usuario, id_usuario_receptor)
                         VALUES ('Adjunto un nuevo archivo', '0', '$fecha_sistema', '$id_tarea','$id_user', '$id_usuario_receptor')"; //generar query
    $resultado_notificacion = mysqli_query($con, $sql_notificacion); //ejecutar query
    
    return $resultado_notificacion;
  }

  function notificacion_etiqueta_persona($id_persona_etiquetada, $fecha_sistema, $id_tarea, $id_user, $con){

    $sql_notificacion = "INSERT INTO notificaciones (tipo, leido, fecha, id_tarea, id_usuario, id_usuario_receptor)
                         VALUES ('Lo ha etiquetado en un comentario', '0', '$fecha_sistema', '$id_tarea','$id_user', '$id_persona_etiquetada')"; //generar query
    $resultado_notificacion = mysqli_query($con, $sql_notificacion); //ejecutar query
    
    return $resultado_notificacion;
  }
  ?>