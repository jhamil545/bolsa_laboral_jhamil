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

    // Cerrar la consulta preparada y la conexión a la base de datos
    mysqli_stmt_close($stmtUpdateEmpresa);
    mysqli_stmt_close($stmtUpdateUsuario);
    mysqli_close($conexion);
} else {
    echo "No se recibieron los datos esperados.";
}

?>
<?php
$ruta = "verificacion_usuario.php";

header("Location: $ruta");
exit;
?>