<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Atletas</title>
</head>
<body>
    <h1>Gestión de Atletas y Asistencia</h1>

    <!-- Formulario para agregar Atleta -->
    <h2>Agregar Atleta</h2>
    <form action="index.php" method="POST">
        Nombre: <input type="text" name="nombre" required><br>
        RUT: <input type="text" name="rut_atleta" required><br>
        Apoderado: 
        <select name="id_apoderado" required>
            <?php
            $query = "SELECT * FROM Apoderado";
            $result = $conn->query($query);
            while($row = $result->fetch_assoc()) {
                echo "<option value='".$row['id_apoderado']."'>".$row['nombre']."</option>";
            }
            ?>
        </select><br>
        <button type="submit" name="agregar_atleta">Agregar</button>
    </form>

    <?php
    // Insertar Atleta en la base de datos
    if (isset($_POST['agregar_atleta'])) {
        $nombre = $_POST['nombre'];
        $rut_atleta = $_POST['rut_atleta'];
        $id_apoderado = $_POST['id_apoderado'];

        $query = "INSERT INTO Atleta (nombre, rut_atleta, id_apoderado) VALUES ('$nombre', '$rut_atleta', '$id_apoderado')";
        if ($conn->query($query)) {
            echo "Atleta agregado con éxito";
        } else {
            echo "Error: " . $conn->error;
        }
    }
    ?>

    <!-- Listar Atletas -->
    <h2>Lista de Atletas</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>RUT</th>
            <th>Apoderado</th>
            <th>Acciones</th>
        </tr>
        <?php
        $query = "SELECT A.id_atleta, A.nombre, A.rut_atleta, P.nombre AS apoderado FROM Atleta A JOIN Apoderado P ON A.id_apoderado = P.id_apoderado";
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id_atleta']}</td>
                <td>{$row['nombre']}</td>
                <td>{$row['rut_atleta']}</td>
                <td>{$row['apoderado']}</td>
                <td>
                    <a href='asistencia.php?id_atleta={$row['id_atleta']}'>Marcar Asistencia</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>
