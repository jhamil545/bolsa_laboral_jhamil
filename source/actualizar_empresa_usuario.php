<?php
// Incluir el archivo de conexión a la base de datos
include("../includes/conectar.php");

// Verificar si se han recibido los datos esperados de manera segura
if(isset($_POST['idEmpresa'], $_POST['idUsuario'])) {
    // Establecer la conexión
    $conexion = conectar();

    // Obtener los datos de manera segura
    $idEmpresa = mysqli_real_escape_string($conexion, $_POST['idEmpresa']);
    $idUsuario = mysqli_real_escape_string($conexion, $_POST['idUsuario']);

    // Verificar si el usuario ya está asignado a otra empresa
    $sqlCheckUsuario = "SELECT id FROM empresas WHERE id_usuario = ? AND id != ?";
    $stmtCheckUsuario = mysqli_prepare($conexion, $sqlCheckUsuario);
    mysqli_stmt_bind_param($stmtCheckUsuario, "ii", $idUsuario, $idEmpresa);
    mysqli_stmt_execute($stmtCheckUsuario);
    mysqli_stmt_store_result($stmtCheckUsuario);

    // usuario ya está asignado, mostrar un mensaje de error
    if(mysqli_stmt_num_rows($stmtCheckUsuario) > 0) {
        echo "El usuario ya está asignado a otra empresa.";
    } else {
        // Preparar la consulta para actualizar el campo id_usuario en la tabla empresas
        $sqlUpdateEmpresa = "UPDATE empresas SET id_usuario = ? WHERE id = ?";
        $stmtUpdateEmpresa = mysqli_prepare($conexion, $sqlUpdateEmpresa);

        // Vincular los parámetros
        mysqli_stmt_bind_param($stmtUpdateEmpresa, "ii", $idUsuario, $idEmpresa);

        // Ejecutar la consulta preparada
        $resultUpdateEmpresa = mysqli_stmt_execute($stmtUpdateEmpresa);

        // Verificar si la actualización de la empresa fue exitosa
        if($resultUpdateEmpresa) {
            // Preparar la consulta para actualizar el campo asignacion en la tabla usuarios
            $sqlUpdateUsuario = "UPDATE usuarios SET asignacion = 'SI' WHERE id = ?";
            $stmtUpdateUsuario = mysqli_prepare($conexion, $sqlUpdateUsuario);

            // Vincular el parámetro
            mysqli_stmt_bind_param($stmtUpdateUsuario, "i", $idUsuario);

            // Ejecutar la consulta preparada
            $resultUpdateUsuario = mysqli_stmt_execute($stmtUpdateUsuario);

            // Verificar si la actualización del usuario fue exitosa
            if($resultUpdateUsuario) {
                echo "Asignación exitosa.";
            } else {
                echo "Error al actualizar el usuario.";
            }
        } else {
            echo "Error al actualizar la empresa.";
        }

        // Cerrar la consulta preparada para actualizar empresa si está inicializada
        if(isset($stmtUpdateEmpresa)) {
            mysqli_stmt_close($stmtUpdateEmpresa);
        }

        // Cerrar la consulta preparada para actualizar usuario si está inicializada
        if(isset($stmtUpdateUsuario)) {
            mysqli_stmt_close($stmtUpdateUsuario);
        }
    }

    // Cerrar la consulta preparada para verificar usuario si está inicializada
    if(isset($stmtCheckUsuario)) {
        mysqli_stmt_close($stmtCheckUsuario);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    echo "No se recibieron los datos esperados.";
}

// Redirigir a la página de verificación de usuario
header("Location: verificacion_usuario.php");
exit;
?>
