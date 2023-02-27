<?php
session_start(); //iniciar session de usuario
if(!isset ($_SESSION['id']) ){ //validando si el usuario esta loggeado
    header("Location: ../index.php"); //sino esta loggeado redirigir al home
}

require('../librerias/fpdf184/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    //$this->Image('../images/fondo_carta.jpg', 0,0,210);      
    $this->Image('../images/gm_logo.jpg', 10,5,20); //x,y,tamaño
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(70,10,'Reporte de servicios',0,0,'C');
    // Salto de línea
    $this->Ln(20);

    
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Pagina '.$this->PageNo(),0,0,'C');
}
}

require "../bd/conexion.php"; //llamar a la conexion
$sql = "SELECT * FROM reporte_servicios"; //generar consulta
$resultado = $mysqli->query($sql); //guardar consulta

$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',9);
$pdf->SetFillColor( 116, 203, 238); //color de fondo
//$pdf->SetDrawColor(); //color de lineas

while ($row = mysqli_fetch_array($resultado)) {

    $pdf->Cell(40,10,'po_number', 1, 0,'',1);
    $pdf->Cell(150,10, $row['po_number'], 1, 1,'',0);

    $pdf->Cell(40,13, 'sc_description', 1, 0,'',1);
    $pdf->Cell(150,13, $row['sc_description'], 1, 1,'',0);

    $pdf->Cell(40,13, 'product_description', 1, 0,'',1);
    $pdf->Cell(150,13, $row['product_description'], 1, 1,'',0);

    $pdf->Cell(40,13,'created_by_name', 1, 0,'',1);
    $pdf->Cell(150,13, $row['created_by_name'], 1, 1,'',0);

    $pdf->Cell(40,13, 'ir', 1, 0,'',1);
    $pdf->Cell(150,13, $row['ir'], 1, 1,'',0);

    $pdf->Cell(40,13, 'planta', 1, 0,'',1);
    $pdf->Cell(150,13, $row['planta'], 1, 1,'',0);

    $pdf->Cell(40,13,'sc_creation_date', 1, 0,'',1);
    $pdf->Cell(150,13, $row['sc_creation_date'], 1, 1,'',0);

    $pdf->Cell(40,13, 'shopping_cart_no', 1, 0,'',1);
    $pdf->Cell(150,13, $row['shopping_cart_no'], 1, 1,'',0);

    $pdf->Cell(40,13, 'shipper_no', 1, 0,'',1);
    $pdf->Cell(150,13, $row['shipper_no'], 1, 1,'',0);

    $pdf->Cell(40,13, 'vendor_name', 1, 0,'',1);
    $pdf->Cell(150,13, $row['vendor_name'], 1, 1,'',0);

    $pdf->Cell(40,15, 'product_type_text', 1, 0,'',1);
    $pdf->Cell(150,15, $row['product_type_text'], 1, 1,'',0);

    $pdf->Cell(40,13, 'item_net_value', 1, 0,'',1);
    $pdf->Cell(150,13, $row['item_net_value'], 1, 1,'',0);

    $pdf->Cell(40,13, 'document_currency', 1, 0,'',1);
    $pdf->Cell(150,13, $row['document_currency'], 1, 1,'',0);

    $pdf->Cell(40,13,'cost_center', 1, 0,'',1);
    $pdf->Cell(150,13, $row['cost_center'], 1, 1,'',0);

    $pdf->Cell(40,20, 'tarea', 1, 0,'',1);
    $pdf->Cell(150,20,  $row['tarea'], 1, 1,'',0);

    $pdf->Cell(40,13, 'status', 1, 0,'',1);
    $pdf->Cell(150,13, $row['status'], 1, 1,'',0);

    $pdf->Cell(40,13, 'observaciones', 1, 0,'',1);  
    $pdf->Cell(150,13, $row['observaciones'], 1, 1,'',0);    

    $pdf->Cell(40,13, 'tipo', 1, 0,'',1);  
    $pdf->Cell(150,13, $row['tipo'], 1, 1,'',0);   
     
    }

$pdf->Output();
?>