<?php
    include("../includes/head.php");
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Inicio de la zona central del sistema -->
    <h1>Registro de Usuarios nuevos</h1>


    <form method="POST" action="guardar_usuario.php"  >
  
    <div class="row mb-3">
      <label for="inputEmail3" class="col-sm-2 col-form-label">DNI</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="txt_dni">
      </div>
    </div>

    <div class="row mb-3">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Nombres</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="txt_nombres"  >
      </div>
    </div>

    <div class="row mb-3">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Apellidos</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="txt_apellidos" >
      </div>
    </div>

    <div class="row mb-3">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Teléfono</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="txt_telefono" >
      </div>
    </div>

  


  <button type="submit" class="btn btn-primary">Guardar Usuario</button>
</form>

    <!-- Fin  de la zona central del sistema -->
</div>
<!-- /.container-fluid --> 

<?php
    include("../includes/foot.php");
?>
