<?php 

$dsn = "mysql:host=localhost;dbname=ordentrabajo;charset=utf8";
$usuario = "root";
$contraseña = "123456";

try{
    $conexion = new PDO($dsn, $usuario,$contraseña);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "Error al conectar con la base de datos Orden de Trabajo";
    exit;
}

?>