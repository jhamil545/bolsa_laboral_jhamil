<?php
    include("../includes/head.php");

    include("../includes/conectar.php");
    $conexion=conectar();
?>
<!-- Begin Page Content -->
<div class="container-fluid">    
    <h1>Lista de Empresas</h1>

    <?php
        $sql="SELECT * FROM empresas";
        $registros=mysqli_query($conexion,$sql);

        echo "<table class='table table-success table-hover'>";
        
        echo "<th>Razón Social</th>";
        echo "<th>RUC</th>";
        echo "<th>Dirección</th>";
        echo "<th>Teléfono</th>";
        echo "<th>Correo</th>";
        echo "<th>ID de Rol</th>";
        echo "<th>ID de Usuario</th>";
        echo "<th>Acciones</th>";

        while($fila = mysqli_fetch_array($registros)){
            echo "<tr>";
                echo "<td>".$fila['razon_social']."</td>";
                echo "<td>".$fila['ruc']."</td>";                
                echo "<td>".$fila['direccion']."</td>";
                echo "<td>".$fila['telefono']."</td>";
                echo "<td>".$fila['correo']."</td>";
                echo "<td>".$fila['id_rol']."</td>";
                echo "<td>".$fila['id_usuario']."</td>";

                // Botones para editar y eliminar una empresa
                echo "<td>";
                    ?>
                    <button type="button" class="btn btn-primary" onClick="f_editar('<?php echo $fila['id']; ?>');">Editar</button>
                    <button type="button" class="btn btn-danger" onClick="f_eliminar('<?php echo $fila['id']; ?>');">Eliminar</button>
                    <button type="button" class="btn btn-success btnAsignarUsuario" data-toggle="modal" data-target="#modalAsignarUsuario" data-id="<?php echo $fila['id']; ?>">Asignar usuario</button>
                    <?php
                echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    ?>    
</div>

<!-- Agrega el modal -->
<div id="modalAsignarUsuario" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lista de usuarios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Contenido del modal -->
                <?php
                // Establece la conexión a la base de datos
                $conexion = conectar();

                // Query para seleccionar todos los usuarios de la tabla usuarios
                $sql = "SELECT * FROM usuarios";

                // Ejecuta la consulta
                $resultado = mysqli_query($conexion, $sql);

                // Verifica si hay resultados
                if (mysqli_num_rows($resultado) > 0) {
                    // Comienza la tabla
                    echo "<table class='table'>";
                    echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th></tr>";

                    // Itera sobre cada fila de resultados
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo "<tr class='filaUsuario' data-id='" . $fila['id'] . "'>";
                        echo "<td>" . $fila['id'] . "</td>";
                        echo "<td>" . $fila['nombres'] . "</td>";
                        echo "<td>" . $fila['apellidos'] . "</td>";
                        echo "</tr>";
                    }

                    // Cierra la tabla
                    echo "</table>";
                } else {
                    // Si no hay resultados, muestra un mensaje
                    echo "No se encontraron usuarios.";
                }

                // Cierra la conexión a la base de datos
                mysqli_close($conexion);
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>




<?php
    include("../includes/foot.php");
?>

<!-- Incluir Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Incluir Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>







<script src="<?php echo RUTAGENERAL; ?>templates/vendor/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Evento de clic para las filas de usuario
        $(".filaUsuario").click(function() {
            // Obtener el ID del usuario desde el atributo data
            var idUsuario = $(this).data('id');
            // Obtener el ID de la empresa desde el atributo data
            var idEmpresa = $("#modalAsignarUsuario").data('empresa-id');
            
            // Mostrar el ID del usuario y el número de ID de la empresa en un alert
            var confirmacion = confirm("ID del usuario seleccionado: " + idUsuario + 
                                        "\nNúmero de ID de empresa: " + idEmpresa + 
                                        "\n\n¿Deseas agregar el usuario N°"+idUsuario+" a la empresa N° "+idEmpresa+"?");
            if (confirmacion) {
                // Actualizar el campo id_usuario en la tabla empresas
                $.ajax({
                    url: 'actualizar_empresa_usuario.php',
                    type: 'POST',
                    data: { idEmpresa: idEmpresa, idUsuario: idUsuario },
                    success: function(response) {
                        alert(response); // Mensaje de éxito o error
                        // Opcional: recargar la página para reflejar los cambios
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });

    $(document).ready(function() {
        // Cuando se hace clic en el botón "Asignar usuario"
        $(".btnAsignarUsuario").click(function() {
            // Obtener el ID de la empresa desde el atributo data
            var idEmpresa = $(this).data('id');
            // Asignar el ID de la empresa al modal
            $("#modalAsignarUsuario").data('empresa-id', idEmpresa);
            // Mostrar el modal de asignación de usuario
            $("#modalAsignarUsuario").modal("show");
        });
    });

    function f_editar(pid){
        // Redireccionamos hacia el archivo 'modificar_empresa.php'
        location.href="modificar_empresa.php?pid="+pid;
    }

    function f_eliminar(pid){
        if(confirm("¿Estás seguro de que deseas eliminar esta empresa?")){
            // Redireccionamos hacia el archivo PHP que procesa la eliminación
            location.href="eliminar_empresa.php?pid="+pid;
        }
    }
</script>
