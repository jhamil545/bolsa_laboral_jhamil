<?php

include("../includes/conectar.php");

$conexion = conectar();

$id_oferta = $_POST['txt_id_oferta'];

// Obtener los datos del formulario
$titulo = $_POST['txt_titulo'];
$descripcion = $_POST['txt_descripcion'];
$fecha_publicacion = $_POST['txt_fecha_publicacion'];
$fecha_cierre = $_POST['txt_fecha_cierre'];
$remuneracion = $_POST['txt_remuneracion'];
$ubicacion = $_POST['txt_ubicacion'];
$tipo = $_POST['txt_tipo'];
$limite_postulante = $_POST['txt_limite_postulante'];

// Query para actualizar los datos en la tabla 'oferta_laboral'
$sql = "UPDATE oferta_laboral 
        SET 
            titulo='$titulo', 
            descripcion='$descripcion', 
            fecha_publicacion='$fecha_publicacion', 
            fecha_cierre='$fecha_cierre',
            remuneracion='$remuneracion',
            ubicacion='$ubicacion',
            tipo='$tipo',
            limite_postulante='$limite_postulante'
        WHERE id='$id_oferta'";



    mysqli_query($conexion, $sql) or die("Error al actualizar la oferta laboral."); 
       
        if(isset($_SESSION["SESION_ROL"]) && ($$_SESSION["SESION_ROL"] == '1')
            
        ) {
            header("Location: listar_oferta_laboral.php");
        } else {
            header("Location: listar_ofer_empresa.php");
        }
        
    
        
    
    

    
    



?>
