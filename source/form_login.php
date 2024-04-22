<?php
    include("../includes/head.php");
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Inicio de la zona central del sistema -->
    <!-- To do -->
    <h1>Acceder al Sistema</h1>


    <div class="row dflex flexwrap justify-content-center">
        <div class="col-6">
            <form class="p-2" method="POST" action="login.php" >
                <div class="form-group">
                    <label>Usuario:</label>
                    <input name="txt_usuario" type="text" class="form-control" placeholder="Ingrese usuario" required="required">
                    
                </div>
                
                <div class="form-group">
                    <label>Contraseña</label>
                    <input name="txt_password" type="password" class="form-control" placeholder="Password" required="required">
                </div>

                <?php
                    if(isset($_REQUEST['error_login'])){
                ?>

                <div class="form-group">
                    <div class="alert alert-danger" role="alert">
                        Datos de usuario y contraseña incorrectos.
                    </div>                    
                </div>

                <?php
                    }
                ?>
 


            
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>


    <!-- Fin  de la zona central del sistema -->
</div>
<!-- /.container-fluid --> 

<?php
    include("../includes/foot.php");
?>