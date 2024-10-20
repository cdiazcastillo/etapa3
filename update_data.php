<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_rama = $_POST['id_rama'];
    $nombre_rama = $_POST['nombre_rama'];
    $descripcion_rama = $_POST['descripcion_rama'];

    $sql = "UPDATE Rama SET nombre_rama = ?, descripcion = ? WHERE id_rama = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $nombre_rama, $descripcion_rama, $id_rama);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>