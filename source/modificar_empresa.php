




<?php
include("../includes/head.php");
include("../includes/conectar.php");

$conexion = conectar();

$pid = $_REQUEST['pid'];

$sql_empresa = "SELECT * FROM empresas WHERE id='$pid'";
$registro_empresa = mysqli_query($conexion, $sql_empresa);
$fila_empresa = mysqli_fetch_array($registro_empresa);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar datos de Empresa</title>
</head>

<body>
    <div class="container-fluid">
        <h1>Modificar datos de Empresa</h1>

        <form method="POST" action="actualizar_empresa.php">

            <input type="hidden" name="txt_id_empresa" value="<?php echo $fila_empresa['id']; ?>">

            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Razón Social</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="txt_razon_social" value="<?php echo $fila_empresa['razon_social'] ?>">
                </div>
            </div>         
           
            <div class="row mb-3">
                <label for="inputRUC" class="col-sm-2 col-form-label">RUC</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="txt_ruc" value="<?php echo $fila_empresa['ruc']; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputDireccion" class="col-sm-2 col-form-label">Dirección</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="txt_direccion" value="<?php echo $fila_empresa['direccion']; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputTelefono" class="col-sm-2 col-form-label">Teléfono</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="txt_telefono" value="<?php echo $fila_empresa['telefono']; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputEmail" class="col-sm-2 col-form-label">Correo</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="txt_correo" value="<?php echo $fila_empresa['correo']; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputIDRol" class="col-sm-2 col-form-label">ID de Rol</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="txt_id_rol" value="<?php echo $fila_empresa['id_rol']; ?>">
                </div>
            </div>
            
            <button type="submit" class="btn btn-success">Actualizar Empresa</button>
        </form>
    </div>

    <?php include("../includes/foot.php"); ?>
</body>

</html>

