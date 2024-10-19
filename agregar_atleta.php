<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $rut_atleta = $_POST['rut_atleta'];
    $id_apoderado = $_POST['id_apoderado'];

    $sql = "INSERT INTO Atleta (nombre, rut_atleta, id_apoderado) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $nombre, $rut_atleta, $id_apoderado);

    if ($stmt->execute()) {
        echo "Atleta agregado exitosamente";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>