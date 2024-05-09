<?php
    include"../includes/head.php";

    // Incluir el archivo que contiene la función conectar()
    include"../includes/conectar.php";

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
    <h1>Registro de Postulación</h1>

    <form method="POST" action="guardar_postulacion.php">
        <!-- Campo para mostrar el ID del usuario -->
        <div class="row mb-3">
            <label for="inputUsuario" class="col-sm-2 col-form-label">Usuario</label>
            <div class="col-sm-10">
                <!-- Mostrar el ID del usuario -->
                <input type="number" class="form-control" id="inputUsuario" name="id_usuario" value="<?php echo isset($id_usuario) ? $id_usuario : ''; ?>" readonly>
            </div>
        </div>

        <!-- Campo para ingresar el ID de la oferta -->
        <div class="row mb-3">
            <label for="inputOferta" class="col-sm-2 col-form-label">Oferta</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="inputOferta" name="id_oferta">
            </div>
        </div>

        <!-- Campo para seleccionar el estado actual -->
        <div class="row mb-3">
            <label for="inputEstado" class="col-sm-2 col-form-label">Estado Actual</label>
            <div class="col-sm-10">
                <select class="form-select" name="estado_actual" id="inputEstado">
                    <option value="abierto">Abierto</option>
                    <option value="cerrado">Cerrado</option>
                </select>
            </div>
        </div>

        <!-- Campo para seleccionar si el usuario fue seleccionado -->
        <div class="row mb-3">
            <label for="inputSeleccionado" class="col-sm-2 col-form-label">Usuario Seleccionado</label>
            <div class="col-sm-10">
                <select class="form-select" name="usuario_seleccionado" id="inputSeleccionado">
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Postulación</button>
    </form>

    <!-- Fin  de la zona central del sistema -->
</div>
<!-- /.container-fluid -->

<?php
    include"../includes/foot.php";
?>
