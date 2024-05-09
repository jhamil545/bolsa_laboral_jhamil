<?php
// Incluir el archivo de conexión a la base de datos si es necesario
include("../includes/conectar.php");
$conexion = conectar();
// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el pid y el nuevo id_rol desde el formulario
    $pid = $_POST['pid'];
    $nuevo_id_rol = $_POST['nuevo_id_rol'];

    // Actualizar el campo id_rol en la tabla de usuarios
    $sql = "UPDATE usuarios SET id_rol = $nuevo_id_rol WHERE id = $pid";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $sql)) {
        // Redirigir de vuelta a la página principal o a donde desees
        header("Location: listar_usuarios.php");
        exit(); // Asegurar que el script se detenga después de redirigir
    } else {
        echo "Error al actualizar el id_rol: " . mysqli_error($conexion);
    }
} else {
    // Si no se reciben los datos del formulario, redirigir a alguna página de error
    header("Location: error.php");
    exit();
}
?>
