

<?php
    include("../includes/head.php");

    include("../includes/conectar.php");
    $conexion=conectar();
?>
<!-- Begin Page Content -->
<div class="container-fluid">    
    

    <div class="container-fluid">
    <h1>Lista de Usuarios</h1>
    

    <?php
// Establecer conexión a la base de datos (suponiendo que ya tienes esta parte)

// Consulta SQL original
$sql = "SELECT * FROM usuarios";

// Verificar si se envió un filtro
if(isset($_GET['filtro_id_rol'])) {
    $filtro_id_rol = $_GET['filtro_id_rol'];
    if($filtro_id_rol != 'todos') {
        // Si se selecciona un rol específico, agregar el filtro a la consulta SQL
        $sql .= " WHERE id_rol = $filtro_id_rol";
    }
}

// Ejecutar la consulta SQL
$resultado = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Filtrar usuarios por id_rol</title>
    <!-- Agregamos los estilos de la tabla -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<form method="GET" action="">
    <label for="filtro_id_rol">Filtrado:</label>
    <select name="filtro_id_rol" id="filtro_id_rol">
        <option value="todos" <?php if(isset($_GET['filtro_id_rol']) && $_GET['filtro_id_rol'] == 'todos') echo 'selected'; ?>>Todos</option>
        <option value="1" <?php if(isset($_GET['filtro_id_rol']) && $_GET['filtro_id_rol'] == '1') echo 'selected'; ?>>Superadmin</option>
        <option value="2" <?php if(isset($_GET['filtro_id_rol']) && $_GET['filtro_id_rol'] == '2') echo 'selected'; ?>>Admin</option>
        <option value="3" <?php if(isset($_GET['filtro_id_rol']) && $_GET['filtro_id_rol'] == '3') echo 'selected'; ?>>Postulante</option>
    </select>
    <button type="submit">Filtrar</button>
</form>


<!-- Agregamos el diseño de la tabla -->
<table class="table table-success table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>DNI</th>
            <th>Telefono</th>
            <th>Rol</th>
            <th>Cv</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php
// Estilos CSS en línea para cada clase
$styles = [
    'superadmin' => 'background-color: #c8e6c9;', // verde
    'admin' => 'background-color: #ffecb3;', // amarillo
    'postulante' => 'background-color: #ffccbc;', // naranja
    'otro' => 'background-color: #f5f5f5;' // gris
];

// Mientras se recorre cada fila de resultados
while($fila = mysqli_fetch_assoc($resultado)) {
    // Obtenemos la clase CSS correspondiente al rol del usuario
    $clase_css = obtenerClasePorRol($fila['id_rol']);
    // Iniciamos la fila con la clase CSS correspondiente
    echo '<tr style="'.$styles[$clase_css].'">';
    // Mostramos los datos del usuario
    echo '<td>'.$fila['nombres'].'</td>';
    echo '<td>'.$fila['apellidos'].'</td>';
    echo '<td>'.$fila['dni'].'</td>';
    echo '<td>'.$fila['telefono'].'</td>';
    echo '<td>'.obtenerTextoPorRol($fila['id_rol']).'</td>';
    // Verificar si existe una ruta de archivo en la fila actual
if (!empty($fila['ruta_cv'])) {
    // Si hay una ruta de archivo, mostrar el botón "Ver PDF"
    echo '<td><button onclick="verPDF(\''. $fila['ruta_cv'] .'\')" class="btn btn-success">Ver PDF</button></td>';
} else {
    // Si no hay una ruta de archivo, mostrar un mensaje de texto o dejar la celda vacía
    echo '<td>No hay archivo adjunto</td>';
}

    // Botones para editar y eliminar el usuario
    echo '<td>';
    echo '<button type="button" class="btn btn-primary" onClick="f_editar('.$fila['id'].');">Editar</button>';
    echo '<button type="button" class="btn btn-danger" onClick="f_eliminar('.$fila['id'].');">Eliminar</button>';
    echo '<button type="button" class="btn btn-success" onClick="f_asignar(' . $fila['id'] . ')" data-toggle="modal" data-target="#editarIdRolModal">Asignar rol</button>';
    echo '</td>';

    // Cerramos la fila
    echo '</tr>';
}

// Funciones para obtener la clase y el texto del rol
function obtenerClasePorRol($id_rol) {
    switch ($id_rol) {
        case 1:
            return "superadmin";
        case 2:
            return "admin";
        case 3:
            return "postulante";
        default:
            return "otro";
    }
}

function obtenerTextoPorRol($id_rol) {
    switch ($id_rol) {
        case 1:
            return '<span class="badge badge-primary">Superadmin</span>';
        case 2:
            return '<span class="badge badge-warning">Admin</span>';
        case 3:
            return '<span class="badge badge-success">Postulante</span>';
        default:
            return '<span class="badge badge-secondary">Otro</span>';
    }
}
?>


    </tbody>
</table>

</body>
</html>

    
</div>

    
</div>
<!-- /.container-fluid --> 



<?php
    include("../includes/foot.php");
?>


<!-- Modal para editar id_rol -->
<div class="modal fade" id="editarIdRolModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar id_rol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para editar id_rol -->
                <form id="editarIdRolForm" method="post" action="guardar_id_rol.php">
                    <!-- Campo oculto para almacenar el pid -->
                    <input type="hidden" id="pidInput" name="pid" value="">
                    <!-- Campo de selección para el nuevo id_rol -->
                    <div class="mb-3">
                        <label for="nuevoIdRolSelect" class="form-label">Seleccionar nuevo id_rol:</label>
                        <select class="form-select" id="nuevoIdRolSelect" name="nuevo_id_rol">
                            <option value="1">Superadmin</option>
                            <option value="2">Admin</option>
                            <option value="3">Postulante</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="guardarCambios()">Guardar cambios</button>
                <!-- Este botón enviará el formulario -->
            </div>
        </div>
    </div>
</div>

<script>

function verPDF(rutaPDF) {
    var ventanaPDF = window.open('', '_blank');
    ventanaPDF.document.write('<embed src="' + rutaPDF + '" type="application/pdf" width="100%" height="600px" />');
}


    function guardarCambios() {
    // Enviar el formulario
    document.getElementById("editarIdRolForm").submit();
}

// Agregar un evento de escucha para el evento 'submit' del formulario
document.getElementById("editarIdRolForm").addEventListener("submit", function(event) {
    // Detener el envío del formulario
    event.preventDefault();
    
    // Hacer una solicitud asíncrona para enviar el formulario
    var formData = new FormData(this);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "guardar_id_rol.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Redirigir después de enviar el formulario
            window.location.href = "guardar_id_rol.php";
        }
    };
    xhr.send(formData);
});

</script>






<script>

    function f_editar(pid){
        
        location.href="modificar_usuario.php?pid="+pid;

    }

    function f_eliminar(pid){
        
        location.href="eliminar_usuario.php?pid="+pid;

    }

    function f_asignar(pid) {
    // Asignar el ID al campo oculto del modal
    document.getElementById("pidInput").value = pid;
    // Mostrar el modal
    $('#editarIdRolModal').modal('show');
}

</script>    