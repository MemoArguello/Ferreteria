<?php
require('../fpdf/fpdf.php');
require "../../../backend/config/baseDeDatos.php";

// Consulta SQL para obtener los datos de los productos
$sql = $conn->query("SELECT productos.id_producto, productos.nombre_producto, productos.categoria, productos.lote, productos.stock, productos.precio, productos.precio_compra, categorias.descripcion AS categoria, proveedores.nombre_prov AS proveedor FROM productos JOIN categorias ON categorias.id_categoria = productos.categoria JOIN proveedores ON proveedores.id_proveedor = productos.id_proveedor");

// Ejecutar la consulta
$sql->execute();

// Obtener todos los productos como objetos
$productoTotal = $sql->fetchAll(PDO::FETCH_OBJ);

// Crear la clase PDF extendiendo FPDF
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo (ajusta la ruta a tu imagen)
        $this->Image("../../IMG/boxes_6691160.png", 105, 10, 10);
        
        // Título
        $this->SetFont("Arial", "B", 12);
        $this->Cell(0, 10, utf8_decode("Reporte de todos los Productos"), 0, 1, "C");
        
        // Fecha
        $this->SetFont("Arial", "", 10);
        $this->Cell(0, 10, "Fecha: " . date("d/m/Y"), 0, 1, "C");
        
        // Salto de línea
        $this->Ln(5);
        
        // Encabezados de tabla
        $this->SetFont("Arial", "B", 9);
        $this->Cell(20, 5, "ID", 1, 0, "C");
        $this->Cell(70, 5, "Nombre Producto", 1, 0, "C");
        $this->Cell(70, 5, "Categoria", 1, 0, "C");
        $this->Cell(45, 5, "Proveedor", 1, 0, "C");
        $this->Cell(35, 5, "Precio", 1, 0, "C");
        $this->Cell(35, 5, "Stock", 1, 0, "C");
        $this->Ln();
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0, 10, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// Crear instancia de PDF
$pdf = new PDF("L", "mm", "A4");
$pdf->AliasNbPages();
$pdf->SetMargins(10, 10, 10);
$pdf->AddPage();

// Establecer fuente y tamaño para los datos de los productos
$pdf->SetFont("Arial", "", 9);

// Iterar sobre los datos obtenidos y agregar cada fila a la tabla del PDF
foreach ($productoTotal as $producto) {
    // ID
    $pdf->Cell(20, 5, $producto->id_producto, 1, 0, "C");
    
    // Nombre Producto
    $pdf->Cell(70, 5, utf8_decode($producto->nombre_producto), 1, 0, "C");
    
    // Categoría
    $pdf->Cell(70, 5, utf8_decode($producto->categoria), 1, 0, "C");
    
    // Proveedor
    $pdf->Cell(45, 5, utf8_decode($producto->proveedor), 1, 0, "C");
    
    // Precio
    $pdf->Cell(35, 5, number_format($producto->precio, 0, ',', '.'), 1, 0, "C");
    
    // Stock
    $pdf->Cell(35, 5, $producto->stock, 1, 0, "C");
    
    // Salto de línea al final de cada fila
    $pdf->Ln();
}

// Salida del PDF
$pdf->Output();
?>
