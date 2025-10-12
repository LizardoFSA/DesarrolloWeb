<?php
/**
 * @file list.php
 * @description Consulta la tabla de contactos y devuelve los últimos 5 registros en formato JSON.
 */

header('Content-Type: application/json');

// Incluir el archivo de conexión
include 'conex.php'; 

$data = [];

// Implementar una opción que permita listar los datos
$sql = "SELECT nombre, email, fecha_envio FROM contactos ORDER BY fecha_envio DESC LIMIT 5";
$result = $con->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
} else {
    // Manejo de error si la consulta falla
    $data = ["error" => "Error en la consulta SQL: " . $con->error];
}

// Los datos deben ser recibidos en formato JSON
echo json_encode($data);

$con->close();
?>