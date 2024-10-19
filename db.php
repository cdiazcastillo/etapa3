<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'control_asistencia';

// Crear conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
