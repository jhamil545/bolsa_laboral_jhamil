<?php

include("../includes/conectar.php");
$conexion = conectar();

$id_empresa = $_POST['txt_id_empresa'];

    // Obtener el valor del id_usuario del formulario
    

$razon_social = $_POST['txt_razon_social'];
$ruc = $_POST['txt_ruc'];
$direccion = $_POST['txt_direccion'];
$telefono = $_POST['txt_telefono'];
$correo = $_POST['txt_correo'];
$id_rol = $_POST['txt_id_rol'];

$sql = "UPDATE empresas 
        SET 
            razon_social='$razon_social', 
            ruc='$ruc', 
            direccion='$direccion', 
            telefono='$telefono',
            correo='$correo',
            id_rol='$id_rol'
        WHERE id='$id_empresa'";

$resultado = mysqli_query($conexion, $sql);

if ($resultado) {
    mysqli_close($conexion); // Cerrar la conexión antes de enviar la redirección
    // Redireccionar después de cerrar la conexión
    header("Location: listar_empresa.php");
    exit; // Asegurar que no se ejecute más código después de la redirección
} else {
    echo "Error al actualizar la empresa: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>

