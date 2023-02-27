<?php require_once '../header.php'; ?>
<?php
$con = conectar();
$id_r = $_GET['id'];
$sql = "SELECT * FROM reporte_servicios WHERE id_servicio='$id_r'"; //generar consulta
$sql_archivos = "SELECT * FROM archivos_reporte_servicios WHERE id_servicio='$id_r'"; //generar consulta archivos

$resultado = $mysqli->query($sql); //guardar consulta
$resultado_archivos = $mysqli->query($sql_archivos); //guardar consulta de archivos
$num_archivos = $resultado_archivos->num_rows; //si la consulta genero resultados
$row = mysqli_fetch_array($resultado); //ejecutar consulta (fetch devuelve un solo registro)

//para etiquetar a persona en un comentario
$sql_etiqueta_usuario = "SELECT id_usuario, nombre, apellidos, correo FROM usuarios WHERE id_usuario !='$id'"; //generar consulta usuarios para poder agrgar colaborador
$resultado_etiqueta_usuario = $mysqli->query($sql_etiqueta_usuario); //guardar consulta
?>

<!-- Autor: Jafet Daniel Fonseca Garcia -->
<h1 class="mt-4">Detalles</h1>
<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="../home.php">Inicio</a></li>
  <li class="breadcrumb-item"><a href="reportes.php">Reporte</a></li>
  <li class="breadcrumb-item active">Detalles</li>
</ol>

<table class="table table-striped">
  <thead>
    <tr>
      <th>Id_BD <?php echo $id_r ?></th>
      <th>Descripción</th>
    </tr>
  </thead>

  <tbody>
    <tr>
      <td>Planta:</td>
      <td><?php echo $row['planta'] ?></td>
    </tr>

    <tr>
      <td>SC Creation Date: </td>
      <td><?php echo $row['sc_creation_date'] ?></td>
    </tr>

    <tr>
      <td>Shopping Cart num. :</td>
      <td><?php echo $row['shopping_cart_no'] ?></td>
    </tr>

    <tr>
      <td>Shipper num. :</td>
      <td><?php echo $row['shipper_no'] ?></td>
    </tr>

    <tr>
      <td>SC Description:</td>
      <td><?php echo $row['sc_description'] ?></td>
    </tr>

    <tr>
      <td>Product Description:</td>
      <td><?php echo $row['product_description'] ?></td>
    </tr>

    <tr>
      <td>Created By Name:</td>
      <td><?php echo $row['created_by_name'] ?></td>
    </tr>


    <tr>
      <td>PO Number:</td>
      <td><?php echo $row['po_number'] ?></td>
    </tr>

    <tr>
      <td>IR:</td>
      <td><?php echo $row['ir'] ?></td>
    </tr>

    <tr>
      <td>Vendor Name:</td>
      <td><?php echo $row['vendor_name'] ?></td>
    </tr>

    <tr>
      <td>Product Tipe Text:</td>
      <td><?php echo $row['product_type_text'] ?></td>
    </tr>

    <tr>
      <td>Item Net Value:</td>
      <td><?php echo $row['item_net_value'] ?></td>
    </tr>

    <tr>
      <td>Document Currency:</td>
      <td><?php echo $row['document_currency'] ?></td>
    </tr>

    <tr>
      <td>Cost Center:</td>
      <td><?php echo $row['cost_center'] ?></td>
    </tr>

    <tr>
      <td>Tarea:</td>
      <td><?php echo $row['tarea'] ?></td>
    </tr>

    <tr>
      <td>Status:</td>
      <td><?php echo $row['status'] ?></td>
    </tr>

    <tr>
      <td>Observaciones:</td>
      <td><?php echo $row['observaciones'] ?></td>
    </tr>

    <tr>
      <td>Tipo:</td>
      <td><?php echo $row['tipo'] ?></td>
    </tr>

    <tr>
      <td>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalReporte" data-bs-whatever="@mdo">Modificar datos</button>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar" data-bs-whatever="@mdo">Eliminar</button>
      </td>
      <td></td>
    </tr>
  </tbody>
</table>

<!-- TABLA DE ARCHIVOS-->
<br>
<h6 class="mt-4">Archivos adjuntados</h6>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Archivo</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
    while ($row_archivos = mysqli_fetch_array($resultado_archivos)) {
    ?>
      <tr>
        <td>
          <?php
          if ( //si es documento pdf
            str_contains($row_archivos['descripcion'], ".pdf") ||
            str_contains($row_archivos['descripcion'], ".PDF")
          ) { ?>
            <img src="../images/pdf_logo.png" width="20px" height="20px">
          <?php
          } else
            if ( //si es documento word
            str_contains($row_archivos['descripcion'], ".docx") ||
            str_contains($row_archivos['descripcion'], ".DOCX")
          ) { ?>
            <img src="../images/word_logo.png" width="20px" height="20px">
          <?php
          } else
              if ( //si es documento excel
            str_contains($row_archivos['descripcion'], ".xlsx") ||
            str_contains($row_archivos['descripcion'], ".XLSX")
          ) { ?>
            <img src="../images/excel_logo.png" width="20px" height="20px">
          <?php
          }

          echo $row_archivos['descripcion'];

          if (
            str_contains($row_archivos['descripcion'], ".jpg") || //si el archivo es una imagen
            str_contains($row_archivos['descripcion'], ".png") ||
            str_contains($row_archivos['descripcion'], ".JPG") ||
            str_contains($row_archivos['descripcion'], ".PNG")
          ) {
          ?>
            <br>
            <img src="../archivos_servicios/<?php echo $id_r ?>/<?php echo $row_archivos['descripcion'] ?>" width="200px" height="150px">
          <?php
          } //si el archivo es una imagen
          ?>
        </td>

        <td>
          <a type="button" class="btn btn-success" href="../archivos_servicios/<?php echo $row_archivos['id_servicio'] ?>/<?php echo $row_archivos['descripcion'] ?>" target="_blank" rel="noreferrer noopener"><i class="fa-solid fa-eye"></i></a>
          <a type="button" class="btn btn-danger" href="eliminar_archivo.php?id_archivo=<?php echo $row_archivos['id_archivo'] ?>&id_servicio=<?php echo $id_r ?>"><i class="fa-solid fa-trash-can"></i></a>
        </td>
        <td>
      </tr>
    <?php
    }
    ?>
    <tr>
      <td>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalArchivo" data-bs-whatever="@mdo">Agregar nuevo</button>
      </td>
      <td></td>
    </tr>
  </tbody>
</table>


<h5 class="mt-4">Comentarios</h5>
<!-- Comentario section-->
<form method="POST" action="../comentarios/enviar_comentario_servicios.php?id_servicio=<?php echo $id_r ?>">
  <section id="contact">
    <div class="container px-4">
      <div class="row gx-4 justify-content-center">
        <div class="col-lg-8">
          <div class="col-xs-12">
            <?php
            $sql_comentarios = "SELECT * FROM comentarios_servicios WHERE id_servicio='$id_r'"; //generar consulta
            $resultado_comentarios = $mysqli->query($sql_comentarios); //guardar consulta

            while ($row_comentario = mysqli_fetch_array($resultado_comentarios)) {

              $id_usu_comentario = $row_comentario['id_usuario']; //guardar id en variable

              $sql_usu_comentario = "SELECT nombre, apellidos FROM usuarios WHERE id_usuario='$id_usu_comentario'"; //consulta para obtener los datos de la tarea
              $resultado_usu_comentario = $mysqli->query($sql_usu_comentario); //guardar consulta
              $row_usu_comentario = mysqli_fetch_array($resultado_usu_comentario); //ejecutar consulta (fetch devuelve un solo registro)
              $num_usu_comentario = $resultado_usu_comentario->num_rows; //si la consulta genero resultados

              if ($num_usu_comentario > 0) {

                //imagen del perfil usuario
                $sql_imagen_perfil = "SELECT nombre FROM imagenes_perfil WHERE id_usuario='$id_usu_comentario'"; //consulta para obtener imagen de perfil
                $resultado_imagen_perfil = $mysqli->query($sql_imagen_perfil); //guardar consulta
                $row_imagen_perfil = mysqli_fetch_array($resultado_imagen_perfil); //ejecutar consulta (fetch devuelve un solo registro)                         
            ?>
                <b><img src="../<?php echo $row_imagen_perfil['nombre'] ?>" id="image_perfil"></b>
                <b><?php echo $row_usu_comentario['nombre'] ?> <?php echo $row_usu_comentario['apellidos'] ?>
                </b> (<?php echo $row_comentario['fecha'] ?>)
                <?php 
                  if($row_comentario['id_usuario'] == $id){
                ?>
                <a type="button" onclick="GetDetails('<?php echo $row_comentario['id_comentario_servicio'] ?>')" style="color:blue;"><i class="fa-solid fa-pen-to-square"></i></a>
                <a type="button" onclick="Delete('<?php echo $row_comentario['id_comentario_servicio'] ?>')" style="color:red;"><i class="fa-solid fa-trash-can"></i></a>
                <?php 
                  }
                ?>
                <br>
                <?php echo $row_comentario['descripcion'] ?>
                <br>
                <hr>
            <?php
              }
            }
            ?>
            <div class="form-group">
              <label for="comentario" class="form-label">Comentario:</label>

              <div>
                <label for="inputState" class="form-label" style="display:inline;">Etiquetar persona: </label>
                <select id="etiqueta_persona" class="form-control" name="etiqueta_persona" style="width: 400px; display:inline;">
                  <option value="0">ninguna</option>
                  <?php
                  while ($row_u = mysqli_fetch_array($resultado_etiqueta_usuario)) {
                  ?>
                    <option value="<?php echo $row_u['id_usuario'] ?>"><?php echo $row_u['nombre'] ?> - <?php echo $row_u['correo'] ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              
              <textarea class="form-control" name="comentario" id="comentario" cols="30" rows="5" type="text" id="comentario" placeholder="Escribe tu comentario ......" style="margin-top: 10px;"></textarea>
            </div>
            <br>
            <input class="btn btn-primary" type="submit" value="Enviar Comentario">
</form>
</div>
</section>

<?php require_once '../footer.php'; ?>


<!-- MODAL modificar datos MODAL-->
<!--  ltrim — Retira espacios en blanco (u otros caracteres) del inicio de un string -->
<div class="modal fade" id="modalReporte" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar datos del servicio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="update_reporte.php?id=<?php echo $row['id_servicio'] ?>" method="POST" enctype="multipart/form-data" id="formModificar">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Planta:</label>
            <input name="planta" type="text" class="form-control" value="<?php echo ltrim($row['planta']) ?>" required>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">SC Creation Date:</label>
            <input name="sc_creation_date" type="text" class="form-control" value="<?php echo ltrim($row['sc_creation_date']) ?>" required>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Shopping Cart Num. :</label>
            <input name="shopping_cart_no" type="text" class="form-control" value="<?php echo ltrim($row['shopping_cart_no']) ?>" required>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Shipper Num. :</label>
            <input name="shipper_no" type="text" class="form-control" value="<?php echo ltrim($row['shipper_no']) ?>">
          </div>

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">SC Description:</label>
            <input name="sc_description" type="text" class="form-control" value="<?php echo ltrim($row['sc_description']) ?>" required>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Product Description:</label>
            <input name="product_description" type="text" class="form-control" value="<?php echo ltrim($row['product_description']) ?>" required>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Created By Name:</label>
            <input name="created_by_name" type="text" class="form-control" value="<?php echo ltrim($row['created_by_name']) ?>" required>
          </div>

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">PO Number:</label>
            <input name="po_number" type="text" class="form-control" value="<?php echo ltrim($row['po_number']) ?>" required>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">IR:</label>
            <input name="ir" type="text" class="form-control" value="<?php echo ltrim($row['ir']) ?>">
          </div>

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Vendor Name:</label>
            <input name="vendor_name" type="text" class="form-control" value="<?php echo ltrim($row['vendor_name']) ?>" required>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Product Tipe Text:</label>
            <input name="product_type_text" type="text" class="form-control" value="<?php echo ltrim($row['product_type_text']) ?>" required>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Item Net Value:</label>
            <input name="item_net_value" type="text" class="form-control" value="<?php echo ltrim($row['item_net_value']) ?>" required>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Document Currency:</label>
            <input name="document_currency" type="text" class="form-control" value="<?php echo ltrim($row['document_currency']) ?>" required>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Cost Center:</label>
            <input name="cost_center" type="text" class="form-control" value="<?php echo ltrim($row['cost_center']) ?>" required>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Tarea:</label>
            <input name="tarea" type="text" class="form-control" value="<?php echo ltrim($row['tarea']) ?>">
          </div>

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Status:</label>
            <input name="status" id="select" type="text" class="form-control" list="status" value="<?php echo ltrim($row['status']) ?>" required>
            <datalist id="status">
              <option value="ABIERTO">
              <option value="CERRADO">
            </datalist>
          </div>

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Observaciones:</label>
            <textarea name="observaciones" type="text" class="form-control"><?php echo ltrim($row['observaciones']) ?></textarea>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <input type="submit" class="btn btn-primary" value="Actualizar">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- MODAL modificar datos MODAL-->


<!-- MODAL eliminar servicio MODAL-->
<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar servicio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="delete_reporte.php?id=<?php echo $row['id_servicio'] ?>" method="POST">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">¿Esta seguro que desea eliminar este elemento?</label>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <input type="submit" class="btn btn-danger" value="Eliminar">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- MODAL eliminar servicio MODAL-->


<!-- MODAL agregar archivo MODAL-->
<div class="modal fade" id="modalArchivo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar archivo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="agregar_archivo.php?id=<?php echo $row['id_servicio'] ?>" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Adjuntar nuevo archivo:</label>
            <input name="archivo" type="file" class="form-control" required>
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
<!-- MODAL agregar archivo MODAL-->

<!-- MODAL editar comentario MODAL-->
<div class="modal fade" id="modalComentarioUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar comentario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formUpdateComentario">

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Comentario:</label>
                        <input name="descripcion_comentario_update" id="descripcion_comentario_update" type="text" class="form-control">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-primary" value="Modificar">
                        <input type="hidden" id="hiddendata">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- MODAL editar comentario MODAL-->

<!-- MODAL eliminar comentario MODAL-->
<div class="modal fade" id="modalComentarioDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar comentario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formDeleteComentario">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">¿Esta seguro que desea eliminar este comentario?</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-danger" value="Eliminar">
                        <input type="hidden" id="hiddendata2">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- MODAL eliminar comentario MODAL-->

<script>
  $(function() {
    var url = $("#formModificar").attr("action"); //obtener url del action

    $("#formModificar").submit(function(e) { //si se presiono el boton
      e.preventDefault();
      var selectValor = document.getElementById("select").value; //obtener valor de input

      if ((selectValor == "ABIERTO") || (selectValor == "abierto") || (selectValor == "CERRADO") || (selectValor == "cerrado")) {

        if ((selectValor == "ABIERTO") || (selectValor == "abierto")) { //si el status es ABIERTO

          var formData = $("#formModificar").serializeArray(); //obtener datos de formulario
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

        } else { //si el status es CERRADO
          var num = '<?php echo $num_archivos; ?>';

          if (num > 0) { //si hay archivos adjuntados

            var formData = $("#formModificar").serializeArray(); //obtener datos de formulario
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

          } else { //sino se han adjuntado archivos
            swal("ERROR", "si cambia a status CERRADO, primero tiene que adjuntar los archivos del shipper y reporte.\nFavor de adjuntar los archivos antes de continuar", "error");
          } //sino se han adjuntado archivos


        } //si el status es CERRADO
      } else { //si el status es CERRADO o ABIERTO
        swal("ERROR", "ingrese un status valido (ABIERTO/CERRADO)", "error");
      } //si el status es CERRADO O ABIERTO

    })
  });
</script>

<script>
        function GetDetails(updateid) { //funcion para obtener datos de una seccion elegida y mostrarlos en modal
        $('#hiddendata').val(updateid); //ponerle de texto el id al input oculto del modal

        $.post("../comentarios/consulta_update_com_servicio.php", {
            updateid: updateid
        }, function(data, status) {
            var userid = JSON.parse(data); //guardar consulta extraida
            $('#descripcion_comentario_update').val(userid.descripcion); //mostrar valor en input
        });
        $('#modalComentarioUpdate').modal('show'); //mostrar modal
    }

    $("#formUpdateComentario").submit(function(e) { //si se presiono el boton
        e.preventDefault();
        var id = $('#hiddendata').val(); //obteenr id
        var descripcion_comentario_update = $('#descripcion_comentario_update').val(); //obtener nombre

        $.post("../comentarios/update_comentario_servicio.php", { //llamar a pagina update
            id_comentario_servicio: id, //pasando paramatros
            descripcion: descripcion_comentario_update
        }, function(data, status) {
            location.reload(true); //recargar la pagina
        });
    })

    function Delete(updateid) {
        $('#hiddendata2').val(updateid); //ponerle de texto el id al input oculto del modal
        $('#modalComentarioDelete').modal('show'); //mostrar modal
    }

    $("#formDeleteComentario").submit(function(e) { //si se presiono el boton
        e.preventDefault();
        var id = $('#hiddendata2').val(); //obteenr id

        $.post("../comentarios/delete_comentario_servicio.php", { //llamar a pagina update
            id_comentario_servicio: id //pasando paramatros
        }, function(data, status) {
            location.reload(true); //recargar la pagina
        });
    })
</script>
<!-- Autor: Jafet Daniel Fonseca Garcia -->