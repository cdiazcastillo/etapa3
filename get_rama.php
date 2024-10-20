<?php
require 'conexion.php';

if (isset($_GET['id_rama'])) {
    $id_rama = $_GET['id_rama'];

    $sql = "SELECT * FROM Rama WHERE id_rama = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id_rama);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo 'error';
    }
}
?>