<?php 

	require_once 'config.php';
    use Control\Sesiones;

    Sesiones::destroySession();
	header("Location: login.php");

 ?>