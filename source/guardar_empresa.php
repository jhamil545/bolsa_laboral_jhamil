<?php

	include("../includes/conectar.php");

	$conexion = conectar();
	
	//Recibimos los datos del formulario	
	$razon_social = $_POST['txt_razon_social'];
	$ruc = $_POST['txt_ruc'];
	$direccion = $_POST['txt_direccion'];
	$telefono  = $_POST['txt_telefono'];
	$correo = $_POST['txt_correo'];
	$id_rol = $_POST['txt_id_rol'];

	/*
	echo "Razón Social Recibida: ".$razon_social;
	echo "RUC Recibido: ".$ruc;
	echo "Dirección Recibida: ".$direccion;
	echo "Teléfono Recibido: ".$telefono;
	echo "Correo Recibido: ".$correo;
	echo "ID de Rol Recibido: ".$id_rol;
	*/

	//Guardamos los datos en la tabla 'empresas'

	$sql="INSERT INTO empresas(razon_social,ruc,direccion,telefono,correo,id_rol) 
	      VALUES('$razon_social','$ruc','$direccion','$telefono','$correo','$id_rol') ";

	mysqli_query($conexion,$sql) or die("Error al guardar.");

	header("Location:listar_empresa.php");

?>
