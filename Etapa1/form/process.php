<?php
$nombre = $_GET['name'] ?? 'No especificado';
$correo = $_GET['email'] ?? 'No especificado';
$mensaje = $_GET['message'] ?? 'No especificado';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Envío</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="confirmation-page">
    <div class="confirmation-card">
        <h1 class="confirmation-message">¡Los datos fueron recibidos con éxito! ✅</h1>
        <div class="received-data">
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($nombre); ?></p>
            <p><strong>Correo:</strong> <?php echo htmlspecialchars($correo); ?></p>
            <p><strong>Mensaje:</strong> <?php echo nl2br(htmlspecialchars($mensaje)); ?></p>
        </div>
    </div>
</body>
</html>