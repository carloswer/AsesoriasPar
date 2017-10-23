<?php

    require_once "../../../config.php";
    use Control\Sesiones;
    use Control\Funciones;
    use Control\ControlHorarios;
    use Control\ControlEstudiantes;

    if( !isset( $_POST['type'] ) || !isset($_POST['value']) || !isset($_POST['student']) ){
        echo Funciones::makeJsonResponse(
            "asosorias_dates",
            false,
            "No se enviaron los valores esperados"
        );
        exit;
    }


    $type = $_POST['type'];
    $student = $_POST['student'];
    $value = $_POST['value'];

    //--------OBTENER HORARIOS DISPONIBLES
    if( $type === 'schedule' ){

        $conSchedule = new ControlHorarios();
        $subjectId = $value;
        $scheduleHoursResult = $conSchedule->getCurrAvailSchedules_SkipStudent( $subjectId, $student );

        //Respuesta en caso de error
        if( $scheduleHoursResult === 'error' ){
            echo Funciones::makeJsonResponse(
                "asesoria_schedule",
                'error',
                "No se pudieron obtener los horarios de los asesores"
            );
        }
        //Respuesta en caso que no se encuentren fechas disponibles
        else if( $scheduleHoursResult == null ){
            echo Funciones::makeJsonResponse(
                "asesoria_schedule",
                false,
                "No se encontrarón horarios disponibles para dicha materia"
            );
        }
        //Respuesta en caso de se encuentren fechas disponibles
        //Retorna el valor junto con el json
        else{
            //Se obtienen las horas existentes
            $hoursArray = $conSchedule->getHoursAndDays_OrderByHour();
            //Se crear tabla y se regresa en String
            $table = Funciones::makeScheduleTable($hoursArray, $scheduleHoursResult);

            echo Funciones::makeJsonResponse(
                "asesoria_schedule",
                true,
                "Horarios disponibles para solicitar",
                $table
            );
        }
    }
    else{
        echo Funciones::makeJsonResponse(
            "asesoria_schedule",
            false,
            "No sé reconoce el tipo solicitado"
        );
    }





?>