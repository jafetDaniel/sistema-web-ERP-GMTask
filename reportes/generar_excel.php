<?php
session_start(); //iniciar session de usuario
if(!isset ($_SESSION['id']) ){ //validando si el usuario esta loggeado
    header("Location: ../index.php"); //sino esta loggeado redirigir al home
}

require "../librerias/Spreadsheet/vendor/autoload.php";
require "../bd/conexion.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$sql = "SELECT * FROM reporte_servicios";
$resultado = $mysqli->query($sql);  //guardar consulta

$excel = new Spreadsheet();
$hojaActiva = $excel->getActiveSheet();
$hojaActiva->setTitle("SP SERVICIOS FINAL_CSV");

$hojaActiva->getColumnDimension('A')->setWidth(15);
$hojaActiva->setCellValue('A1','Planta');

$hojaActiva->getColumnDimension('B')->setWidth(15);
$hojaActiva->setCellValue('B1','SC Creation Date');

$hojaActiva->getColumnDimension('C')->setWidth(15);
$hojaActiva->setCellValue('C1','Shopping Cart No.');

$hojaActiva->getColumnDimension('D')->setWidth(15);
$hojaActiva->setCellValue('D1','Shipper No.');

$hojaActiva->getColumnDimension('E')->setWidth(50);
$hojaActiva->setCellValue('E1','SC Description');

$hojaActiva->getColumnDimension('F')->setWidth(50);
$hojaActiva->setCellValue('F1','Product Description');

$hojaActiva->getColumnDimension('G')->setWidth(30);
$hojaActiva->setCellValue('G1','Created By Name');

$hojaActiva->getColumnDimension('H')->setWidth(15);
$hojaActiva->setCellValue('H1','PO Number');

$hojaActiva->getColumnDimension('I')->setWidth(15);
$hojaActiva->setCellValue('I1','IR');

$hojaActiva->getColumnDimension('J')->setWidth(50);
$hojaActiva->setCellValue('J1','Vendor Name');

$hojaActiva->getColumnDimension('K')->setWidth(15);
$hojaActiva->setCellValue('K1','Product Type Text');

$hojaActiva->getColumnDimension('L')->setWidth(15);
$hojaActiva->setCellValue('L1','Item Net Value');

$hojaActiva->getColumnDimension('M')->setWidth(15);
$hojaActiva->setCellValue('M1','Document Currency');

$hojaActiva->getColumnDimension('N')->setWidth(15);
$hojaActiva->setCellValue('N1','Cost Center');

$hojaActiva->getColumnDimension('O')->setWidth(80);
$hojaActiva->setCellValue('O1','Tarea');

$hojaActiva->getColumnDimension('P')->setWidth(15);
$hojaActiva->setCellValue('P1','Status');

$hojaActiva->getColumnDimension('Q')->setWidth(50);
$hojaActiva->setCellValue('Q1','Observaciones');

$hojaActiva->getColumnDimension('A')->setWidth(15);
$hojaActiva->setCellValue('R1','Tipo');

$fila = 2;

while($rows = $resultado->fetch_assoc()){
    $hojaActiva->setCellValue('A'.$fila, $rows['planta']);
    $hojaActiva->setCellValue('B'.$fila, $rows['sc_creation_date']);
    $hojaActiva->setCellValue('C'.$fila, $rows['shopping_cart_no']);
    $hojaActiva->setCellValue('D'.$fila, $rows['shipper_no']);
    $hojaActiva->setCellValue('E'.$fila, $rows['sc_description']);
    $hojaActiva->setCellValue('F'.$fila, $rows['product_description']);
    $hojaActiva->setCellValue('G'.$fila, $rows['created_by_name']);
    $hojaActiva->setCellValue('H'.$fila, $rows['po_number']);
    $hojaActiva->setCellValue('I'.$fila, $rows['ir']);
    $hojaActiva->setCellValue('J'.$fila, $rows['vendor_name']);
    $hojaActiva->setCellValue('K'.$fila, $rows['product_type_text']);
    $hojaActiva->setCellValue('L'.$fila, $rows['item_net_value']);
    $hojaActiva->setCellValue('M'.$fila, $rows['document_currency']);
    $hojaActiva->setCellValue('N'.$fila, $rows['cost_center']);
    $hojaActiva->setCellValue('O'.$fila, $rows['tarea']);
    $hojaActiva->setCellValue('P'.$fila, $rows['status']);
    $hojaActiva->setCellValue('Q'.$fila, $rows['observaciones']);
    $hojaActiva->setCellValue('R'.$fila, $rows['tipo']);
    $fila++;
}
// redirect output to client browser
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ReporteServicios.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($excel, 'Xlsx');
$writer->save('php://output');
exit;
