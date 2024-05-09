<?php
    // Incluir el archivo de conexión a la base de datos
    include("../includes/conectar.php");

    // Verificar si se recibió un ID de empresa para eliminar
    if(isset($_GET['pid'])) {
        // Obtener el ID de la empresa a eliminar
        $id_usuario = $_GET['pid'];

        // Realizar la eliminación de la empresa en la base de datos
        $conexion = conectar();
        $sql = "DELETE FROM usuarios WHERE id='$id_usuario'";
        $resultado = mysqli_query($conexion, $sql);

        // Verificar si la eliminación fue exitosa
        if($resultado) {
            // Redireccionar de vuelta a la lista de empresas con un mensaje de éxito
            header("Location: listar_usuarios.php?eliminado=true");
            exit; // Detener la ejecución del script después de la redirección
        } else {
            // Mostrar mensaje de error de MySQL
            echo "Error al eliminar la usuario: " . mysqli_error($conexion);
            exit; // Detener la ejecución del script después del mensaje de error
        }
    } else {
        // Si no se recibió un ID de empresa, redireccionar de vuelta a la lista de empresas
        header("Location: listar_usuarios.php");
        exit; // Detener la ejecución del script después de la redirección
    }
?>
