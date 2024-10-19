<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de la Base de Datos</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .verde {
            background-color: #4CAF50;
            color: white;
        }
        .amarillo {
            background-color: #FFEB3B;
        }
        .rojo {
            background-color: #F44336;
            color: white;
        }
    </style>
</head>
<body>

    <h1>Estado de la Base de Datos</h1>

    <table>
        <tr>
            <th>Tabla</th>
            <th>Registros</th>
            <th>Tamaño (MB)</th>
            <th>Estado</th>
            <th>Glosa</th>
        </tr>

        <?php
        $total_size = 0;

        // Obtener las tablas y su cantidad de registros
        $query_tables = "SHOW TABLE STATUS";
        $result = $conn->query($query_tables);

        while ($row = $result->fetch_assoc()) {
            $table_name = $row['Name'];
            $rows = $row['Rows'];
            $size = ($row['Data_length'] + $row['Index_length']) / (1024 * 1024);  // Convertir bytes a MB
            $total_size += $size;

            // Definir el estado en base al tamaño y cantidad de registros
            if ($size < 10 && $rows < 1000) {
                $class = "verde";
                $estado = "Bueno";
            } elseif ($size >= 10 && $size <= 50 || $rows >= 1000 && $rows <= 5000) {
                $class = "amarillo";
                $estado = "Moderado";
            } else {
                $class = "rojo";
                $estado = "Crítico";
            }

            echo "<tr>
                    <td>{$table_name}</td>
                    <td>{$rows}</td>
                    <td>" . round($size, 2) . " MB</td>
                    <td class='{$class}'>{$estado}</td>
                    <td class='{$class}'>Estado: {$estado}</td>
                  </tr>";
        }
        ?>

        <tr>
            <td colspan="2"><strong>Total Tamaño de la Base de Datos:</strong></td>
            <td><strong><?php echo round($total_size, 2); ?> MB</strong></td>
            <td colspan="2"></td>
        </tr>
    </table>

</body>
</html>
