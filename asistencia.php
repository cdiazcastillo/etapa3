<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcar Asistencia</title>
</head>
<body>
    <h1>Marcar Asistencia</h1>

    <?php
    if (isset($_GET['id_atleta'])) {
        $id_atleta = $_GET['id_atleta'];
        
        // Obtener información del atleta
        $query = "SELECT nombre FROM Atleta WHERE id_atleta = $id_atleta";
        $result = $conn->query($query);
        $atleta = $result->fetch_assoc();

        echo "<h2>Atleta: " . $atleta['nombre'] . "</h2>";
    }
    ?>

    <!-- Formulario para registrar asistencia -->
    <form action="asistencia.php" method="POST">
        <input type="hidden" name="id_atleta" value="<?php echo $id_atleta; ?>">
        Profesor: 
        <select name="id_profesor" required>
            <?php
            $query = "SELECT * FROM Profesor";
            $result = $conn->query($query);
            while($row = $result->fetch_assoc()) {
                echo "<option value='".$row['id_profesor']."'>".$row['nombre_profesor']."</option>";
            }
            ?>
        </select><br>
        Rama: 
        <select name="id_rama" required>
            <?php
            $query = "SELECT * FROM Rama";
            $result = $conn->query($query);
            while($row = $result->fetch_assoc()) {
                echo "<option value='".$row['id_rama']."'>".$row['nombre_rama']."</option>";
            }
            ?>
        </select><br>
        Categoría: 
        <select name="id_categoria" required>
            <?php
            $query = "SELECT * FROM Categoria";
            $result = $conn->query($query);
            while($row = $result->fetch_assoc()) {
                echo "<option value='".$row['id_categoria']."'>".$row['nombre_categoria']."</option>";
            }
            ?>
        </select><br>
        Serie: 
        <select name="id_serie" required>
            <?php
            $query = "SELECT * FROM Serie";
            $result = $conn->query($query);
            while($row = $result->fetch_assoc()) {
                echo "<option value='".$row['id_serie']."'>".$row['nombre_serie']."</option>";
            }
            ?>
        </select><br>
        Asistencia: 
        <input type="radio" name="asistencia" value="1" required> Presente
        <input type="radio" name="asistencia" value="0" required> Ausente<br>

        <button type="submit" name="marcar_asistencia">Registrar Asistencia</button>
    </form>

    <?php
    // Insertar asistencia en la base de datos
    if (isset($_POST['marcar_asistencia'])) {
        $id_atleta = $_POST['id_atleta'];
        $id_profesor = $_POST['id_profesor'];
        $id_rama = $_POST['id_rama'];
        $id_categoria = $_POST['id_categoria'];
        $id_serie = $_POST['id_serie'];
        $asistencia = $_POST['asistencia'];
        $fecha_clase = date("Y-m-d");

        $query = "INSERT INTO Asistencia (id_atleta, id_profesor, id_rama, id_categoria, id_serie, fecha_clase, asistencia)
                  VALUES ('$id_atleta', '$id_profesor', '$id_rama', '$id_categoria', '$id_serie', '$fecha_clase', '$asistencia')";
        if ($conn->query($query)) {
            echo "Asistencia registrada con éxito";
        } else {
            echo "Error: " . $conn->error;
        }
    }
    ?>

</body>
</html>
