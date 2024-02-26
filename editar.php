<?php
require 'config.php';

// Verificar si se ha pasado un ID válido a editar
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);

    // Consulta para obtener los datos del empleado con el ID proporcionado
    $sql = "SELECT * FROM empleados WHERE no_emp = '$id'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $empleado = $resultado->fetch_assoc();
?>

        <!DOCTYPE html>
        <html lang="es">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Editar Empleado</title>
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
            <form id="editarForm" method="POST">
                <h2>Editar Empleado</h2>
                <input type="hidden" name="id" value="<?php echo $empleado['no_emp']; ?>">
                <label for="nombre">Nombre:</label><br>
                <input type="text" id="nombre" name="nombre" value="<?php echo $empleado['nombre']; ?>"><br>
                <label for="apellido">Apellido:</label><br>
                <input type="text" id="apellido" name="apellido" value="<?php echo $empleado['apellido']; ?>"><br>
                <label for="genero">Genero:</label><br>
                <input type="text" id="genero" name="genero" value="<?php echo $empleado['genero']; ?>"><br>
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label><br>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $empleado['fecha_nacimiento']; ?>"><br>
                <label for="fecha_ingreso">Fecha de Ingreso:</label><br>
                <input type="date" id="fecha_ingreso" name="fecha_ingreso" value="<?php echo $empleado['fecha_ingreso']; ?>"><br><br>
                <button type="submit">Guardar Cambios</button>
            </form>
        </body>

        </html>

<?php
    } else {
        echo "No se encontró ningún empleado con ese ID.";
    }
} else {
    echo "ID de empleado no proporcionado.";
}

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $conn->real_escape_string($_POST['id']);
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $apellido = $conn->real_escape_string($_POST['apellido']);
    $genero = $conn->real_escape_string($_POST['genero']);
    $fecha_nacimiento = $conn->real_escape_string($_POST['fecha_nacimiento']);
    $fecha_ingreso = $conn->real_escape_string($_POST['fecha_ingreso']);

    // Consulta para actualizar los datos del empleado
    $sql_update = "UPDATE empleados SET nombre = '$nombre', apellido = '$apellido', genero = '$genero', fecha_nacimiento = '$fecha_nacimiento', fecha_ingreso = '$fecha_ingreso' WHERE no_emp = '$id'";
    $resultado_update = $conn->query($sql_update);

    if ($resultado_update) {
        echo "<script>alert('Los cambios se guardaron correctamente.');</script>";
        echo "<script>window.location.href = 'index.php';</script>"; // Redirigir al usuario después de actualizar los datos
    } else {
        echo "<script>alert('Error al guardar los cambios.');</script>";
    }
}
?>
