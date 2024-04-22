<?php
// Incluir el archivo de conexión a la base de datos
include("../includes/conectar.php");

// Establecer la conexión
$conexion = conectar();

// Consulta SQL para obtener los usuarios no asignados a ninguna empresa
$sql = "SELECT id FROM usuarios WHERE id NOT IN (SELECT DISTINCT id_usuario FROM empresas)";

// Ejecutar la consulta
$resultado = mysqli_query($conexion, $sql);

// Verificar si hay resultados
if ($resultado) {
    // Verificar si hay usuarios no asignados
    if (mysqli_num_rows($resultado) > 0) {
        // Iterar sobre cada usuario no asignado
        while ($fila = mysqli_fetch_assoc($resultado)) {
            // Obtener el ID del usuario
            $idUsuario = $fila['id'];
            
            // Actualizar el campo asignacion en la tabla usuarios con "NO" usando una consulta preparada
            $sqlUpdateUsuario = "UPDATE usuarios SET asignacion = 'NO' WHERE id = ?";
            $stmtUpdateUsuario = mysqli_prepare($conexion, $sqlUpdateUsuario);

            // Vincular el parámetro
            mysqli_stmt_bind_param($stmtUpdateUsuario, "i", $idUsuario);

            // Ejecutar la consulta de actualización
            $resultadoUpdate = mysqli_stmt_execute($stmtUpdateUsuario);

            // Verificar si la actualización fue exitosa
            if ($resultadoUpdate) {
                echo "El usuario con ID $idUsuario ha sido actualizado correctamente.";
            } else {
                echo "Error al actualizar el usuario con ID $idUsuario.";
            }

            // Cerrar la consulta preparada
            mysqli_stmt_close($stmtUpdateUsuario);
        }
    } else {
        echo "No hay usuarios sin asignación en ninguna empresa.";
    }
} else {
    echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
}

// Cerrar la conexión
mysqli_close($conexion);
?>
