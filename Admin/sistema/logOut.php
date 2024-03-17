<?php 
	
	session_start();
	if(!isset($_SESSION['idUser'])){
		header('location:index.php');
	}
	
	unset($_SESSION['idUser']);
	unset($_SESSION['nombre']);
	unset($_SESSION['apellido']);
	unset($_SESSION['correo']);
	unset($_SESSION['password']);
	unset($_SESSION['fk_rol']);
	
	
	session_destroy();
	
	header('location: https://localhost/proyectos/ds_travel/index.php');

 ?>