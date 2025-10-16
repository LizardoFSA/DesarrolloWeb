<?php
// CREDENCIALES DE LA BASE DE DATOS
$host = "mysql.inf.uct.cl";
$user = "lsalazar"; 
$pass = "lsalazar2021"; 
$db = "lsalazar"; 

// Crear conexión
$con = new mysqli($host, $user, $pass, $db);

// Verificar conexión y notificar error
if ($con->connect_error) {
    die("Error de Conexión a la Base de Datos: " . $con->connect_error);
}

$con->set_charset("utf8");
?>