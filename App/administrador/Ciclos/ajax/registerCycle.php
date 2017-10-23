
<?php

    require_once '../../../config.php';

    use Control\ControlCiclos;
    use Control\Funciones;
    use Objetos\Ciclo;

        if( !isset($_POST['cycle_register']) ){
            Funciones::makeJsonResponse(
                "registerCycle",
                'error',
                "No se envío la información esperada"
            );
            exit;
        }
        $conCycles = new ControlCiclos();

        //JSON to JSON PHP Object
        $json = $_POST['cycle_register'];
        $registerCycleJSON= json_decode($json);

        //Crear ciclo
        $cycleObj = new Ciclo();
        $cycleObj->setStart($registerCycleJSON->start);
        $cycleObj->setEnd($registerCycleJSON->end);

        //Inserción un nuevo
        // REGRESA UN ARRAY [RESULT,MESSAGE]
        $result = $conCycles->insertCycles($cycleObj);

        //--------Ocurrio un error
        if( $result['result'] === 'error' ){
            echo Funciones::makeJsonResponse(
                "registerCycle",
                'error',
                $result['message']
            );
        }

        //--------Algun valor ya existe
        if( $result['result'] === false ){

            echo Funciones::makeJsonResponse(
                "registerCycle",
                false,
                $result['message']
            );
        }

        //--------OK
        if ($result['result'] === true){
            //TODO: enviar correo a admin
            //TODO: enviar correo de verificacion al usuario para que pueda inciiar sesion
            echo Funciones::makeJsonResponse(
                "registerCycle",
                true,
                $result['message']
            );

        }
?>