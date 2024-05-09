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
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .oferta {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .oferta h2 {
            margin-top: 0;
        }
        .oferta p {
            margin-bottom: 10px;
        }
        .oferta a {
            display: inline-block;
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .oferta a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ofertas Laborales Disponibles</h1>
        <?php
        // Incluir el archivo que contiene la función conectar()
        include("includes/conectar.php");

        // Conectar a la base de datos
        $conexion = conectar();

        // Consulta SQL para obtener las ofertas laborales
        $sql = "SELECT * FROM oferta_laboral";

        // Ejecutar la consulta
        $resultado = mysqli_query($conexion, $sql);

        // Verificar si hay resultados
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            // Iterar sobre las filas de resultados
            while ($fila = mysqli_fetch_assoc($resultado)) {
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
               // echo "<p>Descripción: " . $fila['descripcion'] . "</p>";
                echo "<p>Fecha de Publicación: " . $fila['fecha_publicacion'] . "</p>";
               // echo "<p>Fecha de Cierre: " . $fila['fecha_cierre'] . "</p>";
                echo "<p>Remuneración: $" . $fila['remuneracion'] . "</p>";
                echo "<p>Ubicación: " . $fila['ubicacion'] . "</p>";
                echo "<p>Tipo: " . $fila['tipo'] . "</p>";
                //echo "<p>Límite de Postulantes: " . $fila['limite_postulante'] . "</p>";
                echo "<a href='source/vista_trabajo_detallado.php?id_oferta=" . $fila['id'] . "'>Ver Detalles</a>";

                echo "</div>";
            }
        } else {
            // Si no hay resultados, mostrar un mensaje
            echo "<p>No se encontraron ofertas laborales.</p>";
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);
        ?>
    </div>
</body>
</html>
