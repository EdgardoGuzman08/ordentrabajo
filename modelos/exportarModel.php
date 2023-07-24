<?php
// ExportarModel.php

// Incluye el archivo de configuración de la base de datos
require_once "../configuraciones/database.php";

class ExportarModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerDatosGuardados() {
        $consulta = "SELECT orden_no, nombre_pc, fecha_inicio, departamento, hora_inicio, area, fecha_final, operador, hora_final, prioridad, mantenimiento, total_horas FROM trabajo_orden";
        $stmt = $this->conexion->prepare($consulta);
        $stmt->execute();

        $datos = array();
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $datos[] = array_values($fila);
        }

        return $datos;
    }
}
?>
