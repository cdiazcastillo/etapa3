
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Sistema Deportivo</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #007bff;
            padding: 15px;
            color: white;
            text-align: center;
            display: flex;
            justify-content: space-around;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        .navbar a:hover {
            text-decoration: underline;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: fixed;
        }
        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            word-wrap: break-word;
        }
        table th {
            background-color: #f1f1f1;
        }
        table tr:hover {
            background-color: #f9f9f9;
        }
        .editable-cell input {
            width: 100%;
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .save-btn, .cancel-btn {
            display: none;
        }
        .green-btn {
            background-color: #28a745;
        }
        form {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #f8f8f8;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        form input, form button {
            display: block;
            margin: 10px 0;
            padding: 10px;
            width: 100%;
        }
        form button {
            width: auto;
        }
    </style>
</head>
<body>

<div class="navbar">
    <a href="index.php">Ramas</a>
    <a href="categorias.php">Categorías</a>
    <a href="series.php">Series</a>
    <a href="alumnos.php">Alumnos</a>
    <a href="apoderados.php">Apoderados</a>
    <a href="profesores.php">Profesores</a>
    <a href="asistencias.php">Asistencias</a>
</div>

<div class="container">

    <!-- Formulario para agregar nuevas ramas -->
    <form id="addRamaForm">
        <h2>Agregar Nueva Rama</h2>
        <input type="text" id="nombre_rama" name="nombre_rama" placeholder="Nombre de la Rama" required>
        <input type="text" id="descripcion_rama" name="descripcion_rama" placeholder="Descripción" required>
        <button type="button" id="addRamaBtn">Agregar Rama</button>
    </form>

    <h2>Ramas Existentes</h2>
    <table id="ramasTable" class="display">
        <thead>
            <tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Acciones</th></tr>
        </thead>
        <tbody>
            <?php
            require 'conexion.php';
            $sql = "SELECT * FROM Rama";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr data-id='" . $row['id_rama'] . "'>
                        <td class='editable-cell'>" . $row['id_rama'] . "</td>
                        <td class='editable-cell' data-field='nombre_rama'>" . $row['nombre_rama'] . "</td>
                        <td class='editable-cell' data-field='descripcion'>" . $row['descripcion'] . "</td>
                        <td>
                            <button class='edit-btn'>Modificar</button>
                            <button class='delete-btn'>Eliminar</button>
                            <button class='save-btn green-btn'>Guardar</button>
                            <button class='cancel-btn'>Cancelar</button>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#ramasTable').DataTable();

        // Edit button
        $('.edit-btn').on('click', function() {
            var row = $(this).closest('tr');
            row.data('original', row.html());  // Store original HTML before editing
            row.find('.editable-cell').each(function() {
                var text = $(this).text();
                $(this).html('<input type="text" value="' + text + '">');
            });
            $(this).hide();
            row.find('.delete-btn').hide();
            row.find('.save-btn, .cancel-btn').show().css('display', 'inline-block');
        });

        // Save button
        $('.save-btn').on('click', function() {
            var row = $(this).closest('tr');
            var id = row.data('id');
            var data = {};
            row.find('.editable-cell').each(function() {
                var field = $(this).data('field');
                var value = $(this).find('input').val();
                data[field] = value;
            });

            $.ajax({
                url: 'update_rama.php',
                method: 'POST',
                data: {
                    id_rama: id,
                    nombre_rama: data['nombre_rama'],
                    descripcion_rama: data['descripcion']
                },
                success: function(response) {
                    if (response === 'success') {
                        row.find('.editable-cell').each(function() {
                            var input = $(this).find('input');
                            $(this).text(input.val());
                        });
                        row.find('.save-btn, .cancel-btn').hide();
                        row.find('.edit-btn, .delete-btn').show();
                    }
                }
            });
        });

        // Cancel button
        $('.cancel-btn').on('click', function() {
            var row = $(this).closest('tr');
            row.html(row.data('original')); // Restore original HTML
        });

        // Add Rama functionality
        $('#addRamaBtn').on('click', function() {
            var nombreRama = $('#nombre_rama').val();
            var descripcionRama = $('#descripcion_rama').val();

            if (nombreRama && descripcionRama) {
                $.ajax({
                    url: 'add_rama.php',
                    method: 'POST',
                    data: {
                        nombre_rama: nombreRama,
                        descripcion_rama: descripcionRama
                    },
                    success: function(response) {
                        if (response === 'success') {
                            location.reload(); // Reload the page to show the new rama
                        }
                    }
                });
            }
        });

        // Delete button
        $('.delete-btn').on('click', function() {
            var row = $(this).closest('tr');
            var id = row.data('id');
            if (confirm('¿Estás seguro de eliminar esta rama?')) {
                $.ajax({
                    url: 'delete_rama.php',
                    method: 'POST',
                    data: { id_rama: id },
                    success: function(response) {
                        if (response === 'success') {
                            row.remove();
                        }
                    }
                });
            }
        });
    });
</script>
</body>
</html>
