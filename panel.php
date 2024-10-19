<?php
// Comando para iniciar y detener MySQL
$startCommand = "sudo service mysql start";
$stopCommand = "sudo service mysql stop";

// Función para ejecutar el comando
function executeCommand($command) {
    $output = null;
    $returnVar = null;
    exec($command, $output, $returnVar);
    return $returnVar === 0 ? true : false;
}

// Manejar acciones de inicio o detención
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'start') {
            $success = executeCommand($startCommand);
            $message = $success ? "Servidor MySQL iniciado con éxito" : "Error al iniciar el servidor MySQL";
        } elseif ($_POST['action'] === 'stop') {
            $success = executeCommand($stopCommand);
            $message = $success ? "Servidor MySQL detenido con éxito" : "Error al detener el servidor MySQL";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control de MySQL</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            text-align: center;
        }
        .status {
            margin: 20px 0;
            padding: 10px;
            border: 1px solid #333;
            background-color: #f4f4f4;
        }
        button {
            padding: 10px 20px;
            margin: 5px;
            font-size: 16px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Panel de Control de MySQL</h1>
    <?php if (isset($message)): ?>
        <div class="status">
            <strong><?php echo $message; ?></strong>
        </div>
    <?php endif; ?>
    <form method="POST">
        <button type="submit" name="action" value="start">Iniciar MySQL</button>
        <button type="submit" name="action" value="stop">Detener MySQL</button>
    </form>
</div>

</body>
</html>
