<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_rama = $_POST['nombre_rama'];
    $descripcion_rama = $_POST['descripcion_rama'];
    $nombre_categoria = $_POST['nombre_categoria'];
    $descripcion_categoria = $_POST['descripcion_categoria'];
    $nombre_serie = $_POST['nombre_serie'];
    $descripcion_serie = $_POST['descripcion_serie'];
    $id_categoria = $_POST['id_categoria'];

    // Insertar Rama
    $sql_rama = "INSERT INTO Rama (nombre_rama, descripcion) VALUES (?, ?)";
    $stmt_rama = $conn->prepare($sql_rama);
    $stmt_rama->bind_param('ss', $nombre_rama, $descripcion_rama);
    $stmt_rama->execute();

    // Insertar Categoría
    $sql_categoria = "INSERT INTO Categoria (nombre_categoria, descripcion) VALUES (?, ?)";
    $stmt_categoria = $conn->prepare($sql_categoria);
    $stmt_categoria->bind_param('ss', $nombre_categoria, $descripcion_categoria);
    $stmt_categoria->execute();

    // Insertar Serie
    $sql_serie = "INSERT INTO Serie (nombre_serie, descripcion, id_categoria) VALUES (?, ?, ?)";
    $stmt_serie = $conn->prepare($sql_serie);
    $stmt_serie->bind_param('ssi', $nombre_serie, $descripcion_serie, $id_categoria);
    $stmt_serie->execute();

    header("Location: index.php");
}
?>
