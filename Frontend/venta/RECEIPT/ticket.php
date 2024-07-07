<?php

	# Incluyendo librerias necesarias #
    require "./code128.php";

    $pdf = new PDF_Code128('P','mm',array(80,258));
    $pdf->SetMargins(4,10,4);
    $pdf->AddPage();
    
    # Encabezado y datos de la empresa #
    $pdf->SetFont('Arial','B',10);

    require "./conexion.php";

    $id = $_GET['id_detalle'];
    $stmt = $connect->prepare("SELECT detalle_factura.id_detalle, detalle_factura.id_factura, 
    detalle_factura.id_producto, detalle_factura.cantidad, detalle_factura.costo_unitario, 
    detalle_factura.total, facturas.id_factura, facturas.codigo_factura, facturas.cliente,
    productos.id_producto, productos.nombre_producto, cliente.id_cliente, cliente.nombre,
    cliente.cedula, ciudades.id_ciudad, ciudades.nombre AS nombreCiudad FROM detalle_factura JOIN facturas 
    ON facturas.id_factura =  detalle_factura.id_factura JOIN productos 
    ON productos.id_producto = detalle_factura.id_producto 
    JOIN cliente ON cliente.id_cliente = facturas.cliente JOIN ciudades ON ciudades.id_ciudad = cliente.id_ciudad
    WHERE id_detalle= '$id'");
    
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();

    while ($row = $stmt->fetch()) {
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

    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Fecha: ".date("d/m/Y", strtotime("13-09-2022"))." ".date("h:s A")),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Caja: 1"),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Cajero: Nombre"),0,'C',false);
    $pdf->SetFont('Arial','B',10);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1",strtoupper("Ticket Nro: 1")),0,'C',false);
    $pdf->SetFont('Arial','',9);

    $pdf->Ln(1);
    $pdf->Cell(0,5,iconv("UTF-8", "ISO-8859-1","------------------------------------------------------"),0,0,'C');
    $pdf->Ln(5);

    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1", "Cliente: " . $row['nombre']),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Cedula: " .$row['cedula']),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Teléfono: 00000000"),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Ciudad: " . $row['nombreCiudad']),0,'C',false);

    $pdf->MultiCell(0,4,iconv("UTF-8", "ISO-8859-1","Producto: ".$row['nombre_producto']),0,'C',false);

    $pdf->Ln(1);
    $pdf->Cell(0,5,iconv("UTF-8", "ISO-8859-1","-------------------------------------------------------------------"),0,0,'C');
    $pdf->Ln(3);


    # Tabla de productos #
    $pdf->Cell(10,5,iconv("UTF-8", "ISO-8859-1","Cant."),0,0,'C');
    $pdf->Cell(19,5,iconv("UTF-8", "ISO-8859-1","Precio"),0,0,'C');
    $pdf->Cell(15,5,iconv("UTF-8", "ISO-8859-1","Desc."),0,0,'C');
    $pdf->Cell(28,5,iconv("UTF-8", "ISO-8859-1","Total"),0,0,'C');

    $pdf->Ln(3);
    $pdf->Cell(72,5,iconv("UTF-8", "ISO-8859-1","-------------------------------------------------------------------"),0,0,'C');
    $pdf->Ln(3);



    /*----------  Detalles de la tabla  ----------*/
    $pdf->Cell(10,4,iconv("UTF-8", "ISO-8859-1",$row['cantidad']),0,0,'C');
    $pdf->Cell(19,4,iconv("UTF-8", "ISO-8859-1",$row['costo_unitario']),0,0,'C');
    $pdf->Cell(19,4,iconv("UTF-8", "ISO-8859-1","$0.00 USD"),0,0,'C');
    $pdf->Cell(28,4,iconv("UTF-8", "ISO-8859-1",$row['total']),0,0,'C');
    $pdf->Ln(6);
    $pdf->MultiCell(0,4,iconv("UTF-8", "ISO-8859-1","Garantía de fábrica: 2 Meses"),0,'C',false);
    $pdf->Ln(7);
    /*----------  Fin Detalles de la tabla  ----------*/



    $pdf->Cell(72,5,iconv("UTF-8", "ISO-8859-1","-------------------------------------------------------------------"),0,0,'C');

        $pdf->Ln(5);

    # Impuestos & totales #
    $pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
    $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","SUBTOTAL"),0,0,'C');
    $pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1",$row['total']),0,0,'C');

    $pdf->Ln(5);

    $pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
    $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","IVA (13%)"),0,0,'C');
    $pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1","+ $0.00 USD"),0,0,'C');

    $pdf->Ln(5);

    $pdf->Cell(72,5,iconv("UTF-8", "ISO-8859-1","-------------------------------------------------------------------"),0,0,'C');

    $pdf->Ln(5);

    $pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
    $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","TOTAL A PAGAR"),0,0,'C');
    $pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1",$row['total']),0,0,'C');


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
    }
    # Nombre del archivo PDF #
    $pdf->Output("I","Ticket_Nro_1.pdf",true);

    ?>