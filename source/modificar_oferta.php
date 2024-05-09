<?php
include("../includes/head.php");
include("../includes/conectar.php");

$conexion = conectar();

$pid = $_REQUEST['pid'];

$sql_oferta = "SELECT * FROM oferta_laboral WHERE id='$pid'";
$registro_oferta = mysqli_query($conexion, $sql_oferta);
$fila_oferta = mysqli_fetch_array($registro_oferta);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar datos de Oferta Laboral</title>
</head>

<body>
    <div class="container-fluid">
        <h1>Modificar datos de Oferta Laboral</h1>

        <form method="POST" action="actualizar_oferta.php">

            <input type="hidden" name="txt_id_oferta" value="<?php echo $fila_oferta['id']; ?>">

            <div class="row mb-3">
                <label for="inputTitulo" class="col-sm-2 col-form-label">Título</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="txt_titulo" value="<?php echo $fila_oferta['titulo'] ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputDescripcion" class="col-sm-2 col-form-label">Descripción</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="txt_descripcion"><?php echo $fila_oferta['descripcion'] ?></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputFechaPublicacion" class="col-sm-2 col-form-label">Fecha de Publicación</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="txt_fecha_publicacion" value="<?php echo $fila_oferta['fecha_publicacion'] ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputFechaCierre" class="col-sm-2 col-form-label">Fecha de Cierre</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="txt_fecha_cierre" value="<?php echo $fila_oferta['fecha_cierre'] ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputRemuneracion" class="col-sm-2 col-form-label">Remuneración</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="txt_remuneracion" value="<?php echo $fila_oferta['remuneracion'] ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputUbicacion" class="col-sm-2 col-form-label">Ubicación</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="txt_ubicacion" value="<?php echo $fila_oferta['ubicacion'] ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputTipo" class="col-sm-2 col-form-label">Tipo</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="txt_tipo" value="<?php echo $fila_oferta['tipo'] ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputLimitePostulantes" class="col-sm-2 col-form-label">Límite de Postulantes</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="txt_limite_postulante" value="<?php echo $fila_oferta['limite_postulante'] ?>">
                </div>
            </div>

            <button type="submit" class="btn btn-success">Actualizar Oferta Laboral</button>
        </form>
    </div>

    <?php include("../includes/foot.php"); ?>
</body>

</html>
