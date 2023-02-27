<?php require_once '../header.php';?>
<!-- Autor: Jafet Daniel Fonseca Garcia -->
<?php   
    $sql = "SELECT * FROM reporte_servicios"; //generar consulta
    $resultado = $mysqli->query($sql); //guardar consulta
?>

                        <h1 class="mt-4">Reporte de reparaciones y servicios</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="../home.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Reporte</li>
                        </ol>
                        
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Reporte Excel</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" data-bs-toggle="modal" data-bs-target="#modalExcel" data-bs-whatever="@mdo">Generar</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Reporte PDF</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" data-bs-toggle="modal" data-bs-target="#modalPDF" data-bs-whatever="@mdo">Generar</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Enviar Reporte</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" data-bs-toggle="modal" data-bs-target="#modalCorreo" data-bs-whatever="@mdo">Enviar</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Servicios
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Ver</th>
                                            <th>Planta</th>
                                            <th>SC Creation Date</th>
                                            <th>Shopping Cart Num.</th>
                                            <th>Shipper Num.</th>
                                            <th>SC Description</th>
                                            <th>Product Description</th>
                                            <th>Created By Name</th>
                                          
                                            <th>PO Number</th>
                                            <th>IR</th>

                                            <th>Vendor Name</th>
                                            <th>Product Type Text</th>
                                            <th>Item Net Value</th>
                                            <th>Document Currency</th>
                                            <th>Cost Center</th>
                                            <th>Tarea</th>
                                            <th>Status</th>
                                            <th>Observaciones</th>    
                                            <th>Tipo</th>                     
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Ver</th>
                                            <th>Planta</th>
                                            <th>SC Creation Date</th>
                                            <th>Shopping Cart Num.</th>
                                            <th>Shipper Num.</th>
                                            <th>SC Description</th>
                                            <th>Product Description</th>
                                            <th>Created By Name</th>
                                        
                                            <th>PO Number</th>
                                            <th>IR</th>
                                           
                                            <th>Vendor Name</th>
                                            <th>Product Type Text</th>
                                            <th>Item Net Value</th>
                                            <th>Document Currency</th>
                                            <th>Cost Center</th>
                                            <th>Tarea</th>
                                            <th>Status</th>
                                            <th>observaciones</th> 
                                            <th>Tipo</th>      
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                            while($row = mysqli_fetch_array($resultado)){
                                        ?>
                                        <tr>
                                            <td>
                                              <a type="button" href="detalles_reportes.php?id=<?php echo $row['id_servicio'] ?>" class="btn btn-primary">Ver</a>
                                            </td>
                                            <td><?php echo $row['planta']?></td>
                                            <td><?php echo $row['sc_creation_date']?></td>
                                            <td><?php echo $row['shopping_cart_no']?></td>
                                            <td><?php echo $row['shipper_no']?></td>
                                            <td><?php echo $row['sc_description']?></td>
                                            <td><?php echo $row['product_description']?></td>
                                            <td><?php echo $row['created_by_name']?></td>
                                    
                                            <td><?php echo $row['po_number']?></td>
                                            <td><?php echo $row['ir']?></td>
                                
                                            <td><?php echo $row['vendor_name']?></td>
                                            <td><?php echo $row['product_type_text']?></td>
                                            <td><?php echo $row['item_net_value']?></td>
                                            <td><?php echo $row['document_currency']?></td>
                                            <td><?php echo $row['cost_center']?></td>
                                            <td><?php echo $row['tarea']?></td>
                                            <td><?php echo $row['status']?></td>
                                            <td><?php echo $row['observaciones']?></td>
                                            <td><?php echo $row['tipo']?></td>
                                        </tr>
                                        <?php 
                                            }
                                        ?>        
                                    </tbody>
                                </table>
                            </div>
                        </div>

<?php require_once '../footer.php';?>


<!-- MODAL exportar excel MODAL-->
<div class="modal fade" id="modalExcel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Exportar Excel</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="generar_excel.php">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">¿Desea generar archivo Excel?</label>
          </div>     
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <input type="submit" class="btn btn-success" value="Generar">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- MODAL exportar excel MODAL-->


<!-- MODAL exportar PDF MODAL-->
<div class="modal fade" id="modalPDF" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Exportar PDF</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="generar_pdf.php">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">¿Desea generar archivo PDF?</label>
          </div>     
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <input type="submit" class="btn btn-danger" value="Generar">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- MODAL exportar PDF MODAL-->


<!-- MODAL eviar correo MODAL-->
<div class="modal fade" id="modalCorreo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enviar reporte por correo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formCorreo" action="enviar_correo.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Ingrese los datos de envío</label>
          </div>  
            
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Datos de remitente: </label><br>
            <label for="recipient-name" class="col-form-label">Ingrese su nombre:</label>
            <input id="nombre_remitente" name="nombre_remitente" type="text" class="form-control" value="<?php echo $nombre." ".$apellidos?>">
            <label for="recipient-name" class="col-form-label">Ingrese su correo electrónico:</label>
            <input id="correo_remitente" name="correo_remitente" type="email" class="form-control" value="<?php echo $correo?>">
          </div>
          <br>
          <hr style="text-align:left; margin-left:0">
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">Datos de destinatario: </label><br>
            <label for="recipient-name" class="col-form-label">Correo electrónico de destino:</label>
            <input id="correo_destino" name="correo_destino" type="email" class="form-control">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Asunto:</label>
            <input id="asunto" name="asunto" type="text" class="form-control">
          </div> 
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Descripción:</label>
            <textarea id="descripcion" name="descripcion" type="text" class="form-control" rows="10"></textarea>
            <label for="recipient-name" class="col-form-label">** el reporte se adjuntará automaticamente en formato Excel</label>
            <label for="recipient-name" class="col-form-label">Nota: como comprobación, se te enviará una copia a tu correo</label>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <input type="submit" class="btn btn-warning" value="Enviar">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- MODAL eviar correo MODAL-->

<script>
  /* //PARA CORREO ELECTRONICO
  $(function() {
    var url = $("#formCorreo").attr("action"); //obtener url del action

    $("#formCorreo").submit(function(e) { //si se presiono el boton
      e.preventDefault();

          var formData = $("#formCorreo").serializeArray(); //obtener datos de formulario
          $.ajax({
              url: url,
              method: "POST",
              data: formData
            })
            .done(function(r, textStatus, xhr) { //si se logro ejecutar
              if (xhr.status == 200) {
                //swal("correo enviado exitosamente", "", "success");

                document.getElementById("correo_destino").value = ""; //limpiar campos
                document.getElementById("asunto").value = "";
                document.getElementById("descripcion").value = "";

              } else {
                swal("error al enviar correo", "", "error");
              }
            }).fail(function(error) {
              swal('', error.response, 'error');
            });
    
    })
  });*/
</script>
<!-- Autor: Jafet Daniel Fonseca Garcia -->