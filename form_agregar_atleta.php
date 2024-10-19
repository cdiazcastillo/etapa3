<form action="agregar_atleta.php" method="POST">
    <label for="nombre">Nombre Atleta:</label>
    <input type="text" name="nombre" required><br>

    <label for="rut_atleta">RUT Atleta:</label>
    <input type="text" name="rut_atleta" required><br>

    <label for="id_apoderado">Apoderado:</label>
    <select name="id_apoderado" required>
        <?php
        require 'conexion.php';
        $sql = "SELECT id_apoderado, nombre FROM Apoderado";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id_apoderado'] . "'>" . htmlspecialchars($row['nombre'], ENT_QUOTES, 'UTF-8') . "</option>";
        }
        ?>
    </select><br>

    <input type="submit" value="Agregar Atleta">
</form>