<?php
require "../bd/conexion.php"; //llamar a la conexion
session_start(); //iniciar session de usuario

if (!isset($_SESSION['id'])) { //validando si el usuario esta loggeado
  header("Location: ../index.php"); //sino esta loggeado redirigir al home
}
$nombre = $_SESSION['nombre']; //obtener el nombre del usuario
$id = $_SESSION['id']; //obtener id del usuario

$sql = "SELECT id_usuario, nombre, apellidos, correo, password  FROM usuarios WHERE id_usuario = '$id'"; //generar consulta
$resultado = $mysqli->query($sql); //guardar consulta
$num = $resultado->num_rows; //si la consulta genero resultados
$row = mysqli_fetch_array($resultado);

$sql_imagen = "SELECT nombre FROM imagenes_perfil WHERE id_usuario='$id'"; //generar consulta imagen perfil
$resultado_imagen = $mysqli->query($sql_imagen); //guardar consulta
$row_imagen = mysqli_fetch_array($resultado_imagen); //ejecutar consulta (fetch devuelve un solo registro)
?>
<!-- Autor: Jafet Daniel Fonseca Garcia -->
<!DOCTYPE html>
<html lang="es">

<head>
  <title>Configuración de usuario</title>
  <meta name="author" content="jafet daniel fonseca garcia" />
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../librerias/bootstrap5.css" rel="stylesheet">
  <link href="../librerias/jsdelivr_simple_datatables_dist_style.css" rel="stylesheet" />
  <link href="../css/styles.css" rel="stylesheet" />
  <script src="../librerias/fontawesome.js"></script>
  <script src="../librerias/jquery.js"></script>
  <script src="../librerias/sweetalert.js"></script>
</head>

<style>
#imagen_perfil{
  margin-top: 30px;
  width: 200px;
  height: 200px;
  border-radius: 100px;
}
</style>

<body>
  <div class="container mt-5">
    <div class="row">
      <h1>Configuración de Usuario</h1>
      <br>
      <div class="col-md-8">
        <img id="imagen_perfil" src="../<?php echo $row_imagen['nombre'] ?>">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalImagen" data-bs-whatever="@mdo"><i class="fa-solid fa-pen-to-square"></i></button>
      </div>

      <div class="col-md-8" style="margin-top: 20px;">
        <table class="table">
          <thead class="table-success table-striped">
            <tr>
              <th>Datos personales</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>Nombre: <?php echo $row['nombre'] ?></th>
              <th>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNombre" data-bs-whatever="@mdo">Editar</button>
              </th>
            </tr>
            <tr>
              <th>Apellidos: <?php echo $row['apellidos'] ?></th>
              <th>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalApellidos" data-bs-whatever="@mdo">Editar</button>
              </th>
            </tr>
            <tr>
              <th>Correo: <?php echo $row['correo'] ?></th>
              <th>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCorreo" data-bs-whatever="@mdo">Editar</button>
              </th>
            </tr>
            <tr>
              <th>Contraseña: *****</th>
              <th>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalContraseña" data-bs-whatever="@mdo">Editar</button>
              </th>
            </tr>
          </tbody>
        </table>
        <a href="../home.php" class="btn btn-secondary" style="margin-top: 20px;">Regresar</a></th>
      </div>
    </div>
  </div>

  <!-- MODAL PARA EDITAR NOMBRE-->
  <div class="modal fade" id="modalNombre" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modificar nombre</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="update_nombre.php" method="POST">
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Nombre:</label>
              <input name="nombre" type="text" class="form-control" value="<?php echo $row['nombre'] ?>" required>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <input type="submit" class="btn btn-primary" value="Modificar">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- MODAL PARA EDITAR NOMBRE-->

  <!-- MODAL PARA EDITAR APELLIDOS -->
  <div class="modal fade" id="modalApellidos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modificar apellidos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="update_apellidos.php" method="POST">
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Apellidos:</label>
              <input name="apellidos" type="text" class="form-control" value="<?php echo $row['apellidos'] ?>" required>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <input type="submit" class="btn btn-primary" value="Modificar">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- MODAL PARA EDIAR APELLIDOS -->

  <!-- MODAL PARA EDITAR CORREO -->
  <div class="modal fade" id="modalCorreo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modificar correo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="update_correo.php" method="POST">
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Correo:</label>
              <input name="correo" type="text" class="form-control" value="<?php echo $row['correo'] ?>" required>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <input type="submit" class="btn btn-primary" value="Modificar">
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
  <!-- MODAL PARA EDITAR CORREO-->


  <!-- MODAL PARA EDITAR CONTRASEÑA -->
  <div class="modal fade" id="modalContraseña" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modificar contraseña</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="update_password.php" method="POST" id="formContraseña">
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Ingrese contraseña nueva:</label>
              <input name="password" id="password" type="password" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Repita su nueva contraseña:</label>
              <input name="password_rep" id="password_rep" type="password" class="form-control" required>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <input type="submit" class="btn btn-primary" value="Modificar">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- MODAL PARA EDITAR CONTRASEÑA -->


  <!-- MODAL PARA EDITAR IMAGEN DE PERFIL -->
<div class="modal fade" id="modalImagen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar imagen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form  id="formImagen" action="update_imagen_perfil.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Adjuntar imagen:</label>
            <input name="archivo_imagen" id="archivo_imagen" type="file" class="form-control">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <input type="submit" class="btn btn-primary" value="Agregar">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- MODAL PARA EDITAR IMAGEN DE PERFIL -->

  <script src="../librerias/bootstrap.js"></script>
  <script src="../js/scripts.js"></script>
  <script src="../librerias/ajax_chart.js"></script>
  <script src="../demo/chart-area-demo.js"></script>
  <script src="../demo/chart-bar-demo.js"></script>
  <script src="../librerias/jsdelivr_simple_datatables.js"></script>
  <script src="../js/datatables-simple-demo.js"></script>
</body>
</html>

<script>
  //para validar cuando se modifica la contraseña
  $(function() {
    var url = $("#formContraseña").attr("action"); //obtener url del action

    $("#formContraseña").submit(function(e) { //si se presiono el boton
      e.preventDefault();

      var selectValor1 = document.getElementById("password").value; //obtener valor de input
      var selectValor2 = document.getElementById("password_rep").value; //obtener valor de input


      if (selectValor1 !="" && selectValor2 !="") {

        if (selectValor1 == selectValor2) {

          var formData = $("#formContraseña").serializeArray(); //obtener datos de formulario
          $.ajax({
              url: url,
              method: "POST",
              data: formData
            })
            .done(function(r, textStatus, xhr) { //si se logro ejecutar
              if (xhr.status == 200) {
                location.reload(true); //recargar la pagina
              } else {
                swal("error al enviar datos", "", "error");
              }
            }).fail(function(error) {
              swal('', error.response, 'error');
            });

        } else {
          swal("ERROR", "las contraseñas no coinciden", "error");

        }
      } else {
        swal("ERROR", "campos vacios", "error");
      }
    })
  });
</script>


<script>
  //para validar cuando se modifica la imagen de perfil
  $(function() {
    var url = $("#formImagen").attr("action"); //obtener url del action

    $("#formImagen").submit(function(e) { //si se presiono el boton
      e.preventDefault();

      var input = document.getElementById("archivo_imagen").value; //obtener valor de input

      if (input != "") {
        if ( input.endsWith(".jpg") || input.endsWith(".png") || input.endsWith(".JPG") || input.endsWith(".PNG")) {

          let data = new FormData($('#formImagen')[0]); //obtener datos de formulario tipo archivo (File)

          $.ajax({
              url: url,
              method: "POST",
              data: data,
              contentType: false, //para archivos
              processData: false //para archivos
            })
            .done(function(r, textStatus, xhr) { //si se logro ejecutar
              if (xhr.status == 200) {
                location.reload(true); //recargar la pagina
              } else {
                swal("error al enviar datos", "", "error");
              }
            }).fail(function(error) {
              swal('', error.response, 'error');
            });

        } else {
          swal("ERROR, Formato invalido", "el archivo debe tener extensión .jpg/.png", "error");
        }
      } else {
        swal("ERROR", "campos vacios", "error");
      }
    })
  });
</script>
<!-- Autor: Jafet Daniel Fonseca Garcia -->