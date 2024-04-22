<?php
    include_once ("config.php");

    function conectar(){
        $link = new mysqli(HOST, USUARIO,PASSWORD, NOMBREBD);
        if ($link  -> connect_errno) {
            die( "Error en la conexión a la Base de Datos.");
        }else{
            
            mysqli_query($link,"SET NAMES 'utf8'"); //para español
            mysqli_set_charset($link, "utf8"); //para español
            date_default_timezone_set("America/Lima"); //para la zona horaria		            

            return $link;
        }
    }

?>