<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_rama = $_POST['id_rama'];

    $sql = "DELETE FROM Rama WHERE id_rama = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id_rama);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>