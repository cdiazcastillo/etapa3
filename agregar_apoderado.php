<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $rut_apoderado = $_POST['rut_apoderado'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    $sql = "INSERT INTO Apoderado (nombre, rut_apoderado, telefono, direccion) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $nombre, $rut_apoderado, $telefono, $direccion);

    if ($stmt->execute()) {
        echo "Apoderado agregado exitosamente";
    } else {
        echo "Error al agregar apoderado: " . $stmt->error;
    }
}
?>

<form action="agregar_apoderado.php" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" required><br>
    
    <label for="rut_apoderado">RUT Apoderado:</label>
    <input type="text" name="rut_apoderado" required><br>

    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" required><br>
    
    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" required><br>

    <input type="submit" value="Agregar Apoderado">
</form>
