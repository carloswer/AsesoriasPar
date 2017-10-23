<?php

    require_once '../config.php';
    $tituloPagina = "Inicio | Asesor";

    use Control\Sesiones;
    //Para evitar redireccion de sesion.php
    $isAcceso = true;
    include_once 'sesion.php';


	//---- Determinacion del tipo por GET
	if( isset( $_GET['tipo'] ) ){
		$tipo = $_GET['tipo'];
		if( $tipo == Sesiones::$ALUMNO || $tipo == Sesiones::$ASESOR ){
		    //Establece tipo de estudiante
			Sesiones::setStudentType($tipo);
			//Redirecciona
			header("Location: index.php");
		}
	}


?>

<?php include_once TEMPLATE_PATH."/header.php"; ?>

	<!--MENU-->
	<div class="container">
        <?php //include_once TEMP_PATH."/estudiante-menu.php"; ?>

		<h1>Seleccione una opción:</h1>
		<h4>Esta página se muestra ya que no ha decidido como acceder al sistema</h4>
		<a href="acceso.php?tipo=<?= Sesiones::$ALUMNO; ?>" type="button" class="btn btn-primary">Alumno</a>
		<a href="acceso.php?tipo=<?= Sesiones::$ASESOR; ?>" type="button" class="btn btn-success">Asesor</a>

		<a href="<?= ROOT_REF; ?>/logout.php" type="button" class="btn btn-default">Cerrar Session</a>
	</div>

<?php include_once TEMPLATE_PATH."/footer.php"; ?>

