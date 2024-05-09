<?php
    include("../includes/head.php");
    
    // Incluir el archivo que contiene la función conectar()
    include("../includes/conectar.php");
    
    // Función para escapar y validar datos de entrada
    function validar_dato($conexion, $dato) {
        // Escapar el dato para prevenir inyección SQL
        $dato = mysqli_real_escape_string($conexion, $dato);
        // Validar el dato según tus necesidades
        // Por ejemplo, podrías verificar si es un entero válido
        // Si el dato no cumple con los criterios de validación, podrías mostrar un mensaje de error o tomar otra acción
        return $dato;
    }
    
    // Conectar a la base de datos
    $conexion = conectar();
    
    // Verificar si se ha proporcionado un ID de oferta
    if (isset($_GET['id_oferta'])) {
        // Obtener y validar el ID de la oferta desde la URL
        $id_oferta = validar_dato($conexion, $_GET['id_oferta']);
    
        // Consulta SQL para obtener los detalles del trabajo seleccionado
        $sql = "SELECT titulo, id FROM oferta_laboral WHERE id = $id_oferta";
    
        // Ejecutar la consulta
        $resultado = mysqli_query($conexion, $sql);
    
        // Verificar si la consulta fue exitosa
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            // Obtener los datos de la oferta laboral
            $oferta = mysqli_fetch_assoc($resultado);
    // Asignar el ID de la oferta a una variable
    $id_oferta = $oferta['id'];
            // Imprimir los detalles de la oferta
            echo "<h1>" . $oferta['titulo'] . "</h1>";
            echo "<p>" . $id_oferta . "</p>";
        } else {
            // Si la consulta no fue exitosa, mostrar un mensaje de error
            echo "Error: No se encontró la oferta laboral.";
        }
    } else {
        // Si no se proporcionó un ID de oferta, mostrar un mensaje de error
        echo "<h1>Error</h1>";
        echo "<p>No se proporcionó un ID de oferta.</p>";
    }
    
    // Verificar si existe una sesión activa
    if(isset($_SESSION['SESION_NOMBRES'])) {
        // Obtener y validar el nombre de usuario logueado
        $nombre_usuario = validar_dato($conexion, $_SESSION['SESION_NOMBRES']);
    
        // Consulta SQL para obtener el ID del usuario
        $sql_usuario = "SELECT id FROM usuarios WHERE nombres = '$nombre_usuario'";
    
        // Ejecutar la consulta
        $resultado_usuario = mysqli_query($conexion, $sql_usuario);
    
        // Verificar si se encontraron resultados
        if ($resultado_usuario && mysqli_num_rows($resultado_usuario) > 0) {
            // Obtener el primer resultado (asumiendo que solo hay uno)
            $fila_usuario = mysqli_fetch_assoc($resultado_usuario);
            $id_usuario = $fila_usuario['id'];
    
            // Imprimir el ID del usuario
            echo "El ID del usuario es: " . $id_usuario;
            
        } else {
            // Si no se encontraron resultados
            echo "Error: No se encontró ningún usuario con ese nombre.";
        }
    } else {
        // Si no existe una sesión activa, mostrar un mensaje de error
        echo "Error: No hay una sesión activa.";
    }
    
    // Verificar si se han proporcionado un ID de usuario y un ID de oferta válidos
if (isset($id_oferta, $id_usuario)) {

  // Obtener y validar los datos del formulario
  $id_usuario = validar_dato($conexion, $id_usuario);
  $id_oferta = validar_dato($conexion, $id_oferta);

  // Definir el estado inicial y la fecha/hora actual para la postulación
  $estado_inicial = 'abierto'; // Por ejemplo, se asume que la postulación comienza como "abierto"
  $fecha_hora_postulante = date('Y-m-d H:i:s'); // Obtener la fecha/hora actual

  // Preparar la consulta SQL para insertar la postulación
  $sql = "INSERT INTO postulaciones (id_usuario, id_oferta, fecha_hora_postulante, estado_actual) VALUES ('$id_usuario', '$id_oferta', '$fecha_hora_postulante', '$estado_inicial')";

  // Ejecutar la consulta
  if (mysqli_query($conexion, $sql)) {
      echo "La postulación se ha registrado correctamente.";
  } else {
      echo "Error al registrar la postulación: " . mysqli_error($conexion);
  }
} else {
  // Si no se proporcionaron los datos necesarios, mostrar un mensaje de error
  echo "Error: No se proporcionaron todos los datos necesarios.";
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);

    ?>
    