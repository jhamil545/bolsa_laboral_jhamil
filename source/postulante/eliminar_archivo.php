<?php
// Iniciar o reanudar la sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("../includes/conectar.php");

// Verificar si se ha enviado una solicitud para eliminar el archivo
if(isset($_POST['eliminar_archivo'])) {
    // Obtener la ruta del archivo a eliminar
    $rutaArchivoEliminar = $_POST['ruta_archivo_eliminar'];
    
    // Eliminar el archivo del servidor
    if(eliminarArchivoServidor($rutaArchivoEliminar)) {
        echo "El archivo se eliminó correctamente.";
        // Aquí puedes agregar código adicional después de eliminar el archivo, si es necesario
    } else {
        echo "Error al eliminar el archivo.";
    }
    
    // Redirigir de vuelta a modificar_usuario.php después de eliminar el archivo
    header("Location: modificar_usuario.php?pid=" . $_POST['txt_id_usuario']);
    exit(); // Terminar el script después de la redirección
} else {
    // Si no se envió una solicitud válida, redirigir a alguna página de error o a modificar_usuario.php
    header("Location: modificar_usuario.php");
    exit(); // Terminar el script después de la redirección
}

// Función para eliminar el archivo del servidor
function eliminarArchivoServidor($rutaArchivo) {
    if (file_exists($rutaArchivo)) {
        unlink($rutaArchivo);
        return true; // Devuelve true si el archivo se eliminó correctamente
    } else {
        return false; // Devuelve false si el archivo no existe o no se puede eliminar
    }
}
?>
