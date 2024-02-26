<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Empleado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"] {
            width: calc(100% - 12px);
            padding: 6px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <form id="agregarForm" method="POST">
        <h2>Agregar Empleado</h2>
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre"><br>
        <label for="apellido">Apellido:</label><br>
        <input type="text" id="apellido" name="apellido"><br>
        <label for="genero">Genero:</label><br>
        <input type="text" id="genero" name="genero"><br>
        <label for="fecha_nacimiento">Fecha de Nacimiento:</label><br>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"><br>
        <label for="fecha_ingreso">Fecha de Ingreso:</label><br>
        <input type="date" id="fecha_ingreso" name="fecha_ingreso"><br><br>
        <button type="submit">Agregar Empleado</button>
    </form>
</body>

</html>

<?php
require 'config.php';

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $apellido = $conn->real_escape_string($_POST['apellido']);
    $genero = $conn->real_escape_string($_POST['genero']);
    $fecha_nacimiento = $conn->real_escape_string($_POST['fecha_nacimiento']);
    $fecha_ingreso = $conn->real_escape_string($_POST['fecha_ingreso']);

    // Consulta para insertar un nuevo empleado
    $sql_insert = "INSERT INTO empleados (nombre, apellido, genero, fecha_nacimiento, fecha_ingreso) VALUES ('$nombre', '$apellido', '$genero', '$fecha_nacimiento', '$fecha_ingreso')";
    $resultado_insert = $conn->query($sql_insert);

    if ($resultado_insert) {
        echo "<script>alert('Empleado agregado correctamente.');</script>";
        echo "<script>window.location.href = 'index.php';</script>"; // Redirigir al usuario después de agregar el empleado
    } else {
        echo "<script>alert('Error al agregar empleado.');</script>";
    }
}
?>
