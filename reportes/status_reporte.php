<?php require_once '../header.php';?>
<?php 
    $sql = "SELECT * FROM reporte_servicios WHERE status LIKE '%abiert%' OR status LIKE '%ABIERT%'"; //si el status es ABIERTO
    $resultado = $mysqli->query($sql); //guardar consulta

    $sql_cerrado = "SELECT * FROM reporte_servicios WHERE status LIKE '%cerrad%' OR status LIKE '%CERRAD%'"; //si el status es CERRADO
    $resultado_cerrado = $mysqli->query($sql_cerrado); //guardar consulta
?>
<!-- Autor: Jafet Daniel Fonseca Garcia -->
                        <h1 class="mt-4">Status de servicios</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="../home.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Status</li>
                        </ol>
                        
                        <h1 class="mt-4">Servicios Abiertos</h1>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Servicios activos
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr class="bg-success">
                                            <th>Ver</th>
                                            <th>Planta</th>
                                            <th>SC Creation Date</th>
                                            <th>Shopping Cart No.</th>
                                            <th>SC Description</th>
                                            <th>Product Description</th>
                                            <th>Status</th>                
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Ver</th>
                                            <th>Planta</th>
                                            <th>SC Creation Date</th>
                                            <th>Shopping Cart No.</th>
                                            <th>SC Description</th>
                                            <th>Product Description</th>                                          
                                            <th>Status</th>                                 
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
                                            <td><?php echo $row['sc_description']?></td>
                                            <td><?php echo $row['product_description']?></td>
                                            
                                            <td class="bg-success"><?php echo $row['status']?></td>                                          
                                        </tr>
                                        <?php 
                                            }
                                        ?>        
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <h1 class="mt-4">Servicios Cerrados</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Servicios inactivos
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple2">
                                    <thead>
                                        <tr class="bg-danger">
                                            <th>Ver</th>
                                            <th>Planta</th>
                                            <th>SC Creation Date</th>
                                            <th>Shopping Cart No.</th>
                                            <th>SC Description</th>
                                            <th>Product Description</th>
                                            <th>Status</th>                  
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                    <?php
                                            while($row_cerrado = mysqli_fetch_array($resultado_cerrado)){
                                        ?>
                                        <tr>
                                            <td>
                                              <a type="button" href="detalles_reportes.php?id=<?php echo $row_cerrado['id_servicio'] ?>" class="btn btn-primary">Ver</a>
                                            </td>
                                            <td><?php echo $row_cerrado['planta']?></td>
                                            <td><?php echo $row_cerrado['sc_creation_date']?></td>
                                            <td><?php echo $row_cerrado['shopping_cart_no']?></td>
                                            <td><?php echo $row_cerrado['sc_description']?></td>
                                            <td><?php echo $row_cerrado['product_description']?></td>
                                            
                                            <td class="bg-danger"><?php echo $row_cerrado['status']?></td>
                                        </tr>
                                        <?php 
                                            }
                                        ?>        
                                    </tbody>
                                </table>
                            </div>
                        </div>
<!-- Autor: Jafet Daniel Fonseca Garcia -->
<?php require_once '../footer.php';?>


