<?php
// Incluir archivos necesarios
include("../includes/head.php");
include("../includes/conectar.php");

// Establecer conexión a la base de datos
$conexion = conectar();

// Obtener el ID de la oferta a eliminar
$id_oferta = $_GET['pid'];

// Query para eliminar la oferta laboral
$sql = "DELETE FROM oferta_laboral WHERE id = '$id_oferta'";

// Ejecutar la consulta
$resultado = mysqli_query($conexion, $sql);

// Verificar si la consulta se ejecutó correctamente
if ($resultado) {
    // Redireccionar a la página de listar_oferta_laboral.php
    header("Location: listar_oferta_laboral.php");
    exit; // Finalizar la ejecución del script
} else {
    // Mostrar mensaje de error en caso de fallo
    echo "Error al eliminar la oferta laboral: " . mysqli_error($conexion);
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
