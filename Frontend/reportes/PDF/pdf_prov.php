<?php
require('../fpdf/fpdf.php');
require "../../../backend/config/baseDeDatos.php";

// Consulta SQL para obtener los datos de los productos
$sql = $conn->query("SELECT proveedores.id_proveedor, proveedores.nombre_prov, proveedores.ruc, proveedores.telefono, departamentos.nombre AS nombre_d, ciudades.nombre AS nombre_c FROM proveedores JOIN departamentos ON departamentos.id_departamento = proveedores.departamento
                    JOIN ciudades ON ciudades.id_ciudad = proveedores.distrito WHERE proveedores.estado =1");
$sql->execute();

$proveedorTotal = $sql->fetchAll(PDO::FETCH_OBJ);

// Crear la clase PDF extendiendo FPDF
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo (ajusta la ruta a tu imagen)
        $this->Image("../../IMG/warehouse_12766209.png", 60, 10, 10);
        
        // Título
        $this->SetFont("Arial", "B", 12);
        $this->Cell(0, 10, utf8_decode("Reporte de todos los Proveedores"), 0, 1, "C");
        
        // Fecha
        $this->SetFont("Arial", "", 10);
        $this->Cell(0, 10, "Fecha: " . date("d/m/Y"), 0, 1, "C");
        
        // Salto de línea
        $this->Ln(5);
        
        // Encabezados de tabla
        $this->SetFont("Arial", "B", 9);
        $this->Cell(20, 5, "ID", 1, 0, "C");
        $this->Cell(40, 5, "Nombre", 1, 0, "C");
        $this->Cell(30, 5, "RUC", 1, 0, "C");
        $this->Cell(30, 5, "Telefono", 1, 0, "C");
        $this->Cell(35, 5, "Departamento", 1, 0, "C");
        $this->Cell(35, 5, "Ciudad", 1, 0, "C");
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
$pdf = new PDF("P", "mm", "A4");
$pdf->AliasNbPages();
$pdf->SetMargins(10, 10, 10);
$pdf->AddPage();

// Establecer fuente y tamaño para los datos de los productos
$pdf->SetFont("Arial", "", 9);

// Iterar sobre los datos obtenidos y agregar cada fila a la tabla del PDF
foreach ($proveedorTotal as $proveedor) {
    // ID
    $pdf->Cell(20, 5, $proveedor->id_proveedor, 1, 0, "C");
    $pdf->Cell(40, 5, utf8_decode($proveedor->nombre_prov), 1, 0, "C");
    $pdf->Cell(30, 5, utf8_decode($proveedor->ruc), 1, 0, "C");
    $pdf->Cell(30, 5, utf8_decode($proveedor->telefono), 1, 0, "C");
    $pdf->Cell(35, 5, utf8_decode($proveedor->nombre_d), 1, 0, "C");
    $pdf->Cell(35, 5, utf8_decode($proveedor->nombre_c), 1, 0, "C");
    // Salto de línea al final de cada fila
    $pdf->Ln();
}

// Salida del PDF
$pdf->Output();
?>
