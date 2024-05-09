<?php
include("../includes/conectar.php");
$conexion = conectar();
echo "<pre>";
print_r($_POST);
print_r($_FILES);
echo "</pre>";

// Verificar si se enviaron todos los datos del formulario y se cargó un archivo
if (isset($_POST['txt_id_usuario'], $_POST['txt_dni'], $_POST['txt_nombres'], $_POST['txt_apellidos'], $_POST['txt_telefono'], $_FILES['txt_ruta_cv'])) {
    // Obtener los datos del formulario
    $id_usuario = $_POST['txt_id_usuario'];
    $dni = $_POST['txt_dni'];
    $nombres = $_POST['txt_nombres'];
    $apellidos = $_POST['txt_apellidos'];
    $telefono = $_POST['txt_telefono'];

    // Procesar el archivo subido
    $ruta_destino = '../data/img/' . $_FILES['txt_ruta_cv']['name'];

    // Validar el tipo de archivo (ejemplo: solo permitir archivos PDF)
    $extension_permitida = array('pdf');
    $tipo_archivo = strtolower(pathinfo($_FILES['txt_ruta_cv']['name'], PATHINFO_EXTENSION));
    if (!in_array($tipo_archivo, $extension_permitida)) {
        echo "Error: Solo se permiten archivos PDF.";
        exit;
    }

    // Validar el tamaño del archivo (ejemplo: máximo 5 MB)
    $tamano_maximo = 5 * 1024 * 1024; // 5 MB en bytes
    if ($_FILES['txt_ruta_cv']['size'] > $tamano_maximo) {
        echo "Error: El archivo es demasiado grande. El tamaño máximo permitido es de 5 MB.";
        exit;
    }

    // Mover el archivo subido al directorio de destino
    if (!move_uploaded_file($_FILES['txt_ruta_cv']['tmp_name'], $ruta_destino)) {
        echo "Error al subir el archivo.";
        exit;
    }

    // Guardar la ruta del archivo en la base de datos
    $sql = "UPDATE usuarios 
            SET dni='$dni', 
                nombres='$nombres', 
                apellidos='$apellidos', 
                telefono='$telefono', 
                ruta_cv='$ruta_destino'
            WHERE id='$id_usuario' ";

    // Ejecutar la consulta SQL
    if (mysqli_query($conexion, $sql)) {
        echo "Éxito: Los datos se actualizaron correctamente.";
    } else {
        echo "Error al actualizar los datos en la base de datos: " . mysqli_error($conexion);
    }

    // Redirigir al usuario
    header("Location:listar_usuarios.php");
} else {
    echo "Error: Faltan datos del formulario o no se ha cargado ningún archivo.";
    exit;
}
?>
