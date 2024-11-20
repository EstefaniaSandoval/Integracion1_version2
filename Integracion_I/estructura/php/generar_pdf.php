<?php
require('../fpdf186/fpdf.php');
require('conex.php');


// Paginación
$limit = 10; // Número de registros por página
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Consulta de los registros a mostrar en la página activa
$query = "SELECT nombre, apellido, edad, sexo, tipo_usuario, patente, marca, espacio_estacionamiento 
          FROM vehiculos_registrados 
          LIMIT $limit OFFSET $offset";
$result = $conexion->query($query);

// Crear instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Título del documento
$pdf->Cell(0, 10, 'Registros de Vehiculos - Pagina ' . $page, 0, 1, 'C');

// Cabecera de la tabla
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(25, 10, 'Nombre', 1);
$pdf->Cell(25, 10, 'Apellido', 1);
$pdf->Cell(20, 10, 'Edad', 1);
$pdf->Cell(20, 10, 'Sexo', 1);
$pdf->Cell(30, 10, 'Tipo de Usuario', 1);
$pdf->Cell(30, 10, 'Patente', 1);
$pdf->Cell(30, 10, 'Marca', 1);
$pdf->Cell(30, 10, 'Espacio Est.', 1);
$pdf->Ln();

// Agregar datos de la tabla
$pdf->SetFont('Arial', '', 10);
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(25, 10, $row['nombre'], 1);
    $pdf->Cell(25, 10, $row['apellido'], 1);
    $pdf->Cell(20, 10, $row['edad'], 1);
    $pdf->Cell(20, 10, $row['sexo'], 1);
    $pdf->Cell(30, 10, $row['tipo_usuario'], 1);
    $pdf->Cell(30, 10, $row['patente'], 1);
    $pdf->Cell(30, 10, $row['marca'], 1);
    $pdf->Cell(30, 10, $row['espacio_estacionamiento'], 1);
    $pdf->Ln();
}

// Generar el archivo PDF
$pdf->Output('D', 'Registro de vehiculos.pdf');

?>