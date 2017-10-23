<?php

    require_once '../../../config.php';

    use Control\ControlHorarios;
    use Control\Funciones;

	//TODO: que no pueda registrar si ya tiene uno
	if ( !isset($_POST['json_schedule']) )
		header("Location: ".EST_PATH."/horrario");


	//Recibe JSON y decodifica
	$json = $_POST['json_schedule'];
	$datos = json_decode($json);

	//Elementos
	$idStudent = $datos->student;
	$hours	= $datos->schedule;
	$subjects 	= $datos->subjects;


	//----Verificacion de datos
    if( empty($idStudent) || empty($hours) || empty($subjects) ) {
        echo Funciones::makeJsonResponse(
            "schedule-register",
            "null",
            "Hay valores vacios",
            $json
        );
    }

	//------------------INSERT DE HORARIO
    $conHorarios = new ControlHorarios();
    $result = $conHorarios->insertStudentSchedule( $idStudent, $hours, $subjects );

    //Si ocurre algun error en el registro
    if( $result['result'] === 'error' ){
        echo Funciones::makeJsonResponse(
            "schedule_register",
            'error',
            $result['message']
        );
    }
    else if( $result['result'] === false ){
        echo Funciones::makeJsonResponse(
            "schedule_register",
            false,
            $result['message']
        );
    }
    else{
        echo Funciones::makeJsonResponse(
            "schedule_register",
            true,
            $result['message']
        );
    }


 ?>