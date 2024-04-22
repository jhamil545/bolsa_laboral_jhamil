<?php
    include("../includes/head.php");
    include("../includes/conectar.php");

    $conexion = conectar();
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Inicio de la zona central del sistema -->
    <h1>Modificar datos de Usuario</h1>

    <?php
        //recibimos el id a modificar
        $pid=$_REQUEST['pid'];

        $sql="SELECT * FROM usuarios WHERE id='$pid'";
        $registro=mysqli_query($conexion,$sql);

        //en la variable $fila tenemos todos los datos del
        //registro que se desea modificar
        $fila=mysqli_fetch_array($registro);
        //echo print_r($fila);
    ?>

  <form method="POST" action="actualizar_usuario.php"  >
    
    <input type="text" class="form-control" name="txt_id_usuario" value="<?php echo $fila['id'] ?>">    

      <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">DNI</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="txt_dni" value="<?php echo $fila['dni'] ?>">
        </div>
      </div>

      <div class="row mb-3">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Nombres</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="txt_nombres" value="<?php echo $fila['nombres'] ?>"  >
        </div>
      </div>

      <div class="row mb-3">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Apellidos</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="txt_apellidos" value="<?php echo $fila['apellidos'] ?>" >
        </div>
      </div>

      <div class="row mb-3">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Teléfono</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="txt_telefono" value="<?php echo $fila['telefono'] ?>" >
        </div>
      </div>

    


    <button type="submit" class="btn btn-success">Actualizar Usuario</button>
  </form>


    

    <!-- Fin  de la zona central del sistema -->
</div>
<!-- /.container-fluid --> 

<?php
    include("../includes/foot.php");
?>