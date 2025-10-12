<?php
/**
 * @file insert.php
 * @description Recibe los datos del formulario por POST y los guarda en la Base de Datos.
 */

// Incluir el archivo de conexión
include 'conex.php'; 

// Recibir los datos del formulario (Requisito PHP)
$nombre = $_POST['name'] ?? 'No especificado';
$correo = $_POST['email'] ?? 'No especificado';
$mensaje = $_POST['message'] ?? 'No especificado';

// Limpieza de datos (seguridad)
$nombre_limpio = $con->real_escape_string(htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8'));
$correo_limpio = $con->real_escape_string(htmlspecialchars($correo, ENT_QUOTES, 'UTF-8'));
$mensaje_limpio = $con->real_escape_string(htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8'));

// Los datos recibidos se guardarán en una Tabla de la BD (Requisito PHP)
// Se asume una tabla llamada 'contactos' con columnas: id, nombre, email, mensaje, fecha_envio
$stmt = $con->prepare("INSERT INTO contactos (nombre, email, mensaje, fecha_envio) VALUES (?, ?, ?, NOW())");
$stmt->bind_param("sss", $nombre_limpio, $correo_limpio, $mensaje_limpio);

// Notificar al usuario (Requisito PHP)
if ($stmt->execute()) {
    $success = true;
    $status_message = "¡Datos guardados con éxito en la base de datos! ✅";
} else {
    $success = false;
    $status_message = "Error al guardar los datos: " . $stmt->error;
}

$stmt->close();
$con->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $success ? 'Envío Exitoso' : 'Error de Envío'; ?></title>
    <link rel="stylesheet" href="../css/style.css"> 
</head>
<body class="confirmation-page">
    <div class="confirmation-card">
        <h1 class="confirmation-message" style="color: <?php echo $success ? '#28a745' : '#dc3545'; ?>">
            <?php echo $status_message; ?>
        </h1>
        <div class="received-data">
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($nombre); ?></p>
            <p><strong>Correo:</strong> <?php echo htmlspecialchars($correo); ?></p>
            <p><strong>Mensaje:</strong> <?php echo nl2br(htmlspecialchars($mensaje)); ?></p>
        </div>
        <p style="margin-top: 1.5rem;"><a href="../index.php" class="news__link">Volver al Inicio</a></p>
    </div>
</body>
</html>