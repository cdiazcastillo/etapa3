<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_profesor = $_POST['nombre_profesor'];
    $rut_profesor = $_POST['rut_profesor'];
    $telefono = $_POST['telefono'];

    $sql = "INSERT INTO Profesor (nombre_profesor, rut_profesor, telefono) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $nombre_profesor, $rut_profesor, $telefono);

    if ($stmt->execute()) {
        echo "Profesor agregado exitosamente";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>