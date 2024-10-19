<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_categoria = $_POST['nombre_categoria'];
    $descripcion = $_POST['descripcion'];

    $sql = "INSERT INTO Categoria (nombre_categoria, descripcion) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $nombre_categoria, $descripcion);

    if ($stmt->execute()) {
        echo "Categoría agregada exitosamente";
    } else {
        echo "Error al agregar categoría: " . $stmt->error;
    }
}
?>

<form action="categorias.php" method="POST">
    <label for="nombre_categoria">Nombre Categoría:</label>
    <input type="text" name="nombre_categoria" required><br>

    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" required></textarea><br>

    <input type="submit" value="Agregar Categoría">
</form>
