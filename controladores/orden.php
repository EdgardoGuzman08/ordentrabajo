<?php
// controlador/operacion.php

// Incluye el archivo de configuración de la base de datos
require_once "configuraciones/database.php";
// Incluye el archivo del modelo
require_once "modelos/OrdenModelo.php";
// Crea una instancia del modelo
$ordenModel = new OrdenModelo($conexion);

// Generar el número de orden
function generarNumeroOrden($numOrden) {
    $letrasFijas = '-IT'; // Las dos letras fijas
    return str_pad($numOrden, 6, '0', STR_PAD_LEFT) . $letrasFijas;
}

// Obtener el último número de orden
$ultimoId = $ordenModel->obtenerultimoOrden_no();
if ($ultimoId) {
    $ultimoNumOrden = intval(substr($ultimoId, 0, -2)); // Obtener solo el número, sin las letras fijas
    $numOrden = $ultimoNumOrden + 1; // Incrementar el número en 1
} else {
    $numOrden = 100000; // Si no hay registros, comenzar desde 100000
}

$orden_no = generarNumeroOrden($numOrden); // Generar el nuevo número de orden


// Verificar si se enviaron datos por POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verificar si los campos están presentes en el array $_POST antes de acceder a ellos
    if (isset($_POST["nombre_pc"], $_POST["fecha_inicio"], $_POST["departamento"], $_POST["hora_inicio"], $_POST["area"], $_POST["fecha_final"], $_POST["operador"], $_POST["hora_final"], $_POST["prioridad"], $_POST["total_horas"])) {
        // Obtener los datos del formulario
        $nombre_pc = $_POST["nombre_pc"];
        $fecha_inicio = $_POST["fecha_inicio"];
        $departamento = $_POST["departamento"];
        $hora_inicio = $_POST["hora_inicio"];
        $area = $_POST["area"];
        $fecha_final = $_POST["fecha_final"];
        $operador = $_POST["operador"];
        $hora_final = $_POST["hora_final"];
        $prioridad = $_POST["prioridad"];
        // Obtener los valores de los checkboxes seleccionados y concatenarlos con una coma
        $mantenimiento = "";
        if (isset($_POST["mantenimiento"])) {
            foreach ($_POST["mantenimiento"] as $selected) {
                $mantenimiento .= $selected . ", ";
            }
            $mantenimiento = rtrim($mantenimiento, ", "); // Eliminar la última coma y espacio
        }    
        $total_horas = $_POST["total_horas"];

        // Convertir el formato de 12 horas a 24 horas
        $horaInicio24h = date("H:i", strtotime($hora_inicio));
        $horaFinal24h = date("H:i", strtotime($hora_final));
        $totalhoras24h = date("H:i", strtotime($total_horas));

        // Luego, puedes llamar a la función del modelo para insertar los datos en la base de datos
        $resultado = $ordenModel->insertarOrden($orden_no, $nombre_pc, $fecha_inicio, $departamento, $hora_inicio, $area, $fecha_final, $operador, $hora_final, $prioridad, $mantenimiento, $total_horas);

        // Verificar el resultado y realizar acciones en consecuencia
        if ($resultado) {
            echo "<script>alert('Error no se ha guardado'); window.location.href = 'http://localhost/ordentrabajo/';</script>";
            exit();
        } else {
            echo "<script>alert('Se ha guardado exitosamente'); window.location.href = 'http://localhost/ordentrabajo/';</script>";
            exit();
        }
    } else {
        // Si algunos campos faltan en $_POST, puedes mostrar un mensaje de error o realizar alguna acción apropiada aquí.
        echo "Error: Algunos campos del formulario están faltando.";

    }
}
?>
