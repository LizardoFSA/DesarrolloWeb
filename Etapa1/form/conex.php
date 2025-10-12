<?php
/**
 * @file conex.php
 * @description Script para establecer la conexión a la base de datos.
 */

// CREDENCIALES DE LA BASE DE DATOS - ¡MODIFICAR!
$host = "localhost";
$user = "root"; 
$pass = ""; 
$db = "nombre_bd"; 

// Crear conexión
$con = new mysqli($host, $user, $pass, $db);

// Verificar conexión y notificar error (Requisito PHP: Notificar)
if ($con->connect_error) {
    // Es mejor usar die() o throw en un archivo de conexión para detener la ejecución si falla
    die("Error de Conexión a la Base de Datos: " . $con->connect_error);
}

// Establecer el juego de caracteres a utf8
$con->set_charset("utf8");
?>