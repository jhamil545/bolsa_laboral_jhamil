<?php
class Usuario {
    private $conex;

    public function __construct($conex) {
        $this->conex = $conex;
    }

    public function guardarUsuario($datosUsuario) {
        $campos = implode(', ', array_keys($datosUsuario));
        $valores = array_fill(0, count($datosUsuario), '?');
		
        $placeholders = implode(', ', $valores);

        $sql = "INSERT INTO usuarios ($campos) VALUES ($placeholders)";
		
				



        $stmt = $this->conex->prepare($sql);
        
        // Obtener los valores de los datos del usuario
        $valores = array_values($datosUsuario);
		
		/*
		echo '<pre>';
		echo var_dump($datosUsuario);
		echo '</pre>';
		echo '<pre>';
		echo var_dump($valores);
		echo '</pre>';
		*/
		
		
		
        
        // Enlazar los parámetros
        $tipos = str_repeat('s', count($valores)); // Todos los valores son cadenas (strings)
		echo '<br /> Valor de tipos: '.$tipos;
		
		//die();

        $stmt->bind_param($tipos, ...$valores);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}?>