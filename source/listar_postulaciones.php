<?php
    include("../includes/head.php");

    include("../includes/conectar.php");
    $conexion=conectar();
?>
<!-- Begin Page Content -->
<div class="container-fluid">    
    <h1>Lista de Postulaciones</h1>

    <?php
        $sql = "SELECT * FROM postulaciones 
        INNER JOIN usuarios ON postulaciones.id_usuario = usuarios.id";

        $registros=mysqli_query($conexion,$sql);

        echo "<table class='table table-success table-hover'>";
        
        echo "<th>usuario</th>";
        echo "<th>oferta</th>";
        echo "<th>fecha</th>";
        echo "<th>estado</th>";
        echo "<th>CV</th>";
        echo "<th>seleccionado</th>";
        

        while($fila = mysqli_fetch_array($registros)){
            echo "<tr>";
                echo "<td>".$fila['nombres']."-".$fila['apellidos']."</td>";
                echo "<td>".$fila['id_oferta']."</td>";
                echo "<td>".$fila['fecha_hora_postulante']."</td>";
                echo "<td>".$fila['estado_actual']."</td>";
                // Verificar si existe una ruta de archivo en la fila actual
                if (!empty($fila['ruta_cv'])) {
                    // Si hay una ruta de archivo, mostrar el botón "Ver PDF"
                    echo '<td><button onclick="verPDF(\''. $fila['ruta_cv'] .'\')" class="btn btn-success">Ver PDF</button></td>';
                } else {
                    // Si no hay una ruta de archivo, mostrar un mensaje de texto o dejar la celda vacía
                    echo '<td>No hay archivo adjunto</td>';
                }
                                echo "<td>".$fila['usuario_seleccionado']."</td>";
                                

                                // Botones para editar y eliminar una empresa
                                echo "<td>";
                    ?>
                    <button type="button" class="btn btn-primary" onClick="f_editar('<?php echo $fila['id']; ?>');">Editar</button>
                    <button type="button" class="btn btn-danger" onClick="f_eliminar('<?php echo $fila['id']; ?>');">Eliminar</button>
                    
                    <?php
                echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    ?>    
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
    function verPDF(rutaPDF) {
    var ventanaPDF = window.open('', '_blank');
    ventanaPDF.document.write('<embed src="' + rutaPDF + '" type="application/pdf" width="100%" height="600px" />');
}
  
    function f_editar(pid){
        // Redireccionamos hacia el archivo 'modificar_empresa.php'
        location.href="modificar_postulaciones.php?pid="+pid;
    }

    function f_eliminar(pid){
        if(confirm("¿Estás seguro de que deseas eliminar esta empresa?")){
            // Redireccionamos hacia el archivo PHP que procesa la eliminación
            location.href="eliminar_empresa.php?pid="+pid;
        }
    }
</script>
