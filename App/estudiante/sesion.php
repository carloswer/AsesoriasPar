<?php

    //require_once '../config.php';
	// SESIONES
	use Control\Sesiones;
    Sesiones::checkCurrentSession();

	//sesion activa
	if( Sesiones::isSessionON() ){
	    //Si es alumno
		if( Sesiones::isStudent() ){
		    //Si se encuentra en la página de acceso
            if( !isset($isAcceso) ){
                //Si no es ni alumno ni asesor
                if( !Sesiones::isTypeSelected() )
                    header("Location: ".EST_REF."/acceso.php");
            }
        }
		else
            header("Location: ".ADMIN_REF);
	}
	else
		header("Location: ".ROOT_REF."/login.php");

 ?>