<?php
    include("../includes/conectar.php");

    $conexion = conectar();

    // Recibimos los datos del formulario
    $id_empresa = $_POST['id_empresa'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion']; // Corregir nombre del campo
    $fecha_publicacion = $_POST['fecha_publicacion'];
    $fecha_cierre = $_POST['fecha_cierre'];
    $remuneracion = $_POST['remuneracion'];
    $ubicacion = $_POST['ubicacion'];
    $tipo = $_POST['tipo'];
    $limite_postulante = $_POST['limite_postulante'];

    // Guardamos los datos en la tabla 'oferta_laboral'
    $sql = "INSERT INTO oferta_laboral (id_empresa, titulo, descripcion, fecha_publicacion, fecha_cierre, remuneracion, ubicacion, tipo, limite_postulante) 
            VALUES ('$id_empresa','$titulo', '$descripcion', '$fecha_publicacion', '$fecha_cierre', '$remuneracion', '$ubicacion', '$tipo', '$limite_postulante')";

    mysqli_query($conexion, $sql) or die("Error al guardar.");

    header("Location: listar_oferta_laboral.php");
?>

