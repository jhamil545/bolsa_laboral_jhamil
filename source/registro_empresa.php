<?php
    include("../includes/head.php");
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Inicio de la zona central del sistema -->
    <h1>Registro de Empresas</h1>


    <form method="POST" action="guardar_empresa.php">
  
    <div class="row mb-3">
      <label for="inputEmail3" class="col-sm-2 col-form-label">Razón Social</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="txt_razon_social">
      </div>
    </div>

    <div class="row mb-3">
      <label for="inputPassword3" class="col-sm-2 col-form-label">RUC</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="txt_ruc">
      </div>
    </div>

    <div class="row mb-3">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Dirección</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="txt_direccion">
      </div>
    </div>

    <div class="row mb-3">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Teléfono</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="txt_telefono">
      </div>
    </div>

    <div class="row mb-3">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Correo</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" name="txt_correo">
      </div>
    </div>

    <div class="row mb-3">
      <label for="inputPassword3" class="col-sm-2 col-form-label">ID de Rol</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="txt_id_rol">
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Guardar Empresa</button>
</form>

    <!-- Fin  de la zona central del sistema -->
</div>
<!-- /.container-fluid --> 

<?php
    include("../includes/foot.php");
?>
