<?php
// exportar.php

// Incluye el archivo de configuración de la base de datos
require_once "../configuraciones/database.php";
// Incluye el archivo del modelo
require_once "../modelos/exportarModel.php";
// Incluye la biblioteca PhpSpreadsheet
require_once '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\BaseWriter;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Border;

// Verifica si se ha enviado la solicitud para exportar a Excel
if (isset($_POST['action']) && $_POST['action'] === 'exportar') {
    // Lógica para exportar a Excel

    // Crear una instancia del modelo ExportarModel y obtener los datos guardados
    $exportarModel = new ExportarModel($conexion);
    $data = $exportarModel->obtenerDatosGuardados();

    // Crear un nuevo objeto Spreadsheet
    $spreadsheet = new Spreadsheet();

    // Establecer propiedades del documento
    $spreadsheet->getProperties()->setTitle("Exportar Datos")->setDescription("Datos exportados de la base de datos");

    // Crear una hoja de cálculo activa
    $sheet = $spreadsheet->getActiveSheet();

    // Estilos adicionales para el encabezado
    $headerStyle = [
        'font' => [
            'bold' => true,
            'color' => ['rgb' => 'FFFFFF'], // Color de la fuente (blanco)
            'name' => 'Times New Roman',
            'size' => 16,
        ],
        'fill' => [ // Agregar el estilo de background-color al encabezado
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => '0067B3'], // Color del fondo (azul)
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['rgb' => '000000'], // Color del borde (negro)
            ],
        ],
    ];

    // Estilos para las celdas de datos
    $dataStyle = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['rgb' => '000000'], // Color del borde (negro)
            ],
        ],
    ];

    // Establecer los encabezados de columna
    $encabezados = ['Orden No.', 'Nombre Pc', 'Fecha Inicio', 'Departamento', 'Hora Inicio', 'Area', 'Fecha Final', 'Operador', 'Hora Final', 'Prioridad', 'Mantenimientos', 'Total Horas'];

    // Inicializar la columna en 'A' y la fila en 1 (encabezado)
    $columna = 'A';
    $fila = 1;

    // Iterar sobre los encabezados para agregarlos a la hoja de cálculo
    foreach ($encabezados as $encabezado) {
        $sheet->setCellValue($columna . $fila, $encabezado); // Establecer el valor del encabezado en la celda actual
        $sheet->getStyle($columna . $fila)->applyFromArray($headerStyle); // Aplicar estilos al encabezado (fuente en negrita, fondo azul, bordes)
        $sheet->getColumnDimension($columna)->setAutoSize(true); // Ajustar automáticamente el ancho de la columna
        $columna++; // Pasar a la siguiente columna para el próximo encabezado
    }

    // Llenar los datos en las celdas
    $fila = 2; // Comenzar en la fila 2 (debajo del encabezado)
    foreach ($data as $registro) {
        $columna = 'A'; // Reiniciar la columna a 'A' para cada registro
        foreach ($registro as $valor) {
            $sheet->setCellValue($columna . $fila, $valor); // Establecer el valor del dato en la celda actual
            $sheet->getStyle($columna . $fila)->applyFromArray($dataStyle); // Aplicar estilos a los datos (bordes)
            $sheet->getColumnDimension($columna)->setAutoSize(true); // Ajustar automáticamente el ancho de la columna
            $columna++; // Pasar a la siguiente columna para el próximo dato
        }
        $fila++; // Pasar a la siguiente fila para el próximo registro
    }


    // Establecer el nombre del archivo y la ruta completa
    $archivo = "ordenTrabajo.xlsx";
    $rutaCompleta = "C:/Users/edgar/Downloads/" . $archivo;

    // Guardar el archivo Excel en una ubicación temporal
    $tempArchivo = tempnam(sys_get_temp_dir(), 'excel');

    $writer = new Xlsx($spreadsheet);
    $writer->save($tempArchivo);

    // Descargar el archivo Excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $archivo . '"');
    header('Content-Length: ' . filesize($tempArchivo));
    header('Cache-Control: max-age=0');

    // Leer el archivo y enviarlo al flujo de salida usando fpassthru()
    $file = fopen($tempArchivo, 'rb');
    fpassthru($file);
    fclose($file);

    // Eliminar el archivo temporal
    unlink($tempArchivo);

    // Finalizar la ejecución del script
    exit();
}
?>
