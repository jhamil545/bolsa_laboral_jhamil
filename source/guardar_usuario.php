<?php

	include("../includes/conectar.php");

	$conexion = conectar();
	
	//Recibimos los datos del formulario	
	$dni     = $_POST['txt_dni'];
	$nombres = $_POST['txt_nombres'];
	$apellidos = $_POST['txt_apellidos'];
	$telefono  = $_POST['txt_telefono'];

	/*
	echo "DNI Recibido: ".$dni;
	echo "nombres Recibido: ".$nombres;
	echo "apellidos Recibidos: ".$apellidos;
	echo "telefono Recibido: ".$telefono;
	*/

	//Guardamos los datos en la tabla 'usuarios'

	$sql="INSERT INTO usuarios(dni,nombres,apellidos,telefono,id_rol) 
	      VALUES('$dni','$nombres','$apellidos','$telefono','3') ";

	mysqli_query($conexion,$sql) or die("Error al guardar.");

	header("Location:listar_usuarios.php")

?>