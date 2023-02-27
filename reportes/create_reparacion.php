<?php require_once '../header.php'; ?>
<?php
$con = conectar(); //llamar al metodo para hacer conexion a la BD
$mensaje = "";

if ($_POST) { //si ya se ingresaron los datos
   /*
   addslashes(string $str)
   Devuelve un string con barras invertidas delante de los caracteres 
   que necesitan ser escapados. Estos caracteres son la comilla simple ('), comilla doble ("),
    barra invertida (\) y NUL (el byte null). 
   */
   $planta = addslashes($_POST['planta']);

   $sc_creation_date = addslashes($_POST['sc_creation_date']);
   $date_sc = strtotime($sc_creation_date);
   $date = date('d/m/Y', $date_sc); //modificar formato de fecha

   $shopping_cart_no = addslashes($_POST['shopping_cart_no']);
   $shipper_no = addslashes($_POST['shipper_no']);
   $sc_description = addslashes($_POST['sc_description']);
   $product_description = addslashes($_POST['product_description']);
   $created_by_name = addslashes($_POST['created_by_name']);
   $po_number = addslashes($_POST['po_number']);
   $ir = addslashes($_POST['ir']);
   $vendor_name = addslashes($_POST['vendor_name']);
   $product_type_text = addslashes($_POST['product_type_text']);
   $item_net_value = addslashes($_POST['item_net_value']);
   $document_currency = addslashes($_POST['document_currency']);
   $cost_center = addslashes($_POST['cost_center']);
   $tarea = addslashes($_POST['tarea']);
   $status = addslashes($_POST['status']);
   $observaciones = addslashes($_POST['observaciones']);

   if (
      !empty($planta) && !empty($sc_creation_date) && !empty($shopping_cart_no)
      && !empty($sc_description) && !empty($product_description) && !empty($created_by_name)
      && !empty($po_number) && !empty($vendor_name)
      && !empty($product_type_text) && !empty($item_net_value) && !empty($document_currency)
      && !empty($cost_center) && !empty($status)
   ) { //validar que los campos no esten vacios

      if ($status == ('CERRADO' || 'cerrado')) { //si el status se se establece como CERRADO

      $sql = "INSERT INTO reporte_servicios (planta, sc_creation_date, shopping_cart_no, shipper_no, sc_description,
      product_description, created_by_name, po_number, ir, vendor_name, product_type_text, 
      item_net_value, document_currency, cost_center, tarea, status, observaciones, tipo)
      VALUES ('$planta','$date',' $shopping_cart_no','$shipper_no','$sc_description',
      '$product_description','$created_by_name',' $po_number','$ir','$vendor_name',' $product_type_text',
      '$item_net_value','$document_currency','$cost_center','$tarea','$status','$observaciones', 'REPARACION')"; //generar query

            $result = mysqli_query($con, $sql); //ejecutar query

            if ($result) { //si se ejecuto correctamente el query  

               $ultimo_id = mysqli_insert_id($con); //recibo el último id insertado

               //agregar archivo1
               if ($_FILES["archivo1"]) { //si se subio un archivo
                  $nombre_base = basename($_FILES["archivo1"]["name"]); //obtener el nombre del archivo
                  $nombre_final = date("d-m-y") . "_" . date("H-i-s") . "-" . $nombre_base; //agregar fecha y hora al nombre
                  $ruta = "../archivos_servicios/".$ultimo_id."/".$nombre_final;

                  if (!file_exists("../archivos_servicios/".$ultimo_id."/")) { //sino existe la ruta, crearla
                     mkdir("../archivos_servicios/".$ultimo_id."/"); //crear ruta
                  }
                  $subirarchivo = move_uploaded_file($_FILES["archivo1"]["tmp_name"], $ruta); //mover el archivo del formulario a la ruta que le indique
                  if ($subirarchivo) { //si se movio el archivo en la ruta que le indique
                     $insertar = "INSERT INTO archivos_reporte_servicios(descripcion, id_servicio) VALUES ('$nombre_final', '$ultimo_id')"; //query
                     $resultado_archivo = mysqli_query($con, $insertar); //ejecutar query
                     if ($resultado_archivo) { //si se inserto el archivo en la bd
                        //echo "<script>alert('se ha enviado archivo')</script>";
                     } else {
                        // echo "<script>alert('error al guardar archivo')</script>";
                     }
                  }
               }
               //agregar archivo2
               if ($_FILES["archivo2"]) { //si se subio un archivo
                  $nombre_base = basename($_FILES["archivo2"]["name"]); //obtener el nombre del archivo
                  $nombre_final = date("d-m-y") . "_" . date("H-i-s") . "-" . $nombre_base; //agregar fecha y hora al nombre
                  $ruta = "../archivos_servicios/" . $ultimo_id . "/" . $nombre_final;

                  if (!file_exists("../archivos_servicios/" . $ultimo_id . "/")) { //sino existe la ruta, crearla
                     mkdir("../archivos_servicios/" . $ultimo_id . "/"); //crear ruta
                  }
                  $subirarchivo = move_uploaded_file($_FILES["archivo2"]["tmp_name"], $ruta); //mover el archivo del formulario a la ruta que le indique
                  if ($subirarchivo) { //si se movio el archivo en la ruta que le indique
                     $insertar = "INSERT INTO archivos_reporte_servicios(descripcion, id_servicio) VALUES ('$nombre_final', '$ultimo_id')"; //query
                     $resultado_archivo = mysqli_query($con, $insertar); //ejecutar query
                     if ($resultado_archivo) { //si se inserto el archivo en la bd
                        //echo "<script>alert('se ha enviado archivo')</script>";
                     } else {
                        // echo "<script>alert('error al guardar archivo')</script>";
                     }
                  }
               }

               $planta = ""; //limpiar campos
               $sc_creation_date = "";
               $date_sc = "";
               $date = "";
               $shopping_cart_no = "";
               $shipper_no = "";
               $sc_description = "";
               $product_description = "";
               $created_by_name = "";
               $po_number = "";
               $ir = "";
               $vendor_name = "";
               $product_type_text = "";
               $item_net_value = "";
               $document_currency = "";
               $cost_center = "";
               $tarea = "";
               $status = "";
               $observaciones = "";

               $_POST['planta'] = ""; //limpiar campos post
               $_POST['sc_creation_date'] = "";
               $_POST['shopping_cart_no'] = "";
               $_POST['shipper_no'] = "";
               $_POST['sc_description'] = "";
               $_POST['product_description'] = "";
               $_POST['created_by_name'] = "";
               $_POST['po_number'] = "";
               $_POST['ir'] = "";
               $_POST['vendor_name'] = "";
               $_POST['product_type_text'] = "";
               $_POST['item_net_value'] = "";
               $_POST['document_currency'] = "";
               $_POST['cost_center'] = "";
               $_POST['tarea'] = "";
               $_POST['status'] = "";
               $_POST['observaciones'] = "";

               echo "<script>swal('Reparación agregada exitosamente', '', 'success')</script>";
            } else {
               echo "<script>swal('ERROR al registrar servicio', '', 'error')</script>";
            }

      } else 
        if($status == 'ABIERTO' || 'abierto' ){
         //si el status es abierto
      $sql = "INSERT INTO reporte_servicios (planta, sc_creation_date, shopping_cart_no, shipper_no, sc_description,
      product_description, created_by_name, po_number, ir, vendor_name, product_type_text, 
      item_net_value, document_currency, cost_center, tarea, status, observaciones, tipo)
      VALUES ('$planta','$date',' $shopping_cart_no','$shipper_no','$sc_description',
      '$product_description','$created_by_name',' $po_number','$ir','$vendor_name',' $product_type_text',
      '$item_net_value','$document_currency','$cost_center','$tarea','$status','$observaciones', 'REPARACION')"; //generar query

            $result = mysqli_query($con, $sql); //ejecutar query

            if ($result) { //si se ejecuto correctamente el query  
        
               $planta = ""; //limpiar campos
               $sc_creation_date = "";
               $date_sc = "";
               $date = "";
               $shopping_cart_no = "";
               $shipper_no = "";
               $sc_description = "";
               $product_description = "";
               $created_by_name = "";
               $po_number = "";
               $ir = "";
               $vendor_name = "";
               $product_type_text = "";
               $item_net_value = "";
               $document_currency = "";
               $cost_center = "";
               $tarea = "";
               $status = "";
               $observaciones = "";

               $_POST['planta'] = ""; //limpiar campos post
               $_POST['sc_creation_date'] = "";
               $_POST['shopping_cart_no'] = "";
               $_POST['shipper_no'] = "";
               $_POST['sc_description'] = "";
               $_POST['product_description'] = "";
               $_POST['created_by_name'] = "";
               $_POST['po_number'] = "";
               $_POST['ir'] = "";
               $_POST['vendor_name'] = "";
               $_POST['product_type_text'] = "";
               $_POST['item_net_value'] = "";
               $_POST['document_currency'] = "";
               $_POST['cost_center'] = "";
               $_POST['tarea'] = "";
               $_POST['status'] = "";
               $_POST['observaciones'] = "";

               echo "<script>swal('Reparación agregada exitosamente', '', 'success')</script>";
            } else {
               echo "<script>swal('ERROR al registrar servicio', '', 'error')</script>";
            }
      }//si el status es abierto
   } //validar que los campos no esten vacios

} //POST
?>
<style>
  #pai{
    display: none;
  }
</style>

<!-- Autor: Jafet Daniel Fonseca Garcia -->
<h1 class="mt-4">Registrar nueva Reparación</h1>
<br>
<div class="container mt-3">
   <form action="" method="POST" enctype="multipart/form-data">

      <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Planta:</label>
            <input  type="text" class="form-control" list="planta" name="planta" required style="width: 150px;">
            <datalist id="planta">
              <option value="MXFD">
            </datalist>
          </div>

      <div class="mb-3">
         <label class="form-label">SC Creation Date:</label>
         <input type="date" class="form-control" name="sc_creation_date" required style="width: 150px;">
      </div>

      <div class="mb-3">
         <label class="form-label">Shopping Cart num.:</label>
         <input type="text" class="form-control" name="shopping_cart_no" required>
      </div>

      <div class="mb-3">
         <label class="form-label">Shipper num.:</label>
         <input type="text" class="form-control" name="shipper_no">
      </div>

      <div class="mb-3">
         <label class="form-label">SC Description:</label>
         <input type="text" class="form-control" name="sc_description" required>
      </div>

      <div class="mb-3">
         <label class="form-label">Product Description:</label>
         <input type="text" class="form-control" name="product_description" required>
      </div>

      <div class="mb-3">
         <label class="form-label">Created By Name:</label>
         <input type="text" class="form-control" name="created_by_name" required>
      </div>

      <div class="mb-3">
         <label class="form-label">PO Number:</label>
         <input type="text" class="form-control" name="po_number" required>
      </div>

      <div class="mb-3">
         <label class="form-label">IR:</label>
         <input type="text" class="form-control" name="ir">
      </div>

      <div class="mb-3">
         <label class="form-label">Vendor Name:</label>
         <input type="text" class="form-control" name="vendor_name" required>
      </div>

      <div class="mb-3">
         <label class="form-label">Product Tipe Text:</label>
         <input type="text" class="form-control" name="product_type_text" required>
      </div>

      <div class="mb-3">
         <label class="form-label">Item Net Value:</label>
         <input type="text" class="form-control" name="item_net_value" required>
      </div>

      <div class="mb-3">
         <label class="form-label">Document Currency:</label>
         <input type="text" class="form-control" list="currency" name="document_currency" required>
         <datalist id="currency">
              <option value="MXN">
               <option value="USD">
            </datalist>
      </div>

      <div class="mb-3">
         <label class="form-label">Cost Center:</label>
         <input type="text" class="form-control" name="cost_center" required>
      </div>

      <div class="mb-3">
         <label class="form-label">Tarea:</label>
         <input type="text" class="form-control" name="tarea">
      </div>

      <div class="mb-3">
         <label for="inputState">Status</label>
         <select id="select" class="form-control" name="status" style="width: 150px;">         
            <option value="ABIERTO">ABIERTO</option>
            <option value="CERRADO">CERRADO</option>
         </select>
      </div>

      <div id="pai" class="mb-3">
            <label class="form-label" style="color:orange">Si cambias a status CERRADO es necesario adjuntar el reporte y shipper</label>
            <br>
            <label class="form-label" style="color: orange;">Agregar reporte:</label>
            <input type="file" class="form-control" id="archivo1" name="archivo1">
            <br>
            <label class="form-label " style="color: orange;">Agregar shipper:</label>
            <input type="file" class="form-control" id="archivo2" name="archivo2">
      </div>

      <div class="mb-3">
         <label class="form-label">Observaciones:</label>
         <textarea name="observaciones" type="text" class="form-control"></textarea>
      </div>

      <input type="submit" class="btn btn-primary" value="Agregar" onclick="">
   </form>
</div>

<script>
   $(document).ready(function(){
    $('#select').on('change', function(){
        var selectValor = '#'+$(this).val();

        if(selectValor == "#ABIERTO"){ //si se asigno el status como ABIERTO
            document.querySelector('#archivo1').required = false; //quitar el REQUIRED del input
            document.querySelector('#archivo2').required = false;

            document.getElementById('pai').style.display = 'none';//ocultar div
      
           }else{
            document.querySelector('#archivo1').required = true; //agregar REQUIRED al input
            document.querySelector('#archivo2').required = true;

            document.getElementById('pai').style.display = 'block';//mostrar div
           }
    })
})
</script>
<!-- Autor: Jafet Daniel Fonseca Garcia -->
<?php require_once '../footer.php'; ?>