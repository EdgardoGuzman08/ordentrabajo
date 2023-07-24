<?php
// ExportarModel.php

// Incluye el archivo de configuración de la base de datos
require_once "configuraciones/database.php";

class ExportarModel {
    public function obtenerDatosGuardados() {
        global $conexion; // Accede a la variable de conexión definida en database.php
        $consulta = "SELECT id, area, fecha, linea, autor, no_empl, sintoma_averia, descripcion_trabajo, departamento, prioridad, no_ot, no_st, created_at FROM ssmoperacion WHERE area IS NOT NULL";
        $stmt = $conexion->prepare($consulta);
        $stmt->execute();

        $datos = array();
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $datos[] = array_values($fila);
        }

        return $datos;
    }
}
?>
