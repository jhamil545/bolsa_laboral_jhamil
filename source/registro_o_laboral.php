<?php
    include("../includes/head.php");

    // Incluir el archivo que contiene la función conectar()
    include("../includes/conectar.php");

    // Verificar si el usuario ha iniciado sesión
    if(isset($_SESSION['SESION_NOMBRES'])) {                        
        echo "Bienvenido ".$_SESSION['SESION_NOMBRES']." ".$_SESSION['SESION_APELLIDOS'];
        
        // Obtener el nombre de usuario logueado
        $nombre_usuario = $_SESSION['SESION_NOMBRES'];
        
        // Inicializar la conexión a la base de datos
        $conexion = conectar();

        // Suponiendo que ya tienes la conexión a la base de datos establecida

        // Consulta SQL para obtener el ID del usuario
        $sql = "SELECT id FROM usuarios WHERE nombres = '$nombre_usuario'";

        // Ejecutar la consulta
        $resultado = mysqli_query($conexion, $sql);

        // Verificar si se encontraron resultados
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            // Obtener el primer resultado (asumiendo que solo hay uno)
            $fila = mysqli_fetch_assoc($resultado);
            $id_usuario = $fila['id'];
            
            // Imprimir el ID del usuario
            echo "El ID del usuario es: " . $id_usuario;
        } else {
            // Si no se encontraron resultados
            echo "No se encontró ningún usuario con ese nombre.";
        }

        // Inicializar la conexión a la base de datos
        $conexion = conectar();

        // Suponiendo que ya tienes la conexión a la base de datos establecida y el ID del usuario obtenido previamente

        // Consulta SQL para obtener el ID de la empresa asociada al usuario
        $sql_empresa = "SELECT id FROM empresas WHERE id_usuario = '$id_usuario'";

        // Ejecutar la consulta
        $resultado_empresa = mysqli_query($conexion, $sql_empresa);

        // Verificar si se encontraron resultados
        if ($resultado_empresa !== false && mysqli_num_rows($resultado_empresa) > 0) {
            // Obtener el primer resultado (asumiendo que solo hay uno)
            $fila_empresa = mysqli_fetch_assoc($resultado_empresa);
            $id_empresa = $fila_empresa['id'];
            
            // Imprimir el ID de la empresa asociada al usuario
            echo "El ID de la empresa asociada al usuario es: " . $id_empresa;
        } else {
            // Si no se encontraron resultados
            echo "No se encontró ninguna empresa asociada al usuario.";
        }
    }
?>


    

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Inicio de la zona central del sistema -->
    <h1>Registro de Oferta Laboral</h1>

    <form method="POST" action="guardar_oferta_laboral.php">
        <!-- Campo para mostrar el nombre de la empresa -->
        <div class="row mb-3">
            <label for="inputEmpresa" class="col-sm-2 col-form-label">Empresa</label>
            <div class="col-sm-10">
                <!-- Mostrar el ID de la empresa asociada al usuario -->
                <input type="number" class="form-control" id="inputEmpresa" name="id_empresa" value="<?php echo isset($id_empresa) ? $id_empresa : ''; ?>" readonly>
            </div>
        </div>




        <div class="row mb-3">
            <label for="inputTitulo" class="col-sm-2 col-form-label">Título</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="titulo" id="inputTitulo">
            </div>
        </div>

        <div class="row mb-3">
            <label for="inputDescripcion" class="col-sm-2 col-form-label">Descripción</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="descripcion" id="inputDescripcion" rows="4"></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label for="inputFechaPublicacion" class="col-sm-2 col-form-label">Fecha de Publicación</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" name="fecha_publicacion" id="inputFechaPublicacion">
            </div>
        </div>

        <div class="row mb-3">
            <label for="inputFechaCierre" class="col-sm-2 col-form-label">Fecha de Cierre</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" name="fecha_cierre" id="inputFechaCierre">
            </div>
        </div>

        <div class="row mb-3">
            <label for="inputRemuneracion" class="col-sm-2 col-form-label">Remuneración</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="remuneracion" id="inputRemuneracion">
            </div>
        </div>

        <div class="row mb-3">
            <label for="inputUbicacion" class="col-sm-2 col-form-label">Ubicación</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="ubicacion" id="inputUbicacion">
            </div>
        </div>

        <div class="row mb-3">
            <label for="inputTipo" class="col-sm-2 col-form-label">Tipo</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="tipo" id="inputTipo">
            </div>
        </div>

        <div class="row mb-3">
            <label for="inputLimitePostulantes" class="col-sm-2 col-form-label">Límite de Postulantes</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="limite_postulante" id="inputLimitePostulantes">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Oferta Laboral</button>
    </form>

    <!-- Fin  de la zona central del sistema -->
</div>
<!-- /.container-fluid -->

<?php
    include("../includes/foot.php");
?>
