<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_serie = $_POST['nombre_serie'];
    $descripcion = $_POST['descripcion'];
    $id_categoria = $_POST['id_categoria'];

    $sql = "INSERT INTO Serie (nombre_serie, descripcion, id_categoria) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $nombre_serie, $descripcion, $id_categoria);

    if ($stmt->execute()) {
        echo "Serie agregada exitosamente";
    } else {
        echo "Error al agregar serie: " . $stmt->error;
    }
}
?>

<form action="series.php" method="POST">
    <label for="nombre_serie">Nombre Serie:</label>
    <input type="text" name="nombre_serie" required><br>

    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" required></textarea><br>

    <label for="id_categoria">Categoría:</label>
    <select name="id_categoria" required>
        <?php
        require 'conexion.php';
        $sql = "SELECT id_categoria, nombre_categoria FROM Categoria";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id_categoria'] . "'>" . htmlspecialchars($row['nombre_categoria'], ENT_QUOTES, 'UTF-8') . "</option>";
        }
        ?>
    </select><br>

    <input type="submit" value="Agregar Serie">
</form>
