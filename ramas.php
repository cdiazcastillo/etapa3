<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_rama = $_POST['nombre_rama'];
    $descripcion = $_POST['descripcion'];

    $sql = "INSERT INTO Rama (nombre_rama, descripcion) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $nombre_rama, $descripcion);

    if ($stmt->execute()) {
        echo "Rama agregada exitosamente";
    } else {
        echo "Error al agregar rama: " . $stmt->error;
    }
}
?>

<form action="ramas.php" method="POST">
    <label for="nombre_rama">Nombre Rama:</label>
    <input type="text" name="nombre_rama" required><br>

    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" required></textarea><br>

    <input type="submit" value="Agregar Rama">
</form>
