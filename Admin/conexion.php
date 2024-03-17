<?php 
	
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$db = 'ds_travel';

	$conexion = @mysqli_connect($host,$user,$password,$db);

	if(!$conexion){
		echo "Error en la conexión";
	}

?>