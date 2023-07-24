<?php 

require_once 'configuraciones/database.php';
require_once 'controladores/orden.php';
require_once 'modelos/ordenmodelo.php';

// Verificar si se ha enviado la solicitud para exportar a Excel
if (isset($_GET['exportar']) && $_GET['exportar'] === '1') {
    require_once 'vistas/exportar.php';
} else {
    require_once 'vistas/index.php';
}

?>