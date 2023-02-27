<?php require_once '../header.php'; ?>
<?php
$con = conectar(); //llamar al metodo para hacer conexion a la BD

$sql = "SELECT * FROM proyectos WHERE id_usuario='$id' OR privacidad ='PUBLICO'"; //generar consulta proyectos
$resultado = $mysqli->query($sql); //guardar consulta proyectos

$sql_usuarios = "SELECT id_usuario, nombre, apellidos, correo FROM usuarios WHERE id_usuario !='$id'"; //generar consulta usuarios para poder agrgar colaborador
$resultado_usuarios = $mysqli->query($sql_usuarios); //guardar consulta

$sql_usuarios2 = "SELECT id_usuario, nombre, apellidos, correo FROM usuarios WHERE id_usuario !='$id'"; //generar consulta usuarios para poder agrgar colaborador
$resultado_usuarios2 = $mysqli->query($sql_usuarios2); //guardar consulta

$sql_usuarios3 = "SELECT id_usuario, nombre, apellidos, correo FROM usuarios WHERE id_usuario !='$id'"; //generar consulta usuarios para poder agrgar colaborador
$resultado_usuarios3 = $mysqli->query($sql_usuarios3); //guardar consulta
?>
<!-- Autor: Jafet Daniel Fonseca Garcia -->
<style>
  #responsable2{
    display: none;
  }
  #responsable3{
    display: none;
  }
</style>

<h1 class="mt-4">Crear nueva Tarea</h1>
<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="tareas.php">Mis Tareas</a></li>
  <li class="breadcrumb-item active">Nueva Tarea</li>
</ol>

<div class="container mt-3">
  <form action="createBD_tarea.php" method="POST" enctype="multipart/form-data">

    <div class="mb-3">
      <label for="recipient-name" class="col-form-label">Nombre de la tarea:</label>
      <input type="text" class="form-control" name="nombre_tarea" required style="width: 400px;">
    </div>

    <div class="mb-3">
      <label for="recipient-name" class="col-form-label">Agregar Colaboador:</label>
      <br>
            <select id="responsable" class="form-control" name="responsable" style="width: 400px; display: inline-block;">
            <option value="0">sin colaborador</option>
              <?php
                while ($row_usuarios = mysqli_fetch_array($resultado_usuarios)) {
              ?>
              <option value="<?php echo $row_usuarios['id_usuario']?>"><?php echo $row_usuarios['nombre']?> - <?php echo $row_usuarios['correo'] ?></option>
              <?php
                 }
              ?>
            </select>
            <button id="mas_responsable" onclick="masResponsables()" class="btn btn-primary" style="display: inline-block;"><i class="fa-solid fa-plus"></i></button>
             
            <select id="responsable2" name="responsable2" class="form-control" style="width: 400px; margin-bottom: 3px;">
            <option value="0">sin colaborador</option>
              <?php
                while ($row_usuarios2 = mysqli_fetch_array($resultado_usuarios2)) {
              ?>
              <option value="<?php echo $row_usuarios2['id_usuario']?>"><?php echo $row_usuarios2['nombre']?> - <?php echo $row_usuarios2['correo'] ?></option>
              <?php
                 }
              ?>
            </select>
            <select id="responsable3" name="responsable3" class="form-control" style="width: 400px;">
            <option value="0">sin colaborador</option>
              <?php
                while ($row_usuarios3 = mysqli_fetch_array($resultado_usuarios3)) {
              ?>
              <option value="<?php echo $row_usuarios3['id_usuario']?>"><?php echo $row_usuarios3['nombre']?> - <?php echo $row_usuarios3['correo'] ?></option>
              <?php
                 }
              ?>
            </select>
    </div>

    <div class="mb-3">
      <label for="recipient-name" class="col-form-label">Descripcion:</label>
      <textarea  type="text" class="form-control" name="descripcion" rows="5" style="width: 400px;"></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Fecha de Entrega:</label>
      <input type="date" class="form-control" name="fecha_entrega" required style="width: 150px;">
    </div>

         <div class="mb-3">
            <label class="form-label">Adjunar Archivos</label>
            <br>
            <input type="file" class="form-control" name="archivo1" style="width: 400px; display: inline-block;">
            <input type="text" class="form-control" name="descripcion_archivo1" placeholder="descripcion del archivo adjuntado" style="width: 350px; display: inline-block;"> 
            <br><br>
            <input type="file" class="form-control" name="archivo2" style="width: 400px; display: inline-block;">    
            <input type="text" class="form-control" name="descripcion_archivo2" placeholder="descripcion del archivo adjuntado" style="width: 350px; display: inline-block;">      
         </div>

    <div class="mb-3">
      <label for="inputState">Asignar a Proyecto:</label>
      <select id="select" class="form-control" name="proyecto" style="width: 400px;">
        <option value="SIN PROYECTO">SIN PROYECTO</option>
        <?php
        while ($row = mysqli_fetch_array($resultado)) {
        ?>
          <option value="<?php echo $row['id_proyecto'] ?>"><?php echo $row['nombre'] ?></option>
        <?php
        }
        ?>
      </select>
    </div>
    <input type="submit" class="btn btn-primary" value="Crear">
  </form>
</div>

<?php require_once '../footer.php'; ?>


<script>
   var  bandera=true;
  function masResponsables(){

    if(bandera == true){
      document.getElementById('responsable2').style.display='block';
      document.getElementById('responsable3').style.display='block';
      bandera = false;
    }else{
      document.getElementById('responsable2').style.display='none';
      document.getElementById('responsable3').style.display='none';
      bandera = true;
    }
  
  }
</script>
<!-- Autor: Jafet Daniel Fonseca Garcia -->