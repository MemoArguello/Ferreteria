<?php
require('../fpdf/fpdf.php');
require "../../../backend/config/baseDeDatos.php";

// Consulta SQL para obtener los datos de las categorías
$sql = $conn->query("SELECT * FROM categorias");
$sql->execute();

$categoriaTotal = $sql->fetchAll(PDO::FETCH_OBJ);

// Crear la clase PDF extendiendo FPDF
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo (ajusta la ruta a tu imagen)
        $this->Image("../../IMG/boxes_6691160.png", 55, 10, 10);
        
        // Título
        $this->SetFont("Arial", "B", 12);
        $this->Cell(0, 10, utf8_decode("Reporte de todas las categorias"), 0, 1, "C");
        
        // Fecha
        $this->SetFont("Arial", "", 10);
        $this->Cell(0, 10, "Fecha: " . date("d/m/Y"), 0, 1, "C");
        
        // Salto de línea
        $this->Ln(5);
        
        // Encabezados de tabla
        $this->SetFont("Arial", "B", 9);
        $this->Cell(40, 7, "ID", 1, 0, "C");
        $this->Cell(150, 7, "Categoria", 1, 0, "C");
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
//$pdf = new PDF("L", "mm", "A4"); para Horizontal
$pdf = new PDF("P", "mm", "A4"); //para Vertical

$pdf->AliasNbPages();
$pdf->SetMargins(10, 10, 10);
$pdf->AddPage();

// Establecer fuente y tamaño para los datos de las categorías
$pdf->SetFont("Arial", "", 9);

// Iterar sobre los datos obtenidos y agregar cada fila a la tabla del PDF
foreach ($categoriaTotal as $categoria) {
    // ID
    $pdf->Cell(40, 7, $categoria->id_categoria, 1, 0, "C");
    
    // Nombre de la categoría
    $pdf->Cell(150, 7, utf8_decode($categoria->descripcion), 1, 0, "C");
    
    // Salto de línea al final de cada fila
    $pdf->Ln();
}

// Salida del PDF
$pdf->Output();
?>
