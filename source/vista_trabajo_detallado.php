<?php
    include("../includes/head.php");
    ?>
    <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofertas Laborales</title>
    <!-- Agrega aquí tus enlaces a CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center; /* Centra el contenido */
        }
        .boton {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff6347; /* Color de fondo rojo */
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            position: relative; /* Permite posicionar la flecha de manera relativa */
        }
        .boton:hover {
            background-color: #ff473d; /* Cambia el color de fondo al pasar el mouse */
        }
        
    </style>
</head>
<body>
    <div class="container">
        <h1>Ofertas Laborales Disponibles</h1>
        <?php
        // Incluir el archivo que contiene la función conectar()
        include("../includes/conectar.php");

        // Conectar a la base de datos
        $conexion = conectar();

        // Verificar si se ha proporcionado un ID de oferta
        if (isset($_GET['id_oferta'])) {
            // Obtener el ID de la oferta desde la URL
            $id_oferta = $_GET['id_oferta'];

            // Consulta SQL para obtener la oferta laboral con el ID proporcionado
            $sql = "SELECT * FROM oferta_laboral WHERE id = $id_oferta";

            // Ejecutar la consulta
            $resultado = mysqli_query($conexion, $sql);

            // Verificar si hay resultados
            if ($resultado && mysqli_num_rows($resultado) > 0) {
                // Obtener la fila de resultados
                $fila = mysqli_fetch_assoc($resultado);

                // Mostrar la oferta laboral
                echo "<div class='oferta'>";
                echo "<h2>" . $fila['titulo'] . "</h2>";
                $idEmpresa = $fila['id_empresa'];
                if (!empty($idEmpresa)) {
                    $sqlEmpresa = "SELECT razon_social FROM empresas WHERE id = $idEmpresa";
                    $resultadoEmpresa = mysqli_query($conexion, $sqlEmpresa);
                
                    // Verificar si se ejecutó la consulta correctamente
                    if ($resultadoEmpresa) {
                        $filaEmpresa = mysqli_fetch_assoc($resultadoEmpresa);
                        $nombreEmpresa = $filaEmpresa['razon_social'];
                        echo "<p>Empresa: " . $nombreEmpresa . "</p>"; // Corrección aquí
                    } else {
                        // Manejar el caso de error en la consulta SQL
                        echo "Error al ejecutar la consulta SQL: " . mysqli_error($conexion);
                    }
                } else {
                    // Manejar el caso de $idEmpresa vacío
                    echo "<p>Empresa no encontrada</p>"; // Cambiado de <td> a <p> para mantener la estructura HTML
                }
                echo "<p>Descripción: " . $fila['descripcion'] . "</p>";
                echo "<p>Fecha de Publicación: " . $fila['fecha_publicacion'] . "</p>";
                echo "<p>Fecha de Cierre: " . $fila['fecha_cierre'] . "</p>";
                echo "<p>Remuneración: $" . $fila['remuneracion'] . "</p>";
                echo "<p>Ubicación: " . $fila['ubicacion'] . "</p>";
                echo "<p>Tipo: " . $fila['tipo'] . "</p>";
                echo "<p>Límite de Postulantes: " . $fila['limite_postulante'] . "</p>";
                echo "</div>";
                
            } else {
                // Si no hay resultados, mostrar un mensaje
                echo "<p>No se encontró la oferta laboral.</p>";
            }
        } else {
            // Si no se proporcionó un ID de oferta, mostrar un mensaje de error
            echo "<p>No se proporcionó un ID de oferta.</p>";
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);
        ?>
        <div>
            <a href="javascript:history.back()" class="boton">Retroceder</a>
            <a href="procesar_seleccion.php?id_oferta=<?php echo $id_oferta; ?>" class="boton">Postular</a>
        </div>
    </div>
</body>
</html>
<?php
    include("../includes/foot.php");
?>