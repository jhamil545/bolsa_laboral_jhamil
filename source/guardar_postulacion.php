<?php
    include("../includes/conectar.php");

    $conexion = conectar();

    // Recibimos los datos del formulario
    $id_usuario = $_POST['id_usuario'];
    $id_oferta = $_POST['id_oferta'];
    $estado_actual = $_POST['estado_actual'];
    $usuario_seleccionado = $_POST['usuario_seleccionado'];

    // Guardamos los datos en la tabla 'postulaciones'
    $sql = "INSERT INTO postulaciones (id_usuario, id_oferta, estado_actual, usuario_seleccionado) 
            VALUES ('$id_usuario', '$id_oferta', '$estado_actual', '$usuario_seleccionado')";

    mysqli_query($conexion, $sql) or die("Error al guardar la postulación.");

    header("Location: listar_postulaciones.php");
?>
