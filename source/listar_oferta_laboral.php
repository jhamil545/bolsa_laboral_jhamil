<?php
    include("../includes/head.php");

    include("../includes/conectar.php");
    $conexion = conectar();
?>
<!-- Begin Page Content -->
<div class="container-fluid">    
    <h1>Lista de Ofertas Laborales</h1>

    <?php
        $sql = "SELECT * FROM oferta_laboral"; // Corregir nombre de la tabla si es necesario
        $registros = mysqli_query($conexion, $sql);

        echo "<table class='table table-success table-hover'>";
        
        echo "<th>Título</th>";
        echo "<th>Empresa</th>";
        echo "<th>Descripción</th>"; // Asegúrate de que el nombre de la columna sea correcto
        echo "<th>Fecha de Publicación</th>";
        echo "<th>Fecha de Cierre</th>";
        echo "<th>Remuneración</th>";
        echo "<th>Ubicación</th>";
        echo "<th>Tipo</th>";
        echo "<th>Límite de Postulantes</th>";
        echo "<th>Acciones</th>";

        while($fila = mysqli_fetch_array($registros)){
            echo "<tr>";
                echo "<td>".$fila['titulo']."</td>";
                

                $idEmpresa = $fila['id_empresa'];
                if (!empty($idEmpresa)) {
                    $sqlEmpresa = "SELECT razon_social FROM empresas WHERE id = $idEmpresa";
                    $resultadoEmpresa = mysqli_query($conexion, $sqlEmpresa);

                    // Verificar si se ejecutó la consulta correctamente
                    if ($resultadoEmpresa) {
                        $filaEmpresa = mysqli_fetch_assoc($resultadoEmpresa);
                        $nombreEmpresa = $filaEmpresa['razon_social'];
                        echo "<td>".$nombreEmpresa."</td>";
                    } else {
                        // Manejar el caso de error en la consulta SQL
                        echo "Error al ejecutar la consulta SQL: " . mysqli_error($conexion);
                    }
                } else {
                    // Manejar el caso de $idEmpresa vacío
                    echo "<td>Empresa no encontrada</td>";
                }

                
            
                echo "<td>".$fila['descripcion']."</td>"; // Asegúrate de que el nombre de la columna sea correcto
                echo "<td>".$fila['fecha_publicacion']."</td>";
                echo "<td>".$fila['fecha_cierre']."</td>";
                echo "<td>".$fila['remuneracion']."</td>";
                echo "<td>".$fila['ubicacion']."</td>";
                echo "<td>".$fila['tipo']."</td>";
                echo "<td>".$fila['limite_postulante']."</td>"; // Asegúrate de que el nombre de la columna sea correcto
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
<script>
    

    

    function f_editar(pid){
        // Redireccionamos hacia el archivo 'modificar_empresa.php'
        location.href="modificar_oferta.php?pid="+pid;
    }

    function f_eliminar(pid){
        if(confirm("¿Estás seguro de que deseas eliminar esta oferta?")){
            // Redireccionamos hacia el archivo PHP que procesa la eliminación
            location.href="eliminar_oferta.php?pid="+pid;
        }
    }
</script>