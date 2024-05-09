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

<form method="POST" action="actualizar_usuario.php" enctype="multipart/form-data">

    
      <input type="hidden" name="txt_id_usuario" value="<?php echo $pid; ?>">


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

          <!-- Contenedor para mostrar el nombre o la ruta del archivo -->
    <div id="nombreArchivoActual" style="margin-top: 10px;">
        <?php
        // Mostrar el nombre o la ruta del archivo actual si existe
        if (!empty($fila['ruta_cv'])) {
          //echo '<embed src="' . $fila['ruta_cv'] . '" type="application/pdf" width="100%" height="400px">';
          echo 'Archivo actual: ' ;
      } else {
          echo 'Ningún archivo seleccionado';
      }
      
        ?>
    </div>

    <!-- Contenedor para mostrar la vista previa del archivo PDF -->
    <div id="vistaPreviaCV" style="margin-top: 10px;">
        <?php
        // Mostrar la vista previa del PDF actual si existe
        if (!empty($fila['ruta_cv'])) {
            echo '<embed src="' . $fila['ruta_cv'] . '" type="application/pdf" width="100%" height="400px">';
        }
        ?>
    </div>

    <!-- Input para seleccionar el archivo -->
    <input type="file" class="form-control" id="inputCV" name="txt_ruta_cv" onchange="mostrarVistaPrevia(this)">

    <!-- Botón para eliminar el archivo actual -->
    <button type="button" class="btn btn-danger" onclick="eliminarArchivo()">Eliminar Archivo</button>
    <button onclick="window.location.href = 'listar_usuarios.php';" class="btn btn-secondary">Cancelar</button>
        








    <button type="submit" class="btn btn-success">Actualizar Usuario</button>
  </form>


    

    <!-- Fin  de la zona central del sistema -->
</div>
<!-- /.container-fluid --> 


<script>
    
    // Función para mostrar la vista previa del archivo seleccionado
function mostrarVistaPrevia(input) {
    // Verificar si se seleccionó un archivo
    if (input.files && input.files[0]) {
        var archivo = input.files[0];
        var lector = new FileReader();

        lector.onload = function(e) {
            // Crear un elemento de incrustación para mostrar la vista previa del PDF
            var vistaPrevia = document.createElement("embed");
            vistaPrevia.setAttribute("src", e.target.result);
            vistaPrevia.setAttribute("type", "application/pdf"); // Establecer el tipo de archivo PDF
            vistaPrevia.setAttribute("width", "100%"); // Establecer el ancho de la vista previa
            vistaPrevia.setAttribute("height", "400px"); // Establecer el alto de la vista previa (ajústalo según sea necesario)
            // Agregar la vista previa al contenedor
            document.getElementById("vistaPreviaCV").innerHTML = ""; // Limpiar el contenedor antes de agregar la vista previa
            document.getElementById("vistaPreviaCV").appendChild(vistaPrevia);

            // Actualizar el nombre del archivo mostrado
            document.getElementById("nombreArchivoActual").innerText = "Archivo seleccionado: " + archivo.name;
        }

        // Leer el archivo como una URL de datos
        lector.readAsDataURL(archivo);
    } else {
        // Si no se seleccionó ningún archivo, pero hay un PDF actual almacenado, mostrar su nombre o ruta
        var rutaPDFActual = "<?php echo $fila['ruta_cv']; ?>";
        if (rutaPDFActual) {
            // Actualizar el nombre del archivo mostrado
            document.getElementById("nombreArchivoActual").innerText = "Archivo actual: " + rutaPDFActual;
        } else {
            // Mostrar un mensaje indicando que no se ha seleccionado ningún archivo
            document.getElementById("nombreArchivoActual").innerText = "Ningún archivo seleccionado";
        }

        // Limpiar la vista previa del archivo
        document.getElementById("vistaPreviaCV").innerHTML = "";
    }
}

// Función para eliminar el archivo actual
function eliminarArchivo() {
    // Limpiar el input de archivo
    document.getElementById("inputCV").value = "";

    // Limpiar la vista previa del archivo
    document.getElementById("vistaPreviaCV").innerHTML = "";

    // Actualizar el nombre del archivo mostrado
    document.getElementById("nombreArchivoActual").innerText = "Ningún archivo seleccionado";
}


</script>


<?php
    include("../includes/foot.php");
?>