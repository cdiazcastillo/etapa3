<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $rut_atleta = $_POST['rut_atleta'];
    $id_apoderado = $_POST['id_apoderado'];
    $id_rama = $_POST['id_rama'];
    $id_categoria = $_POST['id_categoria'];
    $id_serie = $_POST['id_serie'];

    // Inserta el atleta
    $sql_atleta = "INSERT INTO Atleta (nombre, rut_atleta, id_apoderado) VALUES (?, ?, ?)";
    $stmt_atleta = $conn->prepare($sql_atleta);
    $stmt_atleta->bind_param('ssi', $nombre, $rut_atleta, $id_apoderado);

    if ($stmt_atleta->execute()) {
        $id_atleta = $conn->insert_id;

        // Asignar rama
        $sql_rama = "INSERT INTO Atleta_Rama (id_atleta, id_rama) VALUES (?, ?)";
        $stmt_rama = $conn->prepare($sql_rama);
        $stmt_rama->bind_param('ii', $id_atleta, $id_rama);
        $stmt_rama->execute();

        // Asignar categoría
        $sql_categoria = "INSERT INTO Atleta_Categoria (id_atleta, id_categoria) VALUES (?, ?)";
        $stmt_categoria = $conn->prepare($sql_categoria);
        $stmt_categoria->bind_param('ii', $id_atleta, $id_categoria);
        $stmt_categoria->execute();

        echo "Atleta agregado exitosamente con todas las relaciones";
    } else {
        echo "Error al agregar atleta: " . $stmt_atleta->error;
    }
}
?>

<form action="agregar_atleta_completo.php" method="POST">
    <label for="nombre">Nombre Atleta:</label>
    <input type="text" name="nombre" required><br>

    <label for="rut_atleta">RUT Atleta:</label>
    <input type="text" name="rut_atleta" required><br>

    <label for="id_apoderado">Apoderado:</label>
    <select name="id_apoderado" required>
        <?php
        $sql = "SELECT id_apoderado, nombre FROM Apoderado";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id_apoderado'] . "'>" . htmlspecialchars($row['nombre'], ENT_QUOTES, 'UTF-8') . "</option>";
        }
        ?>
    </select><br>

    <label for="id_rama">Rama:</label>
    <select name="id_rama" required>
        <?php
        $sql = "SELECT id_rama, nombre_rama FROM Rama";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id_rama'] . "'>" . htmlspecialchars($row['nombre_rama'], ENT_QUOTES, 'UTF-8') . "</option>";
        }
        ?>
    </select><br>

    <label for="id_categoria">Categoría:</label>
    <select name="id_categoria" required>
        <?php
        $sql = "SELECT id_categoria, nombre_categoria FROM Categoria";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id_categoria'] . "'>" . htmlspecialchars($row['nombre_categoria'], ENT_QUOTES, 'UTF-8') . "</option>";
        }
        ?>
    </select><br>

    <label for="id_serie">Serie:</label>
    <select name="id_serie" required>
        <?php
        $sql = "SELECT id_serie, nombre_serie FROM Serie";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id_serie'] . "'>" . htmlspecialchars($row['nombre_serie'], ENT_QUOTES, 'UTF-8') . "</option>";
        }
        ?>
    </select><br>

    <input type="submit" value="Agregar Atleta con Relación">
</form>
