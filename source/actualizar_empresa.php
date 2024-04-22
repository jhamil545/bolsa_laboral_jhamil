<?php
    include("../includes/head.php");
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
    $id_usuario = $_POST['txt_id_usuario'];

    $sql="UPDATE empresas 
          SET 
            razon_social='$razon_social', 
            ruc='$ruc', 
            direccion='$direccion', 
            telefono='$telefono',
            correo='$correo',
            id_rol='$id_rol',
            id_usuario='$id_usuario'  -- Agregamos la actualización del id_usuario
          WHERE id='$id_empresa' ";

    mysqli_query($conexion,$sql);

    header("Location: listar_empresa.php");
?>

<?php
include("../includes/conectar.php");
$conexion = conectar();

    // Obtener los datos del formulario
    $idEmpresa = $_POST['txt_id_empresa'];
    $razonSocial = $_POST['txt_razon_social'];
    $ruc = $_POST['txt_ruc'];
    $direccion = $_POST['txt_direccion'];
    $telefono = $_POST['txt_telefono'];
    $correo = $_POST['txt_correo'];
    $id_rol = $_POST['txt_id_rol'];

// Nuevo campo para el usuario asignado
    $idUsuario = $_POST['select_usuario'];

// Actualizar los datos de la empresa en la base de datos
$sqlUpdateEmpresa = "UPDATE empresas SET razon_social = '$razonSocial', id_usuario = '$idUsuario' WHERE id = '$idEmpresa'";
$resultadoEmpresa = mysqli_query($conexion, $sqlUpdateEmpresa);

if ($resultadoEmpresa) {
    echo "Empresa actualizada correctamente";
} else {
    echo "Error al actualizar la empresa: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>

