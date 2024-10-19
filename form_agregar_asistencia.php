<form action="agregar_asistencia.php" method="POST">
    <label for="id_atleta">Atleta:</label>
    <select name="id_atleta" required>
        <?php
        require 'conexion.php';
        $sql = "SELECT id_atleta, nombre FROM Atleta";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id_atleta'] . "'>" . htmlspecialchars($row['nombre'], ENT_QUOTES, 'UTF-8') . "</option>";
        }
        ?>
    </select><br>

    <label for="id_profesor">Profesor:</label>
    <select name="id_profesor" required>
        <?php
        $sql = "SELECT id_profesor, nombre_profesor FROM Profesor";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id_profesor'] . "'>" . htmlspecialchars($row['nombre_profesor'], ENT_QUOTES, 'UTF-8') . "</option>";
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

    <label for="asistencia">Asistencia:</label>
    <input type="checkbox" name="asistencia" value="1"><br>

    <label for="fecha_clase">Fecha de Clase:</label>
    <input type="date" name="fecha_clase" required><br>

    <input type="submit" value="Registrar Asistencia">
</form>