<?php

# Incluyendo librerias necesarias #
require "./code128.php";

$pdf = new PDF_Code128('P','mm',array(80,258));
$pdf->SetMargins(4,10,4);
$pdf->AddPage();

# Encabezado y datos de la empresa #
$pdf->SetFont('Arial','B',10);

require "../../../Backend/config/baseDeDatos.php";

$id = $_POST["id"];
$stmt = $conn->prepare("SELECT detalle_factura.*, factura_cabecera.cliente, cliente.nombre AS nombre_cliente, cliente.cedula, cliente.ruc, productos.nombre_producto 
                        FROM detalle_factura 
                        JOIN factura_cabecera ON factura_cabecera.id_factura = detalle_factura.id_factura 
                        JOIN cliente ON cliente.id_cliente = factura_cabecera.cliente 
                        JOIN productos ON productos.id_producto = detalle_factura.productos 
                        WHERE detalle_factura.id_factura=:id_factura");
$stmt->bindParam(':id_factura',$id, PDO::PARAM_INT);
$stmt->execute();

# Datos generales de la factura #
$row_general = $stmt->fetch();

$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1",strtoupper("FERRETERIA S.A")),0,'C',false);
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","RUC: 0000000000"),0,'C',false);
$pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Direccion Mil Viviendas, Ayolas"),0,'C',false);
$pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Cedula: 00000000"),0,'C',false);
$pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Email: correo@ejemplo.com"),0,'C',false);

$pdf->Ln(1);
$pdf->Cell(0,5,iconv("UTF-8", "ISO-8859-1","------------------------------------------------------"),0,0,'C');
$pdf->Ln(5);

$pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Fecha: ".date("d/m/Y", strtotime($row_general['fecha']))." ".date("h:s A")),0,'C',false);
$pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Caja: 1"),0,'C',false);
$pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Cajero: Nombre"),0,'C',false);
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1",strtoupper("Factura Nro: " . $row_general['id_factura'])),0,'C',false);
$pdf->SetFont('Arial','',9);

$pdf->Ln(1);
$pdf->Cell(0,5,iconv("UTF-8", "ISO-8859-1","------------------------------------------------------"),0,0,'C');
$pdf->Ln(5);

$pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1", "Cliente: " . $row_general['nombre_cliente']),0,'C',false);
$pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Cedula: " .$row_general['cedula']),0,'C',false);
$pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Teléfono: 00000000"),0,'C',false);
$pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","RUC: " . $row_general['ruc']),0,'C',false);

$pdf->Ln(1);
$pdf->Cell(0,5,iconv("UTF-8", "ISO-8859-1","-------------------------------------------------------------------"),0,0,'C');
$pdf->Ln(3);


# Tabla de productos #
$pdf->Cell(28,5,iconv("UTF-8", "ISO-8859-1","Producto"),0,0,'C');
$pdf->Cell(19,5,iconv("UTF-8", "ISO-8859-1","Precio"),0,0,'C');
$pdf->Cell(10,5,iconv("UTF-8", "ISO-8859-1","Cant."),0,0,'C');
$pdf->Cell(19,5,iconv("UTF-8", "ISO-8859-1","SubTotal"),0,0,'C');

$pdf->Ln(3);
$pdf->Cell(72,5,iconv("UTF-8", "ISO-8859-1","-------------------------------------------------------------------"),0,0,'C');
$pdf->Ln(3);

/* Rewind de cursor para volver a recorrer los productos */
$stmt->execute();

$subtotal = 0;
while ($row = $stmt->fetch()) {
    /*----------  Detalles de la tabla  ----------*/
    $pdf->Cell(28,4,iconv("UTF-8", "ISO-8859-1",$row['nombre_producto']),0,0,'C');
    $pdf->Cell(19,4,iconv("UTF-8", "ISO-8859-1", number_format($row['precio_unitario'], 0, ',', '.')),0,0,'C');
    $pdf->Cell(10,4,iconv("UTF-8", "ISO-8859-1",$row['cantidad']),0,0,'C');
    $pdf->Cell(19,4,iconv("UTF-8", "ISO-8859-1", number_format($row['total_pagar'], 0, ',', '.')),0,0,'C');
    $pdf->Ln(6);
    $pdf->Ln(7);

    /* Calcular subtotal */
    $subtotal += $row['total_pagar'];
}

/*----------  Fin Detalles de la tabla  ----------*/

$pdf->Cell(72,5,iconv("UTF-8", "ISO-8859-1","-------------------------------------------------------------------"),0,0,'C');
$pdf->Ln(5);

# Impuestos & totales #
$pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
$pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","SUBTOTAL"),0,0,'C');
$pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1", number_format($subtotal, 0, ',', '.')),0,0,'C');

$pdf->Ln(5);

//$iva = $subtotal * 0.15;
$iva = 0;
$pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
$pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","IVA (15%)"),0,0,'C');
$pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1", number_format($iva, 0, ',', '.')),0,0,'C');

$pdf->Ln(5);

$pdf->Cell(72,5,iconv("UTF-8", "ISO-8859-1","-------------------------------------------------------------------"),0,0,'C');

$pdf->Ln(5);

$total_pagar = $subtotal + $iva;
$pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
$pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","TOTAL A PAGAR"),0,0,'C');
$pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1", number_format($total_pagar, 0, ',', '.')),0,0,'C');

$pdf->Ln(5);
$pdf->Ln(10);

$pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","*** Precios de productos incluyen impuestos. Para poder realizar un reclamo o devolución debe de presentar este ticket ***"),0,'C',false);

$pdf->SetFont('Arial','B',9);
$pdf->Cell(0,7,iconv("UTF-8", "ISO-8859-1","Gracias por su compra"),'',0,'C');

$pdf->Ln(9);

# Codigo de barras #
$pdf->Code128(5,$pdf->GetY(),"COD000001V0001",70,20);
$pdf->SetXY(0,$pdf->GetY()+21);
$pdf->SetFont('Arial','',14);
$pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","COD000001V0001"),0,'C',false);


    # Nombre del archivo PDF #
    $pdf->Output("I","Ticket_Nro_1.pdf",true);

?>
