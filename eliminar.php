<?php
require 'config.php';

// Verificar si se ha pasado un ID válido a eliminar
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);

    // Consulta para eliminar el empleado con el ID proporcionado
    $sql = "DELETE FROM empleados WHERE no_emp = '$id'";
    $resultado = $conn->query($sql);

    if ($resultado) {
        // Éxito en la eliminación
        echo "Eliminado correctamente";
    } else {
        // Error al eliminar
        echo "Error al eliminar";
    }
} else {
    // ID no proporcionado o vacío
    echo "ID proporcionada";
}
header("Location: index.php");
