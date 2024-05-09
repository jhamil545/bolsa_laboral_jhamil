<?php
// Iniciar o reanudar la sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("../includes/conectar.php");

$conexion = conectar();

// Verificar si se ha enviado una solicitud para eliminar el archivo
if(isset($_POST['eliminar_archivo'])) {
    // Obtener la ruta del archivo a eliminar
    $ruta_archivo_eliminar = $_POST['ruta_archivo_eliminar'];
    
    // Código para eliminar el archivo del servidor
    if(unlink($ruta_archivo_eliminar)) {
        echo "Archivo eliminado correctamente.";
    } else {
        echo "Error al eliminar el archivo del servidor.";
    }
} else {
    echo "No se ha enviado una solicitud para eliminar el archivo.";
}
?>
