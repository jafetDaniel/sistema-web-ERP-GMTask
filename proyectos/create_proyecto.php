<?php require_once '../header.php'; ?>
<?php
$con = conectar(); //llamar al metodo para hacer conexion a la BD

$sql_usuarios = "SELECT id_usuario, nombre, apellidos, correo FROM usuarios WHERE id_usuario !='$id'"; //generar consulta usuarios para poder agrgar colaborador
$resultado_usuarios = $mysqli->query($sql_usuarios); //guardar consulta

$sql_usuarios2 = "SELECT id_usuario, nombre, apellidos, correo FROM usuarios WHERE id_usuario !='$id'"; //generar consulta usuarios para poder agrgar colaborador
$resultado_usuarios2 = $mysqli->query($sql_usuarios2); //guardar consulta

$sql_usuarios3 = "SELECT id_usuario, nombre, apellidos, correo FROM usuarios WHERE id_usuario !='$id'"; //generar consulta usuarios para poder agrgar colaborador
$resultado_usuarios3 = $mysqli->query($sql_usuarios3); //guardar consulta

if ($_POST) { //si ya se ingresaron los datos
  $nombre = addslashes($_POST['nombre']);
  $privacidad = addslashes($_POST['privacidad']);

  $miembro1 = addslashes($_POST['select_miembro1']);
  $miembro2 = addslashes($_POST['select_miembro2']);
  $miembro3 = addslashes($_POST['select_miembro3']);

  if (!empty($nombre) && !empty($privacidad)) { //validar que los campos no esten vacios

      $sql = "INSERT INTO proyectos (nombre, correo_creador, privacidad, id_usuario)
              VALUES ('$nombre','$correo','$privacidad', '$id')"; //generar query para registrar nuevo proyecto

            $result = mysqli_query($con, $sql); //ejecutar query

            $id_proyecto =  mysqli_insert_id($con); //obtener ultimo id
            $sql_seccion = "INSERT INTO secciones_proyecto (nombre, id_proyecto)
            VALUES ('mi sección','$id_proyecto')"; //generar query para insertar seccion en  proyecto
             $result_seccion = mysqli_query($con, $sql_seccion); //ejecutar query


            if ($result && $result_seccion) { //si se ejecuto correctamente el query 

              $sql_miembro0 = "INSERT INTO colaboradores_proyectos (id_proyecto, id_usuario)
              VALUES ('$id_proyecto','$id')"; //generar query
              $resultado_membro0 = mysqli_query($con, $sql_miembro0); //ejecutar query

              if( (!empty($miembro1)) && ($miembro1 != "0") ){
                $sql_miembro1 = "INSERT INTO colaboradores_proyectos (id_proyecto, id_usuario)
                                    VALUES ('$id_proyecto','$miembro1')"; //generar query
                $resultado_membro1 = mysqli_query($con, $sql_miembro1); //ejecutar query
              
              }
              if( (!empty($miembro2)) && ($miembro2 != "0") && ($miembro2 != $miembro1)){
        
                    $sql_miembro2 = "INSERT INTO colaboradores_proyectos (id_proyecto, id_usuario)
                    VALUES ('$id_proyecto','$miembro2')"; //generar query
                    $resultado_membro2 = mysqli_query($con, $sql_miembro2); //ejecutar query   
              }
              if( (!empty($miembro3)) && ($miembro3 != "0") &&
                  ($miembro3 != $miembro1) && ($miembro3 != $miembro2)){
                
                    $sql_miembro3 = "INSERT INTO colaboradores_proyectos (id_proyecto, id_usuario)
                    VALUES ('$id_proyecto','$miembro3')"; //generar query
                    $resultado_membro3 = mysqli_query($con, $sql_miembro3); //ejecutar query
              }
              
               $nombre = ""; //limpiar campos
               $privacidad = "";
               $id_proyecto="";
               $_POST['nombre'] = ""; //limpiar campos post
               $_POST['privacidad'] = "";
            
               echo "<script>swal('Proyecto creado exitosamente', '', 'success')</script>";
            }else{            
                echo "<script>swal('ERROR al registrar proyecto', '', 'error')</script>";
            }
  }
} //POST
?>
<style>
  #pai{
    display: none;
  }
</style>

<!-- Autor: Jafet Daniel Fonseca Garcia -->
<h1 class="mt-4">Crear nuevo Proyecto</h1>
<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="proyectos.php">Mis proyectos</a></li>
  <li class="breadcrumb-item active">Nuevo proyecto</li>
</ol>

<div class="container mt-3">
  <form action="" method="POST">

    <div class="mb-3">
      <label for="recipient-name" class="col-form-label">Nombre del proyecto:</label>
      <input type="text" class="form-control"  name="nombre" required style="width: 300px;">
    </div>

    <div class="mb-3">
      <label for="inputState">Privacidad</label>
      <select id="select" class="form-control" name="privacidad" required style="width: 300px;">
      <option value="PUBLICO">PUBLICO</option>
      <option value="PRIVADO">PRIVADO</option>  
      </select>
    </div>

    <div class="mb-3" id="pai">
      <label for="inputState">Agregar miembros a proyecto privado</label>
      <select id="select_miembro1" class="form-control" name="select_miembro1" required style="width: 300px;">
        <option value="0">ninguno</option>
        <?php
                while ($row_usuarios = mysqli_fetch_array($resultado_usuarios)) {
              ?>
              <option value="<?php echo $row_usuarios['id_usuario']?>"><?php echo $row_usuarios['nombre']?> - <?php echo $row_usuarios['correo'] ?></option>
              <?php
                 }
              ?>
      </select>
      <select id="select_miembro2" class="form-control" name="select_miembro2" required style="width: 300px;">
        <option value="0">ninguno</option>
        <?php
                while ($row_usuarios2 = mysqli_fetch_array($resultado_usuarios2)) {
              ?>
              <option value="<?php echo $row_usuarios2['id_usuario']?>"><?php echo $row_usuarios2['nombre']?> - <?php echo $row_usuarios2['correo'] ?></option>
              <?php
                 }
              ?>
      </select>
      <select id="select_miembro3" class="form-control" name="select_miembro3" required style="width: 300px;">
        <option value="0">ninguno</option>
        <?php
                while ($row_usuarios3 = mysqli_fetch_array($resultado_usuarios3)) {
              ?>
              <option value="<?php echo $row_usuarios3['id_usuario']?>"><?php echo $row_usuarios3['nombre']?> - <?php echo $row_usuarios3['correo'] ?></option>
              <?php
                 }
              ?>
      </select>
    </div>

    <input type="submit" class="btn btn-primary" value="Crear">
  </form>
</div>

<script>
   $(document).ready(function(){
    $('#select').on('change', function(){
        var selectValor = '#'+$(this).val(); //obtener value de select

        if(selectValor == "#PRIVADO"){
          document.getElementById('pai').style.display = 'block';//mostrar div
        }else
        if(selectValor == "#PUBLICO"){
          document.getElementById('pai').style.display = 'none';//ocultar div
        }
    })
})
</script>

<!-- Autor: Jafet Daniel Fonseca Garcia -->
<?php require_once '../footer.php'; ?>