<?php
// modelos/OperacionModel.php

class OrdenModelo {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerultimoOrden_no(){
        $query = "SELECT MAX(orden_no) AS ultimoId FROM trabajo_orden";
        $result = $this->conexion->query($query);
        $row = $result->fetch(PDO::FETCH_ASSOC); // Utiliza fetch(PDO::FETCH_ASSOC) en lugar de fetch_assoc()
        $ultimoId = $row['ultimoId'];

        return $ultimoId;
    }

    public function insertarOrden($orden_no, $nombre_pc, $fecha_inicio, $departamento, $hora_inicio, $area, $fecha_final, $operador, $hora_final, $prioridad, $mantenimiento, $total_horas) {
        $stmt = $this->conexion->prepare("INSERT INTO trabajo_orden (orden_no, nombre_pc, fecha_inicio, departamento, hora_inicio, area, fecha_final, operador, hora_final, prioridad, mantenimiento, total_horas) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
        $stmt->bindParam(1, $orden_no);
        $stmt->bindParam(2, $nombre_pc);
        $stmt->bindParam(3, $fecha_inicio);
        $stmt->bindParam(4, $departamento);
        $stmt->bindParam(5, $hora_inicio);
        $stmt->bindParam(6, $area);
        $stmt->bindParam(7, $fecha_final);
        $stmt->bindParam(8, $operador);
        $stmt->bindParam(9, $hora_final);
        $stmt->bindParam(10, $prioridad);
        $stmt->bindParam(11, $mantenimiento);
        $stmt->bindParam(12, $total_horas);

        $stmt->execute();
    }
}
?>
