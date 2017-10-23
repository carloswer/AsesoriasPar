
<?php

require_once '../../../config.php';

use Control\ControlCiclos;
use Control\Funciones;
use Objetos\Ciclo;

if( !isset($_POST['cycle_update'])){
    Funciones::makeJsonResponse(
        "updateCycle",
        'error',
        "No se envío la información esperada"
    );
    exit;
}
$conCycles = new ControlCiclos();

//JSON to JSON PHP Object
$json = $_POST['cycle_update'];
$updateCycleJSON= json_decode($json);

//Crear ciclo
$cycleObj = new Ciclo();
$cycleObj->setId(($updateCycleJSON->id));
$cycleObj->setStart($updateCycleJSON->start);
$cycleObj->setEnd($updateCycleJSON->end);

//Inserción un nuevo
$result = $conCycles->updateCycles($cycleObj);

//--------Ocurrio un error
if( $result['result'] === 'error' ){
    echo Funciones::makeJsonResponse(
        "updateCycle",
        'error',
        $result['message']

    );
}

//--------Algun valor ya existe
if( $result['result'] == false ){

    echo Funciones::makeJsonResponse(
        "updateCycle",
        false,
        $result['message']
    );
}

//--------OK
if ($result['result'] === true){
    //TODO: enviar correo a admin
    //TODO: enviar correo de verificacion al usuario para que pueda inciiar sesion
    echo Funciones::makeJsonResponse(
        "updateCycle",
        true,
        "Actualizado con éxito"
    );

}




?>